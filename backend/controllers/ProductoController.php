<?php

namespace backend\controllers;

use Yii;
use backend\models\Producto;
use backend\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use mPDF;
/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
       $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $session = Yii::$app->session;
          if (isset($session['user'])){
            return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

            }else{
                return $this->goHome();
            }
        
        
    }

    /**
     * Displays a single Producto model.
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
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         
        $session = Yii::$app->session;
          if (isset($session['user'])){
            $model = new Producto();

        if ($model->load(Yii::$app->request->post())) {
            
             if($model->save()){
                        echo 1;
        return $this->redirect(['index', 'accion' => 'insert']);
                    }else{
                        echo 0;
                    }
        }
        return $this->renderAjax('create', [
            'model' => $model,
            
        ]);
            }else{
                return $this->goHome();
            }

         
    }

    /**
     * Updates an existing Producto model.
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
     * Deletes an existing Producto model.
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

        return $this->redirect(['listaeliminados', 'accion' => 'delete']);

            }else{
                return $this->goHome();
            }
        
    }



     public function actionTemporaly($id)
    {


        $session = Yii::$app->session;
          if (isset($session['user'])){

        $model =Producto::findOne($id);
        $model->estatusProducto ='Inactive';
        $model->save();
        return $this->redirect(['index', 'accion' => 'delete']);
        
        }else{
                return $this->goHome();
            }
        
        
    }

        public function actionRecuperar($id)
    {


        $session = Yii::$app->session;
          if (isset($session['user'])){

        $model =Producto::findOne($id);
        $model->estatusProducto ='Active';
        $model->save();
        return $this->redirect(['listaeliminados', 'accion' => 'update']);

        }else{
                return $this->goHome();
            }
        
    }

    public function actionListaeliminados(){
   


        $session = Yii::$app->session;
          if (isset($session['user'])){
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->searcheliminados(Yii::$app->request->queryParams);
        $session = Yii::$app->session;
            if (!$session->isActive){
                $session->open();// open a session 
            } 
        $session['Producto'] = Yii::$app->request->queryParams;
        return $this->render('listel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
            }else{
                return $this->goHome();
            }
}
    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
