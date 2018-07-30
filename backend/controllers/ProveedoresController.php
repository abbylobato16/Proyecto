<?php

namespace backend\controllers;

use Yii;

use backend\models\Proveedores;
use backend\models\ProveedoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use mPDF;
/**
 * ProveedoresController implements the CRUD actions for Proveedores model.
 */
class ProveedoresController extends Controller
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
     * Lists all Proveedores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProveedoresSearch();
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
     * Displays a single Proveedores model.
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
     * Creates a new Proveedores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proveedores();

        if ($model->load(Yii::$app->request->post())) {
            
             if($model->save()){
                        echo 1;
 return $this->redirect(['index', 'accion' => 'insert']);
                    }else{
                        echo 0;
                    }
        }


        $session = Yii::$app->session;
          if (isset($session['user'])){
             return $this->renderAjax('create', [
                        'model' => $model,
                        
                    ]);
            }else{
                return $this->goHome();
            }
        
    }

    /**
     * Updates an existing Proveedores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'accion' => 'update']);
             //header("Location: index.php=insert");
        }
$session = Yii::$app->session;
          if (isset($session['user'])){
 return $this->render('update', [
            'model' => $model,
        ]);
            }else{
                return $this->goHome();
            }
        
    }

     public function actionTemporaly($id)
    {
        

        $session = Yii::$app->session;
          if (isset($session['user'])){

            $model =Proveedores::findOne($id);
        $model->estatusproveedor ='Inactive';
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
        $model =Proveedores::findOne($id);
        $model->estatusproveedor ='Active';
        $model->save();
        return $this->redirect(['listaeliminados', 'accion' => 'enable']);
            }else{
                return $this->goHome();
            }
        
    }

    public function actionListaeliminados(){
         
        $session = Yii::$app->session;
          if (isset($session['user'])){

    $searchModel = new ProveedoresSearch();
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


    /**
     * Deletes an existing Proveedores model.
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



    /**
     * Finds the Proveedores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proveedores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proveedores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
