<?php

namespace app\controllers;

use Yii;
use app\models\PagoServicio;
use app\models\PagoServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagoServicioController implements the CRUD actions for PagoServicio model.
 */
class PagoServicioController extends Controller
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
     * Lists all PagoServicio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagoServicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PagoServicio model.
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
     * Creates a new PagoServicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PagoServicio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pago' => $model->id_pago, 'id_servicio' => $model->id_servicio]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PagoServicio model.
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
     * Deletes an existing PagoServicio model.
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
     * Finds the PagoServicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_pago
     * @param integer $id_servicio
     * @return PagoServicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pago, $id_servicio)
    {
        if (($model = PagoServicio::findOne(['id_pago' => $id_pago, 'id_servicio' => $id_servicio])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
