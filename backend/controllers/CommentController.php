<?php

namespace backend\controllers;

use Yii;
use backend\models\Comment;
use backend\models\CommentSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Change the status to ACTIVE
     * @return mixed
     */
    public function actionApprove($id)
    {
        if ( !\Yii::$app->user->can('comment-change-status')) {
          throw new ForbiddenHttpException("Access denied");
        }

        $comment = Comment::findOne($id);
        $comment->status = Comment::STATUS_ACTIVE;

        if ($comment->save()) {
          Yii::$app->session->setFlash("success", "Comentario aprobado exitosamente!");
        } else {
            $errors = '';
            foreach ($comment->getErrors() as $key => $value) {
                foreach ($value as $row => $field) {
                    //Yii::$app->session->setFlash("danger", $field);
                    $errors .= $field . "<br>";
                }
            }

            //print_r($errors);exit;
            Yii::$app->session->setFlash("danger", $errors);
        }

        return $this->redirect(['index']);
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        if ( !\Yii::$app->user->can('comment-list')) {
          throw new ForbiddenHttpException("Access denied");
        }

        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ( !\Yii::$app->user->can('comment-create')) {
          throw new ForbiddenHttpException("Access denied");
        }

        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if ( !\Yii::$app->user->can('comment-update')) {
          throw new ForbiddenHttpException("Access denied");
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ( !\Yii::$app->user->can('comment-delete')) {
          throw new ForbiddenHttpException("Access denied");
        }

        try{
          $model = $this->findModel($id);
          if($model->delete()) {
            Yii::$app->session->setFlash("success", Yii::t('app', "Comment deleted successfully!"));
          } else {
            $errors = '';
            foreach ($model->getErrors() as $key => $value) {
                foreach ($value as $row => $field) {
                    //Yii::$app->session->setFlash("danger", $field);
                    $errors .= $field . "<br>";
                }
            }
            Yii::$app->session->setFlash("danger", $errors);
          }
        } catch (\Exception $e) {
          Yii::$app->session->setFlash("warning", Yii::t('app', "Article can't be deleted!"));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
