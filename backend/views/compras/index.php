<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;
use kartik\grid\DataColumn;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComprasSearch */
/* @var $model backend\models\Compras */
/* @var $dataProvider yii\data\ActiveDataProvider */
 

$this->title = 'COMPRAS';
$this->params['breadcrumbs'][] = 'Compras';


$mensaje=null;
  if(isset($_GET["accion"])){     
    if($_GET["accion"]=="update"){    
      $mensaje="<div class='alert alert-info'>
      <center>¡Datos <strong>Actualizados</strong>  Correctamente!</center></div>";
    }else if($_GET["accion"]=="insert"){    
      $mensaje="<div class='alert alert-success'>
      <center>¡Datos <strong>Ingresados</strong> Correctamente!</center></div>";
    }else if($_GET["accion"]=="delete"){    
      $mensaje="<div class='alert alert-danger'>
      <center>¡Datos <strong>Eliminados</strong> Correctamente!</center></div>";
    }
  }
?>


<div class="compras-index">
    <center><h2><?= Html::encode($this->title) ?></h2></center>



   <!--?php  echo $this->render('_search', ['model' => $searchModel]); ?-->
    <p>
       <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-plus"]);?>
        <?= Html::a($icon. ' Nueva Compra', ['create'], ['class' => 'btn btn-default']) ?>

       <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-th-large"]);?>
        <?= Html::a($icon. ' Ver Por Productos', ['/item-prod'], ['class' => 'btn btn-primary']) ?>
    </p>
 <br>

<br>

<?php
$gridColumns1 = [
            'NoFactura',
            'Fecha',
            'PrecioTotal',
            'Titular',
            'Mantenimiento',
            'proveedoresIdproveedor.nomproveedor',
            'image_src_filename',
];
$gridColumns2 = [];

if ($dataProvider->totalCount > 0) {
    echo ExportMenu::widget([

    'dataProvider' => $dataProvider,
    'columns' => $gridColumns1,
    'exportConfig' => [ 
    ExportMenu::FORMAT_CSV => false , 
    ExportMenu::FORMAT_TEXT => false, 
    ExportMenu::FORMAT_HTML => false,
    ExportMenu::FORMAT_EXCEL=>false,
],
    'filename'=>'Compras',
]);
}else{
    echo ExportMenu::widget([

    'dataProvider' => $dataProvider,
    'columns' => $gridColumns2,
    'exportConfig' => [ 
    ExportMenu::FORMAT_CSV => false , 
    ExportMenu::FORMAT_TEXT => false, 
    ExportMenu::FORMAT_HTML => false, 
    ExportMenu::FORMAT_PDF =>false, 
    ExportMenu::FORMAT_EXCEL =>false, 
    ExportMenu::FORMAT_EXCEL_X => false, 
],
    'filename'=>'Compras',
]);
}


?>
<br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'NoFactura',
            'Fecha',
            'PrecioTotal',
            'Titular',
            'Mantenimiento',
            [
                'attribute'=>'Proveedores_idproveedor',
                'value'=>'proveedoresIdproveedor.nomproveedor',
            ],
            
            'image_src_filename',

            ['class' => 'yii\grid\ActionColumnProveedores'],
        ],
    ]); ?>
    <?php echo $mensaje;?>
<br>
     <?= Html::a('Ver Historial', ['listaeliminados'], ['class' => 'btn btn-default']) ?> 


</div>
