<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

use yii\widgets\Pjax;
use app\models\PagoservicioSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagoSearch */
/* @var $searchModel app\models\PagoservicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pagos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pago'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [//'class' => 'yii\grid\SerialColumn'
                'class' => '\kartik\grid\ExpandRowColumn',
                'value' => function($model,$key,$index,$column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=> function($model,$key,$index,$column){
                    $searchModel=new PagoservicioSearch();
                    $searchModel->id_pago=$model->id;
                    $dataProvider=$searchModel->search(Yii::$app->request->queryParams);
                    
                    return Yii::$app->controller->renderPartial('_pagoservicioitems',[
                        'searchModel'=>$searchModel,
                        'dataProvider'=>$dataProvider,
                    ]);
                        
                },
            ],

            'id',
            'fecha',
            'proveedor',
            'atencion',
            'monto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
