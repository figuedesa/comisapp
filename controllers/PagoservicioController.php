<?php

namespace app\controllers;

use Yii;
use app\models\Pagoservicio;
use app\models\PagoservicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagoservicioController implements the CRUD actions for Pagoservicio model.
 */
class PagoservicioController extends Controller
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
     * Lists all Pagoservicio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagoservicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pagoservicio model.
     * @param integer $id_pago
     * @param integer $id_servicio
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_pago, $id_servicio)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_pago, $id_servicio),
        ]);
    }

    /**
     * Creates a new Pagoservicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pagoservicio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pago' => $model->id_pago, 'id_servicio' => $model->id_servicio]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pagoservicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_pago
     * @param integer $id_servicio
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_pago, $id_servicio)
    {
        $model = $this->findModel($id_pago, $id_servicio);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pago' => $model->id_pago, 'id_servicio' => $model->id_servicio]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pagoservicio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_pago
     * @param integer $id_servicio
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_pago, $id_servicio)
    {
        $this->findModel($id_pago, $id_servicio)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pagoservicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_pago
     * @param integer $id_servicio
     * @return Pagoservicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pago, $id_servicio)
    {
        if (($model = Pagoservicio::findOne(['id_pago' => $id_pago, 'id_servicio' => $id_servicio])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
