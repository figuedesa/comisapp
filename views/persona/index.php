<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Personas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Persona'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'apellido',
            'nombre',
            //'id_empresa',
            [
              'attribute'=>'id_empresa',
              'value'=>'empresa.nombre',
            ],
            //'cuil',
            //'tipo_dni',
            //'nro_dni',
            //'id_ocupacion',
            [
              'attribute'=>'id_ocupacion',
              'value'=>'ocupacion.nombre',
            ],
            'telefono',
            //'mail',
            'fecha_alta',
            'fecha_baja',
            //'observacion',
            //'id_pais',
            [
              'attribute'=>'id_pais',
              'value'=>'pais.denominacion',
            ],
          

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
