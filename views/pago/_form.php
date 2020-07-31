<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use app\models\Persona;
use app\models\Personal;
use app\models\Pago;
use app\models\Model;//Agregado para formulario dinamico
use app\models\Pagoservicio;//Agregado para formulario dinamico


use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;

use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <!--?= $form->field($model, 'fecha')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'fecha')->widget(DatePicker::className(), [
        'language' => 'es',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
            ]
        ]);    
    ?>

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

    <?= $form->field($model, 'monto')->textInput(['maxlength' => true]) ?>

    <!-- Comienzo del Formulario Dinámico -->
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i>Items Servicios Pagados</h4></div>
            <div class="panel-body">
                 <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 10, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelPagoservicio[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        //'id_pago',
                        'id_servicio',
                        'estado',
                        'monto',
                        'saldo',
                    ], 
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelPagoservicio as $i => $modelPagoservicio): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Servicios Pagados</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                                // necessary for update action.
                                if (! $modelPagoservicio->isNewRecord) {
                                    echo Html::activeHiddenInput($modelPagoservicio, "[{$i}]id");
                                }
                            ?>
                            <!--?= $form->field($modelPagoservicio, "[{$i}]full_name")->textInput(['maxlength' => true]) ?-->
                            <div class="row">
                                <!--div class="col-sm-6"-->
                                    <!--?= $form->field($modelPagoservicio, "[{$i}]id_pago")->textInput(['maxlength' => true]) ?-->
                                <!--/div-->
                                <div class="col-sm-6">
                                    <?= $form->field($modelPagoservicio, "[{$i}]id_servicio")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelPagoservicio, "[{$i}]estado")->textInput(['maxlength' => true]) ?>
                                </div>
                            <!--/div><!-- .row -->
                            <!--div class="row" -->
                                <div class="col-sm-4">
                                    <?= $form->field($modelPagoservicio, "[{$i}]monto")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelPagoservicio, "[{$i}]saldo")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>
    
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
