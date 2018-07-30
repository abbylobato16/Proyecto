<?php

namespace backend\controllers;

use Yii;
use backend\models\Compras;
use backend\models\ComprasSearch;
use backend\models\ItemProdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ItemProd;
use backend\models\ItemFile;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use mPDF;
/**
 * ComprasController implements the CRUD actions for Compras model.
 */
class ComprasController extends Controller
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
     * Lists all Compras models.
     * @return mixed
     */
    public function actionIndex()
    { 
          $session = Yii::$app->session;
          if (isset($session['user'])){
        $searchModel = new ComprasSearch();
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
     * Displays a single Compras model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

      $session = Yii::$app->session;
          if (isset($session['user'])){
        $searchModelCompras = new ComprasSearch();
        $dataProviderCompras = $searchModelCompras->searches($id);



       $searchModelItemProd = new ItemProdSearch();
        $dataProviderItemProd=$searchModelItemProd->searches($id);


        return $this->render('view', [
            'model' => $this->findModel($id),
           // 'searchModelItemProd' => $searchModelItemProd,
            'dataProviderCompras'=>$dataProviderCompras,
            'dataProviderItemProd'=>$dataProviderItemProd,
        ]);
            }else{
                return $this->goHome();
            }
       
    }



 public function actionReport($id) {
        $model= $this->findModel($id);
        $searchModel =new ComprasSearch();
        $dataProviderCompras = $searchModel->searches($id);
        $searchModelItemProd = new  ItemProdSearch();
        $dataProviderItemProd = $searchModelItemProd->searches($id);

        // get your HTML raw content without any layouts or scripts
        $content =  $this->renderPartial('report', [
         'model' =>$model,
        'searchModel' => $searchModel,
        'dataProviderCompras' => $dataProviderCompras,
        'dataProviderItemProd' => $dataProviderItemProd,
    ]);
      // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content, 
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            //'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
             // call mPDF methods on the fly
            'methods' => [
               'SetHeader'=>[date('d').'/'.date('m').'/'.date('Y')],
               'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        // http response
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
 
        // return the pdf output as per the destination setting
        return $pdf->render();
            
      
        }
    /**
     * Creates a new Compras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
 $session = Yii::$app->session;
          if (isset($session['user'])){
    $model = new Compras;
        $modelsItemProd = [new ItemProd];
        
    
        if ($model->load(Yii::$app->request->post())) {

/*---------------archivo---------------------*/

$file = UploadedFile::getInstance($model, 'file');
           if (!is_null($file)) {
             $model->image_src_filename = $file->name;
             $tmp = explode(".", $file->name);
              $ext=end($tmp);
              // generate a unique file name to prevent duplicate filenames
              $model->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
              // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)                       
              Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
              $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;

              //return $path;
               $file->saveAs($path);
             }

/*------------------------------------------*/

            $modelsItemProd = Model::createMultiple(ItemProd::classname());
            Model::loadMultiple($modelsItemProd, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsItemProd) && $valid;
            
            if ($valid ) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsItemProd as $modelsItemProd) {


                                $modelsItemProd->Compras_idCompra = $model->idCompra;
                                //$modelsItemFile->Compras_idCompra = $model->idCompra;

                                if (! ($flag = $modelsItemProd->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            
                            }
                    }
                
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index','accion' => 'insert']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }

}


        return $this->render('create', [
            'model' => $model,
            'modelsItemProd' => (empty($modelsItemProd)) ? [new ItemProd] : $modelsItemProd
            //'modelsItemFile' => (empty($modelsItemFile)) ? [new ItemFile] : $modelsItemFile
        ]);
          
            }else{
                return $this->goHome();
            }

    }

    /**
     * Updates an existing Compras model.
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
          $modelsItemProd = $model->itemProds;
          $oldFile= $model->image_src_filename;
          if ($model->load(Yii::$app->request->post())) {


  /*---------------archivo---------------------*/


  $fileq = UploadedFile::getInstance($model, 'file');
      if(isset($fileq)){
            $model->image_src_filename = $fileq->name;
               $tmp = explode(".", $fileq->name);
                $ext=end($tmp);
                $model->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
      } else {
          $model->image_src_filename = $oldFile;
      }

      if($model->save())
      {
          if(isset($fileq)){
  Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
                $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;
                 $fileq->saveAs($path);   
                      }
      }
  /*------------------------------------------*/



              $oldIDs = ArrayHelper::map($modelsItemProd, 'idItem_Prod', 'idItem_Prod');
              $modelsItemProd = Model::createMultiple(ItemProd::classname());
              Model::loadMultiple($modelsItemProd, Yii::$app->request->post());
              $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItemProd, 'idItem_Prod', 'idItem_Prod')));
              // validate all models
              $valid = $model->validate();
              $valid = Model::validateMultiple($modelsItemProd) && $valid;

              if ($valid) {
                  $transaction = \Yii::$app->db->beginTransaction();
                  try {
                      if ($flag = $model->save(false)) {
                          if (! empty($deletedIDs)) {
                              ItemProd::deleteAll(['idItem_Prod' => $deletedIDs]);
                          }
                          foreach ($modelsItemProd as $modelsItemProd) {
                              $modelsItemProd->Compras_idCompra = $model->idCompra;
                              if (! ($flag = $modelsItemProd->save(false))) {
                                  $transaction->rollBack();
                                  break;
                              }
                          }
                      }
                      if ($flag) {
                          $transaction->commit();
                          return $this->redirect(['index', 'accion' => 'update']);
                      }
                  } catch (Exception $e) {
                      $transaction->rollBack();
                  }
              }
          }

          return $this->render('update', [
              'model' => $model,
              'modelsItemProd' => (empty($modelsItemProd)) ? [new ItemProd] : $modelsItemProd
          ]);
            }else{
                return $this->goHome();
            }

        
    }



    /**
     * Deletes an existing Compras model.
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
       // $modelItemProd = [new ItemProd];
        $model = $this->findModel($id);
        $model->estatusCompra ='Inactive';
        $model->save();
        
        $modelItemProd = $model->itemProds;
   
      foreach ($modelItemProd as $modelItemProd) {
        $modelItemProd->estatusItemProd =$model->estatusCompra;
        $modelItemProd->save();
       }
      
        return $this->redirect(['index', 'accion' => 'delete']);
            }else{
                return $this->goHome();
            }
       
    }


    public function actionRecuperar($id)
    {
          $session = Yii::$app->session;
          if (isset($session['user'])){

        $model = $this->findModel($id);
        $model->estatusCompra ='Active';
        $model->save();
        $modelItemProd = $model->itemProds;
   
      foreach ($modelItemProd as $modelItemProd) {
        $modelItemProd->estatusItemProd =$model->estatusCompra;
        $modelItemProd->save();
       }
        return $this->redirect(['listaeliminados', 'accion' => 'update']);
            }else{
                return $this->goHome();
            }


    }

    public function actionListaeliminados(){


      $session = Yii::$app->session;
          if (isset($session['user'])){
        $searchModel = new ComprasSearch();
        $dataProvider = $searchModel->searcheliminados(Yii::$app->request->queryParams);

        return $this->render('listel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
            }else{
                return $this->goHome();
            }
    
}

    /**
     * Finds the Compras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compras::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
