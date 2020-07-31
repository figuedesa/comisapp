<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoServicio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-servicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pago')->textInput() ?>

    <?= $form->field($model, 'id_servicio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
