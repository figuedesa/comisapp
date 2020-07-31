<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Empresa;
use app\models\Ocupacion;
use app\models\Nacionalidad;


use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'id_empresa')->textInput() ?-->
    
    <?=
        $form->field($model, 'id_empresa')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Empresa::find()->all(),'id','nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Empresa ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);    
    ?>    
    

    <?= $form->field($model, 'cuil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_dni')->textInput() ?>

    <?= $form->field($model, 'nro_dni')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'id_ocupacion')->textInput() ?-->

    <?=
        $form->field($model, 'id_ocupacion')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Ocupacion::find()->all(),'id','nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Ocupacion ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);    
    ?>    
    
    
    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'fecha_alta')->textInput() ?-->

    <!--?= $form->field($model, 'fecha_baja')->textInput() ?-->
    
    <?= $form->field($model, 'fecha_alta')->widget(DatePicker::className(), [
        'language' => 'es',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
            ]
        ]);    
    ?>
    
    <?= $form->field($model, 'fecha_baja')->widget(DatePicker::className(), [
        'language' => 'es',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>
    

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'id_pais')->textInput() ?-->
    <?=
        $form->field($model, 'id_pais')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Nacionalidad::find()->all(),'id','denominacion'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Nacionalidad ...'],
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
