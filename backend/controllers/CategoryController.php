<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use backend\models\Helper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        if ( !\Yii::$app->user->can('category-list')) {
          throw new ForbiddenHttpException("Access denied");
        }

        $model = new Category(['scenario' => 'create']);
        if ($model->load(Yii::$app->request->post())) {

          $model->file = UploadedFile::getInstance($model, 'file');
          $model->image = Helper::limpiaUrl($model->category . '.' . $model->file->extension);

          if ($model->save()) {
            $model->file->saveAs( 'img/categories/' . $model->image);
            Yii::$app->session->setFlash('success', Yii::t('app', 'Category created successfully'));
          } else {
  //            print_r($model->getErrors());
  //            exit;
            $errors = '<ul>';
               foreach ($model->getErrors() as $key => $value) {
                   foreach ($value as $row => $field) {
                       //Yii::$app->session->setFlash("danger", $field);
                       $errors .= "<li>" . $field . "</li>";
                   }
               }
               $errors .= '</ul>';

               //print_r($errors);exit;
               Yii::$app->session->setFlash("danger", $errors);
            return $this->redirect(['index']);
          }
        }

        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if ( !\Yii::$app->user->can('category-view')) {
          throw new ForbiddenHttpException("Access denied");
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ( !\Yii::$app->user->can('category-create')) {
          throw new ForbiddenHttpException("Access denied");
        }

        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!\Yii::$app->user->can('category-update')) {
            throw new ForbiddenHttpException("Access denied");
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            // si subo otra imagen tengo que remplazar la anterior
            if($model->file) {
                // borro el archivo anterior
                unlink('img/categories/' . $model->image);
                $model->image = Helper::limpiaUrl($model->category . '.' . $model->file->extension);
            } else {
              // si cambia el nombre del curso renombro la imagen
              $model->image = Helper::limpiaUrl($model->category . '.png');
              $oldImage = $model->oldAttributes['image'];
              rename('img/categories/' . $oldImage, 'img/categories/' . $model->image);
            }

            if ($model->save()) {
              if($model->file) {
                $model->file->saveAs( 'img/categories/' . $model->image);
              }
              Yii::$app->session->setFlash('success', Yii::t('app', 'Category updated successfully'));
            } else {
  //              print_r($model->getErrors());
  //              exit;
              $errors = '<ul>';
                 foreach ($model->getErrors() as $key => $value) {
                     foreach ($value as $row => $field) {
                         //Yii::$app->session->setFlash("danger", $field);
                         $errors .= "<li>" . $field . "</li>";
                     }
                 }
                 $errors .= '</ul>';

                 //print_r($errors);exit;
                 Yii::$app->session->setFlash("danger", $errors);
              return $this->redirect(['index']);
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('category-delete')) {
            throw new ForbiddenHttpException("Access denied");
        }

        try{
          $model = $this->findModel($id);
          if($model->delete()) {
            unlink('img/categories/' . $model->image);
            Yii::$app->session->setFlash("success", Yii::t('app', "Category deleted successfully!"));
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
          Yii::$app->session->setFlash("warning", Yii::t('app', "Category can't be deleted!"));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
