<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Servicio */

$this->title = Yii::t('app', 'Create Servicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
