<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use \app\models\Usuarios;
//Yii::$app->language='ru';

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        //'options' => ['class' => 'sidebar-menu treeview'],      
        
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
        
    ]);
    
/*    
    $navItem=[
            ['label' => Yii::t('app/nav', 'Home'), 'url' =>['/site/index']],
            ['label' => 'Servicios', 'url' => ['/servicio/index']],
            ['label' => 'Pagos', 'url' => ['/pago/index']],
            ['label' => 'PagoServicios', 'url' => ['/pagoServicio/index']],
            //['label' => 'Personas', 'url' => ['/persona/index']],
            //['label' => 'Personal', 'url' => ['/personal/index']],
      
            ['label' => 'Parametros', 
                'items'=>[
                    ['label' => 'Empresa', 'url' => ['/empresa/index']],
                    ['label' => 'Funcion', 'url' => ['/funcion/index']],
                    ['label' => 'Nacionalidad', 'url' => ['/nacionalidad/index']],
                    ['label' => 'Ocupacion', 'url' => ['/ocupacion/index']],
                    ['label' => 'Personas', 'url' => ['/persona/index']],
                    ['label' => 'Personal', 'url' => ['/personal/index']],
                ],
                'options' => ['class' =>'navbar-nav'],  
            ],
            ['label' => Yii::t('app/nav','About'), 'url' => ['/site/about']],
           
          ['label' => Yii::t('app/nav','Contact'), 'url' => ['/site/contact']],
        ];
*/    
        //Obtiene el rol del usuario logueado
        $aRoles=Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->getUser()->getId());
    
        $navItem[]=['label' => Yii::t('app/nav', 'Home'), 'url' =>['/site/index']];
        if(!Yii::$app->user->getIsGuest()){
            $navItem[]=['label' => 'Servicios', 'url' => ['/servicio/index']];
            $navItem[]=['label' => 'Pagos', 'url' => ['/pago/index']];
            //$navItem[]=['label' => 'PagoServicios', 'url' => ['/pagoservicio/index']];
            
            if( array_key_exists("administrador",$aRoles)){
                $navItem[]=['label' => 'Parametros', 
//                        'options' => [
//                            'class' => 'sidebar-menu treeview',
//                        ],
                        'items'=>[
                            ['label' => 'Empresa', 'url' => ['/empresa/index']],
                            ['label' => 'Funcion', 'url' => ['/funcion/index']],
                            ['label' => 'Nacionalidad', 'url' => ['/nacionalidad/index']],
                            ['label' => 'Ocupacion', 'url' => ['/ocupacion/index']],
                            ['label' => 'Personas', 'url' => ['/persona/index']],
                            ['label' => 'Personal', 'url' => ['/personal/index']],
                            ['label' => 'Usuarios', 'url' => ['/usuarios/index']],
                        ],
                    ];
            //    $navItem[]=['label' => Yii::t('app/nav','Registro'), 'url' => ['/site/registros']];
            }
            //$navItem[]=['label' => Yii::t('app/nav','About'), 'url' => ['/site/about']];
        }
        //echo 'Usuario'.Yii::$app->user->;
        
        if(Yii::$app->user->isGuest){
            array_push($navItem,['label' => Yii::t('app/nav','Login'), 'url' => ['/site/login']]);
        } else {
            array_push($navItem,'<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>');
        }
       
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        //'options' => ['class' =>'navbar-nav'],
      
        //'options' => ['class' => 'navbar-inverse navbar-fixed-top',],
      
        'items' => $navItem 
        ]);
    
    NavBar::end();
    
    //echo Yii::$app->user->getId();
    ?>
    
    <div class="container" >
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy;<?= \Yii::t('yii',' Tio Querido ').date('Y') ?></p>

        <p class="pull-right"><?= 'Developed by HC' ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
