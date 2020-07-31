<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pagoservicio */

$this->title = Yii::t('app', 'Update Pagoservicio: {name}', [
    'name' => $model->id_pago,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pagoservicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pago, 'url' => ['view', 'id_pago' => $model->id_pago, 'id_servicio' => $model->id_servicio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pagoservicio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
