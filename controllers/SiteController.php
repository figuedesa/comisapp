<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;
//use yii\web\Response;
use \app\models\Usuario;
use \app\models\Usuarios;


use app\models\FormRegister;
use app\models\Users;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup','about'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','registros','about','login'],
                        'roles' => ['@'],
                    ],
                ],
            ],
          
            /*
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            */
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$this->autorizar();
        //echo Yii::$app->getUser()->getId();
        //$this->actionTestpermisos(Yii::$app->getUser()->getId())
        //echo Yii::$app->getAuthManager()->getRole($name);
        //echo print_r( Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->getUser()->getId()));
        
        //Obtiene el arreglo de roles del usuario logueado
        $aRoles=Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->getUser()->getId());
        //echo var_dump($aRoles);
        //echo array_key_exists("gestor",$aRoles);
        
        //echo var_dump(array_values($aRoles));
        //echo "array_search ".array_search("gestor", $aRoles);
        //die;
        //echo print_r($aRoles);
        
//        if (array_key_exists($idUser, $aRoles)) {
//            echo $aRoles[$idUser];
//        } 
//        $aRoles=array("admin","gestor","usuario");
//        if(in_array("gestor",array_values($aRoles))){
//            echo "Gestor";
//        }else{
//            echo "No Gestor";
//        }
        //echo print_r( Yii::$app->getAuthManager()->getRolesByUser(1));
        //echo print_r(Yii::$app->authManager->getRoles());
        //$this->actionTestpermisos(1);
//        die;
        return $this->render('index');
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
        public function autorizar(){
        
        //Crea un Objeto de Autorizacion
        $auth=Yii::$app->authManager;
        
        //Crea roles de usuarios
        $admin=$auth->createRole('administrador');
        $gestor=$auth->createRole('gestor');
        $operador=$auth->createRole('operador');
        
        //Genera lista de roles
        $auth->add($admin);
        $auth->add($gestor);
        $auth->add($operador);
        
        //Creando acciones para controlar
        $ver=$auth->createPermission('ver');
        $crear=$auth->createPermission('editar');
        $editar=$auth->createPermission('crear');
        $borrar=$auth->createPermission('borrar');
        
        //Agrega lista de acciones
        $auth->add($ver);
        $auth->add($crear);
        $auth->add($editar);
        $auth->add($borrar);
        
        //Asignando permisos de acciones por rol
        //Administador
        $auth->addChild($admin,$ver);
        $auth->addChild($admin,$crear);
        $auth->addChild($admin,$editar);
        $auth->addChild($admin,$borrar);
        //Gestor
        $auth->addChild($gestor,$ver);
        $auth->addChild($gestor,$crear);
        $auth->addChild($gestor,$editar);
        //Operador
        $auth->addChild($operador,$ver);
        
        //
        $auth->assign($admin, 1); //K
        $auth->assign($gestor, 2); //T
        $auth->assign($operador, 3); //D
        //Sooolo para saber si un usuario puede tener mas roles
        //Y encima funcionaa. Fuck!! Fuck!! Fuck!!
        //$auth->assign($gestor, 1); // Yeaahhh!!!!!
    }
    
    public function actionTestpermisos($userId){
    //public function actionTestpermisos(){
        $auth=Yii::$app->authManager;
        //En el caso de usuarios autenticados se puede usar
        Yii::$app->user->can('ver');
        echo "<p>Ver: {$auth->checkAccess($userId,'ver')}</p>";
        echo "<p>Crear: {$auth->checkAccess($userId,'crear')}</p>";
        echo "<p>Editar: {$auth->checkAccess($userId,'editar')}</p>";
        echo "<p>Eliminar: {$auth->checkAccess($userId,'borrar')}</p>";
    }
    

    /**
     * Login action.
     *
     * @return Response|string
    */ 
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /*
    public function actionLogin()
    {
        die("login");
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
     */
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    /**
     * Metodos para registro de usuarios
     */
 private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 public function actionConfirm()
 {
    $table = new Users;
    if (Yii::$app->request->get())
    {
   
        //Obtenemos el valor de los parámetros get
        $id = Html::encode($_GET["id"]);
        $authKey = $_GET["authKey"];
    
        if ((int) $id)
        {
            //Realizamos la consulta para obtener el registro
            $model = $table
            ->find()
            ->where("id=:id", [":id" => $id])
            ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
 
            //Si el registro existe
            if ($model->count() == 1)
            {
                $activar = Users::findOne($id);
                $activar->activate = 1;
                if ($activar->update())
                {
                    echo "Enhorabuena registro llevado a cabo correctamente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
             }
            else //Si no existe redireccionamos a login
            {
                return $this->redirect(["site/login"]);
            }
        }
        else //Si id no es un número entero redireccionamos a login
        {
            return $this->redirect(["site/login"]);
        }
    }
 }
 
 public function actionRegister()
 {
  //Creamos la instancia con el model de validación
  $model = new FormRegister;
   
  //Mostrará un mensaje en la vista cuando el usuario se haya registrado
  $msg = null;
   
  //Validación mediante ajax
  if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
   
  //Validación cuando el formulario es enviado vía post
  //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
  //También previene por si el usuario tiene desactivado javascript y la
  //validación mediante ajax no puede ser llevada a cabo
  if ($model->load(Yii::$app->request->post()))
  {
   if($model->validate())
   {
    //Preparamos la consulta para guardar el usuario
    $table = new Users;
    $table->username = $model->username;
    $table->email = $model->email;
    //Encriptamos el password
    $table->password = crypt($model->password, Yii::$app->params["salt"]);
    //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
    //clave será utilizada para activar el usuario
    $table->authKey = $this->randKey("abcdef0123456789", 200);
    //Creamos un token de acceso único para el usuario
    $table->accessToken = $this->randKey("abcdef0123456789", 200);
     
    //Si el registro es guardado correctamente
    if ($table->insert())
    {
     //Nueva consulta para obtener el id del usuario
     //Para confirmar al usuario se requiere su id y su authKey
     $user = $table->find()->where(["email" => $model->email])->one();
     $id = urlencode($user->id);
     $authKey = urlencode($user->authKey);
      
     $subject = "Confirmar registro";
     $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
     $body .= "<a href='http://yii.local/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
      
     //Enviamos el correo
     Yii::$app->mailer->compose()
     ->setTo($user->email)
     ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
     ->setSubject($subject)
     ->setHtmlBody($body)
     ->send();
     
     $model->username = null;
     $model->email = null;
     $model->password = null;
     $model->password_repeat = null;
     
     $msg = "Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo";
    }
    else
    {
     $msg = "Ha ocurrido un error al llevar a cabo tu registro";
    }
     
   }
   else
   {
    $model->getErrors();
   }
  }
  return $this->render("register", ["model" => $model, "msg" => $msg]);
 }    

 public function actionRegistro()
 {
    $model = new Usuario();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            $model->username=$_POST['Usuario']['username'];
            $model->email=$_POST['Usuario']['email'];
            $model->password=password_hash($_POST['Usuario']['password'],PASSWORD_ARGON2I);
            $model->authKey=md5(random_bytes(5));
            $model->accessToken=password_hash(random_bytes(10),PASSWORD_DEFAULT);
            if($model->save()){
                return $this->redirect(['login']);
            }
            return;
        }
    }

    return $this->render('registro', [
        'model' => $model,
    ]);
 }
 
 public function actionRegistros()
    {
        $model = new Usuarios();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->username=$_POST['Usuarios']['username'];
                $model->email=$_POST['Usuarios']['email'];
                $model->password=password_hash($_POST['Usuarios']['password'],PASSWORD_ARGON2I);
                $model->authKey=md5(random_bytes(5));
                $model->accessToken=password_hash(random_bytes(10),PASSWORD_DEFAULT);
                if($model->save()){
                    return $this->redirect(['login']);
                }
            }
        }

        return $this->render('registros', [
            'model' => $model,
        ]);
    }
}
