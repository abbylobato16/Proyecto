<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;
use kartik\grid\DataColumn;
use dosamigos\datepicker\DatePicker;
//use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemProdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'PRODUCTOS COMPRADOS';
$this->params['breadcrumbs'][] = 'Productos Compras';
?>
<div class="item-prod-index">

   <center> <h2><?= Html::encode($this->title) ?></h2></center>
    
    <!--?php  echo $this->render('_search', ['model' => $searchModel]); ?-->
        <p>
       <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-th-large"]);?>
        <?= Html::a($icon. ' Ver Por Compras', ['/compras'], ['class' => 'btn btn-primary']) ?>
    </p>
      <br>
<br>
<?php
$gridColumns1 = [
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
    'filename'=>'ProductosComprados',
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
    'filename'=>'ProductosComprados',
]);
}







?>




<br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns'=> [ 
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'No.Factura',
                'attribute'=>'Compras_idCompra',
                'value'=>'comprasIdCompra.NoFactura',

            ],
            
            'Cantidad',
             [
                'label'=>'Clave:',
                'attribute'=>'clavefk',
                'value'=>'productoIdProducto.clave',

            ],
            [
                'label'=>'Producto:',
                'attribute'=>'nombreswfk',
                'value'=>'productoIdProducto.nombresw',

            ],
             [
                'label'=>'Descripción:',
                'attribute'=>'descripcionfk',
                'value'=>'productoIdProducto.descripcion',

            ],
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
           'filter'=>DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'Vencimiento',
                    //'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                ])
        ],
           
        ],
    ]); ?>


</div>
