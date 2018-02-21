<?php

namespace backend\controllers;

use Yii;
use backend\models\Streaming;
use backend\models\StreamingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StreamingController implements the CRUD actions for Streaming model.
 */
class StreamingController extends Controller
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
     * Lists all Streaming models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StreamingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Streaming model.
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
     * Creates a new Streaming model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Streaming();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
//                setlocale(LC_ALL,"es_CO");

//                $query = "SET lc_time_names = 'es_CO';";
//                $stmt = $this->connexion->query($query);

                if ($model->save()) {
                    Yii::$app->session->setFlash("success","Streaming created successfully!");
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

                $transaction->commit();

                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Streaming model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post())) {
        if ($model->save()) {
          Yii::$app->session->setFlash('success', Yii::t('app', 'Streaming updated successfully'));
        } else {
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
        }

        return $this->redirect(['index']);
      }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Streaming model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionDelete($id)
     {
         try{
           if($this->findModel($id)->delete()) {
             Yii::$app->session->setFlash("success", Yii::t('app', "Streaming deleted successfully!"));
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
           Yii::$app->session->setFlash("warning", Yii::t('app', "Streaming can't be deleted!"));
         }

         return $this->redirect(['index']);
     }

    /**
     * Finds the Streaming model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Streaming the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Streaming::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
