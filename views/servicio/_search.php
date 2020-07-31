<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServicioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_persona') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'mesa') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'importe') ?>

    <?php // echo $form->field($model, 'porcentaje') ?>

    <?php // echo $form->field($model, 'importe_comision') ?>

    <?php // echo $form->field($model, 'packs') ?>

    <?php // echo $form->field($model, 'id_personal') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
