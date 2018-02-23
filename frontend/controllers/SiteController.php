<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use \yii\db\Expression;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use frontend\models\Article;
use frontend\models\Category;
use frontend\models\Comment;
use frontend\models\Course;
use frontend\models\Streaming;
use common\models\Helper;
use common\models\Security;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * find an article by slug
     * @param string $slug seo-slug of article
     * @return object
     */
    public function actionArticle($slug)
    {
//        $this->layout = 'blue/main';
        $article = Article::find()->where('slug = :slug', [':slug' => $slug])->one();

        if (sizeof($article) == 0) {
            throw new NotFoundHttpException();
        }

        $course = Course::findOne($article->course_id);

        $nextArticle    = Article::find()->where(
                            "course_id = :course_id AND number = :number",
                            [":course_id" => $article->course_id, ":number" => $article->number + 1]
                        )->one();

        $prevArticle    = Article::find()->where(
                            "course_id = :course_id AND number = :number",
                            [":course_id" => $article->course_id, ":number" => $article->number - 1]
                        )->one();

        $categories = Category::find()->orderBy('category asc')->all();

        // AUMENTAR EL CAMPO visit_count en 1
        if (Yii::$app->user->isGuest) {
            $article->visit_counter += 1;
//            $article->updateCounters(["visit_counter" => 1]);
            $article->save();
        }

        $tags = explode(", ", $article->tags);

        $comment = new Comment(['scenario' => 'comment']);

        $most_visited = Article::find()->orderBy('visit_counter desc')->limit(5)->all();

//        if ( Yii::$app->request->isAjax && $comment->load(Yii::$app->request->post()) ) {

        if ($comment->load(Yii::$app->request->post())) {

            $comment->date          = new Expression('NOW()');
            $comment->article_id    = $article->id;
            $comment->client_ip     = Helper::getRealIP();
            $comment->client_port   = $_SERVER['REMOTE_PORT'];
            $comment->rel           = "nofollow";

//            if (!$comment->validate()) {
//                Yii::$app->response->format = Response::FORMAT_JSON;
//                return \yii\widgets\ActiveForm::validate($comment);
//            }

            $blackList = [
                '23.95.201.236',    '23.104.161.65',    '46.161.9.32',      '91.108.177.114',
                '91.108.177.161',   '104.129.13.141',   '104.160.13.43',
                '107.151.152.26',
                '107.151.152.95',   '107.172.241.115',  '107.175.159.60',
                '114.98.232.30',    '114.98.245.207',
                '124.73.2.106',
                '178.32.12.117',    '181.214.37.131',
                '188.143.232.10',   '195.154.35.47',
                '198.52.168.254',
            ];

            $oldComment = Comment::find()->where(
                "email = :email AND article_id = :article AND comment = :comment",
                [ ":email" => Security::mcrypt($comment->email), ":article" => $comment->article_id, ":comment" => $comment->comment ]
            )->count();

            if ( in_array($comment->client_ip, $blackList) or $oldComment > 0 ) {
                $comment = new Comment(['scenario' => 'comment']);
                Yii::$app->session->setFlash("success", "Gracias por su opinión. Su comentario será publicado una vez que sea moderado!");
            } elseif ($comment->save()) {
                $comment = new Comment(['scenario' => 'comment']);
                Yii::$app->session->setFlash("success", "Gracias por su opinión. Su comentario será publicado una vez que sea moderado!");
            } else {
                Yii::$app->session->setFlash("error", "Su comentario no pudo ser registrado!");
            }
        }

        return $this->render('article', [
            'article'       => $article,
            'categories'    => $categories,
            'comment'       => $comment,
            'course'        => $course,
            'most_visited'  => $most_visited,
            'nextArticle'   => $nextArticle,
            'prevArticle'   => $prevArticle,
            'tags'          => $tags,
        ]);
    }

    public function actionPdf($slug)
    {
        Yii::$app->response->format = 'pdf';
/*
        // Rotate the page
        Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], [
            'format' => [216, 356], // Legal page size in mm
            'orientation' => 'Landscape', // This value will be used when 'format' is an array only. Skipped when 'format' is empty or is a string
            'beforeRender' => function($mpdf, $data) {},
            ]);
*/

        $article = Article::find()->where( 'slug = :slug', [':slug' => $slug] )->one();

        if (sizeof($article) == 0) {
            throw new NotFoundHttpException();
        }

        //$this->layout = '//print';
        $this->layout = 'blue/pdf';

        return $this->render('pdf', [
            'article'   => $article,
        ]);
    }

    /**
     * Download a file
     * if is a guest increment de download_counter
     * @return file to download
     */
    public function actionDownload($slug)
    {
        /*
         * ALTER TABLE article ADD COLUMN `download_counter` INT UNSIGNED NOT NULL DEFAULT 0 AFTER `visit_counter`;
         */
        $article = Article::find()->where( 'slug = :slug', [':slug' => $slug] )->one();

        if (empty($article->download)) {
            Yii::$app->session->setFlash('download_error', 'No existe una descarga para este artículo');
            return $this->redirect(['articulo/' . $slug]);
        } else {
            if (Yii::$app->user->isGuest) {
                $article->download_counter += 1;
                $article->update();
            }

            $filename = \yii\helpers\Html::encode($article->download);

            return $this->redirect($filename);

//            $response = Yii::$app->getResponse();
//            $response->headers->set('Content-Type', 'application/zip');
//            $response->headers->set('Content-Type', 'application/force-download');
//            $response->headers->set('Content-Disposition', 'attachment; filename=' . $filename);
//            $response->headers->set('Content-Transfer-Encoding', 'binary');
//            $response->format = \yii\web\Response::FORMAT_RAW;

//            Yii::$app->response->setDownloadHeaders($filename);


            /*
             * -----------------------------------------------------------------
            if ( !is_resource($response->stream = fopen($filename, 'r')) ) {
                throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
            }
            return $response->send();
             * -----------------------------------------------------------------
             */


            /*
             * -----------------------------------------------------------------
            header("Content-disposition: attachment; filename=$filename");
            header("Content-type: application/zip");
            readfile($filename);
             * -----------------------------------------------------------------
            */

        }

    }

    /**
     * find articles by tag
     * @param string $tag tag of article
     * @return object
     */
    public function actionTag($tag)
    {
        $query = Article::find()->where(["like", "tags", $tag]);

        $pagination = new Pagination([
            'defaultPageSize'   => 20,
            'totalCount'        => $query->count(),
        ]);

        $articles = Article::find()
                ->where(["like", "tags", $tag])
                ->orderBy("id desc")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        $categories = Category::find()->orderBy('category asc')->all();

        $most_visited = Article::find()->orderBy('visit_counter desc')->limit(5)->all();

        return $this->render(
            'tag',
            [
                'articles'      => $articles,
                'categories'    => $categories,
                'most_visited'  => $most_visited,
                'pagination'    => $pagination,
                'tag'           => $tag,
            ]
        );
    }

    /**
     * find articles by category
     * @param string $tag tag of article
     * @return object
     */
    public function actionCategory($slug)
    {
//        $this->layout = 'blue/main';

        $category = Category::find()->where("slug = :slug", [':slug' => $slug])->one();

        $query = Article::find()->where("category_id = :category_id", [':category_id' => $category->id]);

        $pagination = new Pagination([
            'defaultPageSize'   => 20,
            'totalCount'        => $query->count(),
        ]);

        $articles = Article::find()
                ->where("category_id = :category_id", [':category_id' => $category->id])
                ->orderBy("id desc")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        $categories = Category::find()->orderBy('category asc')->all();

        $most_visited = Article::find()->orderBy('visit_counter desc')->limit(5)->all();

        return $this->render(
            'category',
            [
                'articles'      => $articles,
                'categories'    => $categories,
                'category'      => $category,
                'most_visited'  => $most_visited,
                'pagination'    => $pagination,
            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      $query = Article::find();

      $pagination = new Pagination([
          'defaultPageSize'   => 20,
          'totalCount'        => $query->count(),
      ]);

      $articles = $query->orderBy('id desc')
                  ->offset($pagination->offset)
                  ->limit($pagination->limit)
                  ->all();

      $categories = Category::find()->orderBy('category asc')->all();

      $most_visited = Article::find()->orderBy('visit_counter desc')->limit(5)->all();

      return $this->render('index', [
          'articles'      => $articles,
          'categories'    => $categories,
          'most_visited'  => $most_visited,
          'pagination'    => $pagination,
      ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionStreaming()
    {
        $now = date("Y-m-d H:i:s");

        $streaming = Streaming::find()
                    ->where('start <= :now', [':now'=>$now])
                    ->andWhere("end >= :now", [":now"=>$now])
                    ->one();

        $articles = $most_visited = Article::find()->where('category_id = 15')->orderBy('rand()')->limit(5)->all();
        $categories = Category::find()->orderBy('category asc')->all();
        $most_visited = Article::find()->orderBy('visit_counter desc')->limit(5)->all();

        $next_streaming = Streaming::find()
                    ->where('start > :now', [':now'=>$now])
                    ->orderBy('start asc')
                    ->one();

        return $this->render(
            'streaming',
            [
                'articles'          => $articles,
                'categories'        => $categories,
                'most_visited'      => $most_visited,
                'next_streaming'    => $next_streaming,
                'streaming'         => $streaming,
            ]
        );
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * List all the article of one course
     * @param String $slug slug for the course
     * @return Array list of articles from the current course
     */
    public function actionCourse($slug)
    {
        $categories     = Category::find()->orderBy('category asc')->all();
        $course         = Course::find()->where("slug = :slug", [":slug" => $slug])->one();

        $query          = Article::find()->where("course_id = :course", [":course" => $course->id]);
        $pagination     = new Pagination([
            'defaultPageSize'   => 15,
            'totalCount'        => $query->count(),
        ]);

        $articles       = Article::find()
                            ->where("course_id = :course", [":course" => $course->id])
                            ->offset($pagination->offset)
                            ->limit($pagination->limit)
                            ->all();
        $most_visited   = Article::find()->orderBy('visit_counter desc')->limit(5)->all();

        $courses    = Course::find()
                        ->where("slug <> :slug", [":slug" => $course->slug])
                        ->limit(4)->orderBy("rand()")->all();

        return $this->render(
            'course',
            [
                'articles'      => $articles,
                'categories'    => $categories,
                'course'        => $course,
                'courses'       => $courses,
                'most_visited'  => $most_visited,
                'pagination'    => $pagination,
            ]
        );
    }

    /**
     * find all courses
     * @return objects array
     */
    public function actionAllCourses()
    {
        $categories     = Category::find()->orderBy('category asc')->all();
        $most_visited   = Article::find()->orderBy('visit_counter desc')->limit(5)->all();
        $courses        = Course::find()->all();

        return $this->render(
            'all-courses',
            [
                'categories'    => $categories,
                'courses'       => $courses,
                'most_visited'  => $most_visited,
            ]
        );
    }

    /**
     * Displays offline page.
     *
     * @return string
     */
    public function actionOffline()
    {
        $this->layout = false;
        return $this->render('offline');
    }

    public function actionPortfolio()
    {
        $categories = Category::find()->orderBy('category asc')->all();
        $most_visited = Article::find()->orderBy('visit_counter desc')->limit(5)->all();

        return $this->render(
            'portfolio',
            [
                'categories'    => $categories,
                'most_visited'  => $most_visited,
            ]
        );
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $categories = Category::find()->orderBy('category asc')->all();

        $most_visited = Article::find()->orderBy('visit_counter desc')->limit(5)->all();
        return $this->render('about', [
            'categories'    => $categories,
            'most_visited'  => $most_visited,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
