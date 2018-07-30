<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\file\FileInput;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;
use kartik\grid\DataColumn;
//use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
/* @var $model backend\models\Compras */
/* @var $dataProviderCompras yii\data\ActiveDataProvider */
/* @var $dataProviderItemProd yii\data\ActiveDataProvider */
$this->title = "NoFactura. " . $model->NoFactura;
$this->params['breadcrumbs'][] = ['label' => 'Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compras-view">

    <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-arrow-left"]);?>
    <?= Html::a($icon.' Volver', ['index'], ['class' => 'btn btn-default']) ?>
    <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-pencil"]);?>
     <?= Html::a($icon. ' Editar', ['update', 'id' => $model->idCompra], ['class' => 'btn btn-primary']) ?>
<br>



    <center><h2><?= Html::encode($this->title) ?></h2></center>
       
    
<br>
<?php
$gridColumns = [
            'NoFactura',
            'Fecha',
            'PrecioTotal',
            'Titular',
            'Mantenimiento',
            'proveedoresIdproveedor.nomproveedor',
            'image_src_filename',
];

$defaultStyle = [ 
    'font' => [ 'bold' => true ],    
    'fill' => [  
       'fillType' => 'FILL_SOLID' ,  
        'color' => [  
            'argb' => 'FFE5E5E5' ,  
        ],
    ],
    'fronteras' => [  
        'outline' => [  
            'borderStyle' => 'BORDER_MEDIUM' ,  
            'color' => [ 'argb' =>'COLOR_BLACK' ],    
        ],
        'adentro' => [  
            'borderStyle' => 'BORDER_THIN' ,  
            'color' => [ 'argb' => 'COLOR_BLACK' ],    
        ]
    ],
];


echo ExportMenu::widget([
    'dataProvider' => $dataProviderCompras,
    'columns' => $gridColumns,
    'exportConfig' => [ 
    ExportMenu::FORMAT_CSV => false , 
    ExportMenu::FORMAT_TEXT => false, 
    ExportMenu::FORMAT_HTML => false, 
    ExportMenu::FORMAT_EXCEL=>false,
],
    'filename'=>'Compras',
'showPageSummary' => false,
]);


$img = '';
$namefile='';
                            if ($model->image_web_filename!='') {
                               $img='<embed src="uploads/'.$model->image_web_filename.'" width="100%" height="100%" >';
                               //width="100%" height="100%"
                               $namefile=$model->image_src_filename;
                            }

                            if ($model->image_web_filename=='' || $model->image_src_filename=='') {
                            
                              echo GridView::widget([
                                'dataProvider' => $dataProviderCompras,
                                'columns' => [
                                    'NoFactura',
                                    'Fecha',
                                    'PrecioTotal',
                                    'Titular',
                                    'Mantenimiento',
                                    'proveedoresIdproveedor.nomproveedor',
                                    'image_src_filename',
            
                                ],
                            ]);
                            }else{

                            echo GridView::widget([
                            'dataProvider' => $dataProviderCompras,
                            'columns' => [
                                'NoFactura',
                                'Fecha',
                                'PrecioTotal',
                                'Titular',
                                'Mantenimiento',
                                'proveedoresIdproveedor.nomproveedor',
                                'image_src_filename',
                                
                                 ['class'=>'yii\grid\ActionColumnViewFILES'],   
                                
                                
                            ],
                        ]);
                            }
                      

?>


<div class="modal fade" id="Modalel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $namefile?></h5>
      </div>
      <div class="modal-body-view" >
       <?php
      echo  $img;
      ?>
      </div>
    </div>
  </div>
</div>

       

    <br>
<?php
$gridColumns2 = [
            'comprasIdCompra.NoFactura',
            'Cantidad',
            'productoIdProducto.clave',
            'productoIdProducto.nombresw',
            'productoIdProducto.descripcion',
            'Precio',
            'Importe',
            ['attribute' => 'Vencimiento',
            'format'    => 'raw',
            'value'     => function ($model) {
                if ($model->Vencimiento != null) {
                    return $model->Vencimiento; 
              //or: return Html::encode($model->some_attribute)
                } else {
                    return 'Perpetua';
                }
            },],
];


echo ExportMenu::widget([
    'dataProvider' => $dataProviderItemProd,
    'columns' => $gridColumns2,
    'exportConfig' => [ 
    ExportMenu::FORMAT_CSV => false , 
    ExportMenu::FORMAT_TEXT => false, 
    ExportMenu::FORMAT_HTML => false, 
    ExportMenu::FORMAT_EXCEL=>false,
],
    'filename'=>'Compras',
//'showPageSummary' => false,
]);



?>

<?php


//foreach ($searchModelItemProd as $searchModelItemProd) {
    echo GridView::widget([
        'dataProvider' => $dataProviderItemProd,
        'columns' => [
          //  'comprasIdCompra.NoFactura',
            'Cantidad',
            'productoIdProducto.clave',
            'productoIdProducto.nombresw',
            'productoIdProducto.descripcion',
            'Precio',
            'Importe',
            [
            'attribute' => 'Vencimiento',
            'format'    => 'raw',
            'value'     => function ($model) {
                if ($model->Vencimiento != null) {
                    return $model->Vencimiento; 
              //or: return Html::encode($model->some_attribute)
                } else {
                    return 'Perpetua';
                }
            }, 
        ],

        ],
    ]); //}



    ?>

<br>
<?= Html::a('Generar Reporte Completo', ['report','id' => $model->idCompra], ['class' => 'btn btn-default']) ?>



</div>
