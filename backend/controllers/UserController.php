<?php

namespace backend\controllers;

use Yii;
use backend\models\User;

use backend\models\ChangePass;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {        $session = Yii::$app->session;
          if (isset($session['user'])){
             $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
            }else{
                return $this->goHome();
            }
       
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $session = Yii::$app->session;
          if (isset($session['user'])){
             return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
            }else{
                return $this->goHome();
            }
       
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $session = Yii::$app->session;
          if (isset($session['user'])){

            $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'accion' => 'insert']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
            }else{
                return $this->goHome();
            }
        
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {


        $session = Yii::$app->session;
          if (isset($session['user'])){
            $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'accion' => 'update']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

            }else{
                return $this->goHome();
            }
            }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $session = Yii::$app->session;
        if (isset($session['user'])){
                    $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }else{
            return $this->goHome();
        }

    }

     public function actionTemporaly($id)
    {
        $session = Yii::$app->session;
          if (isset($session['user'])){

        $model =User::findOne($id);
        $model->status = 0;
        $model->save();
        return $this->redirect(['index', 'accion' => 'disable']);
            }else{
                return $this->goHome();
            }
        
    }

        public function actionRecuperar($id)
    {

        $session = Yii::$app->session;
          if (isset($session['user'])){
        $model =User::findOne($id);
        $model->status = 10;
        $model->save();
        return $this->redirect(['listaeliminados', 'accion' => 'enable']);
            }else{
                return $this->goHome();
            }
        
    }

    public function actionListaeliminados(){
         
        $session = Yii::$app->session;
          if (isset($session['user'])){

    $searchModel = new UserSearch();
            $dataProvider = $searchModel->searcheliminados(Yii::$app->request->queryParams);
            $session = Yii::$app->session;
                if (!$session->isActive){
                    $session->open();// open a session 
                } 
            $session['Proveedores'] = Yii::$app->request->queryParams;
            return $this->render('listel', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

         }else{
                return $this->goHome();
        }

         
}

     public function actionRestore($id)
    {



        $session = Yii::$app->session;
          if (isset($session['user'])){
            
        $msg=null;
        $model=ChangePass::find()->where(['id'=>$id])->one();
        //$model = $this->findModel($id);
        $user=Yii::$app->user->identity->username;
        //$oldpassword=$model->oldpassword;



        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        
           
        $change =UserSearch::findOne(["username" => $user, "id" => $id]);


        if ($change) {
            if ($model->validatePassword($model->oldpassword)) {
            $change->setPassword($model->password);


            if ($change->save())
            {
               return $this->redirect(['index', 'accion' => 'update']);
            }else{
                 $msg = "<div class='alert alert-danger'>Error al guardar.</center></div>";
            }

        }else{
            $msg = "<div class='alert alert-danger'>
      <center>Su antigua contraseña no coincide.</center></div>";
        }
        }else{
             $msg = "<div class='alert alert-danger'>
      <center>Inicie sesión para poder cambiar la contraseña.</center></div>";
        }
        
        
        }



        return $this->render('changePassword', [
            'model' => $model,"msg" => $msg
        ]);


            }else{
                return $this->goHome();
            }

       
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
