<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoServicio */

$this->title = Yii::t('app', 'Create Pago Servicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pago Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-servicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
