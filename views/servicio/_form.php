<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use app\models\Persona;
use app\models\Personal;
use app\models\Pago_Servicio;
use app\models\Pago;

use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Servicio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <!--?= $form->field($model, 'id_persona')->textInput() ?-->

    <?=
        $form->field($model, 'id_persona')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Persona::find()->all(),'id','nombre_completo'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Persona ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);    
    ?>
    
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero')->textInput() ?>

    <?= $form->field($model, 'mesa')->textInput() ?>

    <!--?= $form->field($model, 'fecha')->textInput() ?-->
    
    <?= $form->field($model, 'fecha')->widget(DatePicker::className(), [
        'language' => 'es',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
            ]
        ]);    
    ?>

    <?= $form->field($model, 'importe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'porcentaje')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'importe_comision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'packs')->textInput() ?>

    <!--?= $form->field($model, 'id_personal')->textInput() ?-->
    
    <?=
        $form->field($model, 'id_personal')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Personal::find()->all(),'id','nombre_completo'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Personal ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);    
    ?>    
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
