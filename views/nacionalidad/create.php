<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nacionalidad */

$this->title = Yii::t('app', 'Create Nacionalidad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nacionalidads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nacionalidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
