<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Funcion;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;
//use bootui\datepicker\Datepicker;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <!--?= 
        /*
        $form->field($model, 'id_funcion')->dropDownList(
        ArrayHelper::map(Funcion::find()->all(),'id','nombre'),
        ['prompt'=>'Seleccione Funcion']
        )
        */
    ?-->
    <?=
        $form->field($model, 'id_funcion')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Funcion::find()->all(),'id','nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Funcion ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);    
    ?>    
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
            'format' => 'dd-M-yyyy'
            ]
        ]);
    ?>

    <?= $form->field($model, 'Observacion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
