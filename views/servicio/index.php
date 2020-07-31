<?php

use yii\helpers\Html;
use yii\grid\GridView;


use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Servicios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Servicio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'id_persona',
            [
              'attribute'=>'proveedor',
              'value'=>'proveedor',
            ],
            'descripcion',
            'numero',
            'mesa',
            //'fecha',
            //'importe',
            //'porcentaje',
            //'importe_comision',
            //'packs',
            //'id_personal',
            'atencion',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
