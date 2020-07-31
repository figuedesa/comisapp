<?php
/*
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

/*
$this->title = Yii::t('app', 'Create Usuarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 * 
 */
?>
<!--div class="usuarios-create">

    <h1><?//= Html::encode($this->title) ?></h1>

    <?//= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div-->

<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form ActiveForm */
// $this->title = 'Registracion';
// $this->params['breadcrumbs'][] = $this->title;
$this->title = Yii::t('app', 'Create Usuarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<!--div class="site-registros" -->
<div class="usuarios-create">
    
    <h1><?php echo Html::encode($this->title)?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-registros -->
