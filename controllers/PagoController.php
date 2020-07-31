<?php

namespace app\controllers;

use Yii;
use app\models\Model;
use app\models\Pago;
use app\models\Pagoservicio;
use app\models\PagoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagoController implements the CRUD actions for Pago model.
 */
class PagoController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Pago models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pago model.
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
     * Creates a new Pago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pago();
        
        //Agregado para formulario dinamico
        $modelPagoservicio=[new Pagoservicio];
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelPagoservicio= Model::createMultiple(Pagoservicio::classname());
            Model::loadMultiple($modelPagoservicio, Yii::$app->request->post());

            /*
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($$modelPagoservicio),
                    ActiveForm::validate($model)
                );
            }
            */
            
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelPagoservicio) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelPagoservicio as $modelPagoservicio) {
                            $modelPagoservicio->id_pago = $model->id;
                            if (! ($flag = $modelPagoservicio->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            //Agregado para formulario dinamico
            'modelPagoservicio'=>(empty($modelPagoservicio))?[new Pagoservicio]:$modelPagoservicio
        ]);
    }

    /**
     * Updates an existing Pago model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //Agregado para formulario dinamico
        $modelPagoservicio=[new Pagoservicio];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelPagoservicio= Model::createMultiple(Pagoservicio::classname());
            Model::loadMultiple($modelPagoservicio, Yii::$app->request->post());

            /*
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($$modelPagoservicio),
                    ActiveForm::validate($model)
                );
            }
            */
            
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelPagoservicio) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelPagoservicio as $modelPagoservicio) {
                            $modelPagoservicio->id_pago = $model->id;
                            if (! ($flag = $modelPagoservicio->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);

                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }


            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            //Agregado para formulario dinamico
            'modelPagoservicio'=>(empty($modelPagoservicio))?[new Pagoservicio]:$modelPagoservicio
        ]);
    }

    /**
     * Deletes an existing Pago model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pago::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
