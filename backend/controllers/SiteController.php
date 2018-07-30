<?php
namespace backend\controllers;

use Yii;

use backend\models\Licencia;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\SignupForm;
use backend\models\AuthItem;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\ItemProdSearch;
use backend\models\ItemProd;
use  yii\web\Session;
use yii\helpers\Url;
use backend\models\User;
use backend\models\UserSearch;
/**
 * Site controller
 */
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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                       // 'roles' => ['?'],
                    ],
                    [
                        'actions' => ['request-password-reset'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['settings'],
                        'allow' => true,
                    ],
                ],
            ],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {


  $mostrarVencer=ItemProd::find()->where(['estatusNotificacion'=>'Vencido','estatusItemProd' =>'Active'])->all();
 $mostrarPorExpirar=ItemProd::find()->where(['estatusNotificacion'=>'Por Vencer','estatusItemProd' =>'Active'])->all();

         $session = Yii::$app->session;
            if (!$session->isActive){
                $session->open();// open a session 
            } 
          $session['user'] =Yii::$app->user->identity->username;


         $this->layout = 'main';
        return $this->render('index', [
        'searchModelItemProd' => $mostrarVencer,
        'searchModelItemProd2' => $mostrarPorExpirar,
    ]);  
    }



    public function actionSettings()
    {
          $session = Yii::$app->session;
          if (isset($session['user'])){
          return $this->redirect(['configuremenu']);
            }else{
                return $this->goHome();
            }


    }
/*
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $session = Yii::$app->session;
            if (!$session->isActive){
                $session->open();// open a session 
            } 
          $session['user'] =Yii::$app->user->identity->username;
            return $this->goBack();
        
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        $session = Yii::$app->session;
        unset($session['user']);
        return $this->goHome();

    }


   public function actionSignup()
    {
            $session = Yii::$app->session;
          if (isset($session['user'])){
         //$this->layout = 'loginLayout';
        $model = new SignupForm();
      //  $authItems = AuthItem::find()->all();
        if ($model->load(Yii::$app->request->post()) ) {
            if ($user = $model->signup()) {
              echo 1;
                return $this->redirect(['user/index', 'accion' => 'insert']);
                    }else{
                        echo 0;
                    }
        }

        return $this->renderAjax('signup', [
            'model' => $model,
           // 'authItems'=>$authItems,
        ]);
         }else{
                return $this->goHome();
            }
    }



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

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
       $msg =null;

           //$this->layout = 'loginLayout';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //Buscar al usuario a través del email
    $table = User::find()->where("email=:email", [":email" => $model->email]);
  /*  if(User::find()->where("email=:email", [":email" => $model->email])){
       echo "se encontró"; 
    }else{
        echo "no se encontro";
    }*/



    //Si el usuario existe
    if ($table->count() == 1)
    {
       // echo "el usuario si existe";
     $session = new Session;
     $session->open();

     /*if ($session->isActive) {
         echo "se abrio la sesion";
     }else{
        echo "No se abrio la sesion";
     }*/
     //echo "se abrio la sesion";
     //Esta clave aleatoria se cargará en un campo oculto del formulario de reseteado
     $session["recover"] = $this->randKey("abcdef0123456789", 200);
     $recover = $session["recover"];
     //También almacenaremos el id del usuario en una variable de sesión
     //El id del usuario es requerido para generar la consulta a la tabla users y 
     //restablecer el password del usuario
     $table = UserSearch::find()->where("email=:email", [":email" => $model->email])->one();

     $session["id_recover"] = $table->id;
    // echo $session["id_recover"];
//Esta variable contiene un número hexadecimal que será enviado en el correo al usuario 
     //para que lo introduzca en un campo del formulario de reseteado
     //Es guardada en el registro correspondiente de la tabla users
     $verification_code = $this->randKey("abcdef0123456789", 8);
     //Columna verification_code
     $table->verification_code = $verification_code;

    // echo $table->verification_code;
     //echo $verification_code;
    $table->save();
     //Guardamos los cambios en la tabla users
     /*if($table->save()){
        echo "se guardo ".$verification_code;
     }else{
        echo "No se guardo";
     }*/
//Creamos el mensaje que será enviado a la cuenta de correo del usuario
     $subject = "Recuperar Contraseña";
     $body = "<p>Copie el siguiente código de verificación para restablecer su contraseña.</p><br> ";
     $body .= "<h3><strong>".$verification_code."</strong><h3>";
     $body .= "<p><a href='http://localhost:81/Proyecto/backend/web/index.php?r=site/reset-password'><strong>Recuperar Contraseña</strong></a></p>";


//echo $verification_code;
//Enviamos el correo
      $mailer = Yii::$app->mailer;
    $mailer->useFileTransport = false;
     Yii::$app->mailer->compose()
     ->setTo($model->email)
     ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
     ->setSubject($subject)
     ->setHtmlBody($body)
     ->send();
     $model->email = null;
     return $this->redirect(['request-password-reset', 'accion' => 'info']);
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model, 
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword()
    {  

       $msg = null; 
        $model = new ResetPasswordForm();
         
        //Abrimos la sesión
            $session = new Session;
            $session->open();
//Si no existen las variables de sesión requeridas lo expulsamos a la página de inicio
    if (empty($session["recover"]) || empty($session["id_recover"]))
    {
        return $this->goHome();
    }else{
        $recover = $session["recover"];
        $model->recover = $recover;
        $id_recover = $session["id_recover"];


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //Preparamos la consulta para resetear el password, requerimos el email, el id 
     //del usuario que fue guardado en una variable de session y el código de verificación
     //que fue enviado en el correo al usuario y que fue guardado en el registro
       $table = UserSearch::findOne(["email" => $model->email, "id" => $id_recover, "verification_code" => $model->verification_code]);
       if (UserSearch::findOne(["email" => $model->email]) && UserSearch::findOne(["verification_code" => $model->verification_code])) {
          //  echo "si se encontró";
        $table->setPassword($model->password);
     
     //Si la actualización se lleva a cabo correctamente
     if ($table->save())
     {
       
     
      //Destruir las variables de sesión
     $session->destroy();
     
      //Vaciar los campos del formulario
      $model->email = null;
      $model->password = null;
      $model->password_repeat = null;
      $model->recover = null;
      $model->verification_code = null;
       $msg = "<div class='alert alert-success'>
      <center>Enhorabuena, su contraseña ha sido cambiada correctamente, redireccionando a la página de login. </center></div>";
      $msg .= "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
      
     }
     else
     {
      $msg = "Ha ocurrido un error";
     }
        
       }else{

        $msg = "<div class='alert alert-danger'>
      <center>No se encontró al usuario. Verifique que el <strong>Correo Electrónico</strong> y el <strong>Código de Verificación</strong> esten escritos correctamente. </center></div>";
      
       }
    
     
      }
    
        }


        return $this->render('resetPassword', [
            'model' => $model,
            "msg" => $msg
        ]);
    }


}
