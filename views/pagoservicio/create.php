<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pagoservicio */

$this->title = Yii::t('app', 'Create Pagoservicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pagoservicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagoservicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
