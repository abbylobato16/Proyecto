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
<center><h2><?= Html::encode($this->title) ?></h2></center>
       

<?= GridView::widget([
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
?>

       

<?=GridView::widget([
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

            ]
        ],
    ]); //}



    ?>



    

</div>
