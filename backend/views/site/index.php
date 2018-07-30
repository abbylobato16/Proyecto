<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;
use kartik\grid\DataColumn;
//use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemProdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
//use backend\assets\DashboardAsset;

//DashboardAsset::register($this);
use backend\assets\AppAsset;

AppAsset::register($this);
$this->title = 'Inicio';
?>


<div class="site-index">


<!--div class="jumbotron text-center"-->
  <h2>¡Bienvenido
  <?php $firtsname=Yii::$app->user->identity->firts_name; $lastname=Yii::$app->user->identity->last_name; echo $firtsname.' '.$lastname;  ?> !</h2>

<!--/div-->

<br>

<br>

<!--div class="panel panel-danger">
    <div class="panel-heading">Productos Expirados</div>
    <div class="panel-body ">
 <div class="row">
  <?php //foreach ($searchModelItemProd as $searchModelItemProd): ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon "><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">

                <h5><b>No. Factura: 
                <?php// echo $searchModelItemProd->comprasIdCompra->NoFactura; 
                ?></b></h5></span>
              <span class="info-box-text"> 
                <h6>
                Producto: <?php //echo $searchModelItemProd->productoIdProducto->nombresw; echo '<br>';
                ?>
                Vencimiento:<?php// echo $searchModelItemProd->Vencimiento; //echo '<br><br>'  ?>
                </h6>
                </span>
            </div>
        
          </div>
</div>
<?php //endforeach; ?>
</div>

    </div>
  </div-->



<div class="panel panel-danger">
    <div class="panel-heading">Productos Expirados</div>
    <div class="panel-body ">
 <div class="row">
     <?php foreach ($searchModelItemProd as $searchModelItemProd): ?>
        <div class="col-md-3">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                 <h3 class="box-title">No. Factura: 
                <?php echo $searchModelItemProd->comprasIdCompra->NoFactura; 
                ?>
              </h3>
              
            </div>
            <div class="box-body">
               
              <center><h4><b><?php echo $searchModelItemProd->productoIdProducto->nombresw; echo '<br><br>';
                ?></b></h4></center>
               
               <b>Cantidad:</b> 
                <?php echo $searchModelItemProd->Cantidad; echo '<br>'
                ?>
                <b>Fecha de Compra: </b>
                <?php echo $searchModelItemProd->comprasIdCompra->Fecha; echo '<br>'
                ?>
                <b>Fecha de Vencimiento: </b> 
              <?php echo $searchModelItemProd->Vencimiento; echo '<br><br>'  ?>


                     
        <?= Html::a('Ver Compra', ['/compras/view','id' => $searchModelItemProd->Compras_idCompra], ['class' => 'btn btn-default']) ?>

            </div>
          </div>
        </div>
            <?php endforeach; ?>
      </div>
</div></div></div>




<div class="panel panel-warning">
    <div class="panel-heading">Productos Próximos a Expirar</div>
    <div class="panel-body">

<div class="row">

    <?php foreach ($searchModelItemProd2 as $searchModelItemProd2): ?>
        <div class="col-md-3">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                 <h3 class="box-title">No. Factura: 
                <?php echo $searchModelItemProd2->comprasIdCompra->NoFactura; 
                ?>
              </h3>
              
            </div>
            <div class="box-body">
               
              <center><h4><b><?php echo $searchModelItemProd2->productoIdProducto->nombresw; echo '<br><br>';
                ?></b></h4></center>
               
               <b>Cantidad:</b> 
                <?php echo $searchModelItemProd2->Cantidad; echo '<br>'
                ?>
                <b>Fecha de Compra: </b>
                <?php echo $searchModelItemProd2->comprasIdCompra->Fecha; echo '<br>'
                ?>
                <b>Fecha de Vencimiento: </b> 
              <?php echo $searchModelItemProd2->Vencimiento; echo '<br><br>'  ?>


                     
        <?= Html::a('Ver Compra', ['/compras/view','id' => $searchModelItemProd2->Compras_idCompra], ['class' => 'btn btn-default']) ?>

            </div>
          </div>
        </div>
            <?php endforeach; ?>

  <?php //foreach ($searchModelItemProd2 as $searchModelItemProd2): ?>
        <!--div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon "><i class="fa fa-warning"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">
                <h5><b>No. Factura: 
                <?php //echo $searchModelItemProd2->comprasIdCompra->NoFactura; 
                ?></b></h5></span>
              <span class="info-box-text">  <h6>
                  Producto: <?php //echo $searchModelItemProd2->productoIdProducto->nombresw; echo '<br>';
                ?>

                Vencimiento:
              <?php //echo $searchModelItemProd2->Vencimiento; //echo '<br><br>'  ?>
                </h6></span>
            </div>
          </div>
</div-->
<?php //endforeach; ?>
</div>
    </div>
  </div>


</div> 
