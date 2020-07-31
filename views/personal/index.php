<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use dosamigos\datepicker\DatePicker;

$this->title = Yii::t('app', 'Personals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Personal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php  //echo $this->personal->funcion->nombre; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'apellido',
            'nombre',
            //'domicilio',
            //'telefono',
            //'id_funcion',
            //'funcion.nombre',
            [
              //'attribute'=>'id_funcion',
              'attribute'=>'id_funcion',
              'value'=>'funcion.nombre',
              //'format'=>'raw', //text, email, url
              //'label'=>'funcion', //Se puede confirr en el modelo
            ],
            ////'fecha_alta:date',
            [
              'attribute'=>'fecha_alta',
              'value'=>'fecha_alta',
              'format'=>'raw',
              'filter'=>DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha_alta',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                    ])
            ],
            //'fecha_baja',
            //'Observacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
