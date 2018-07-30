<?php

use yii\helpers\Html;

use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\grid\DataColumn;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SitiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SITIOS';
$this->params['breadcrumbs'][] = 'Sitios';

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
<div class="sitios-index">

    <center><h2><?= Html::encode($this->title) ?></h2>
    </center>
    <!--?php //echo $this->render('_search', ['model' => $searchModel]); ?-->

    <p>
          <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-plus"]);?>
        <?= Html::button($icon. ' Nuevo Sitio ',['value'=>Url::to('index.php?r=sitios/create'),'class' => 'btn btn-default','id'=>'modalButton']) ?>
    </p>
     <br>

<br>
<?php
        Modal::begin([
            'header'=>'<center><h2>Nuevo Sitio</h2></center>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);

        echo "<div id='modalContent'></div>";
        
        Modal::end();
 
    
    ?>
   <?php
$gridColumns1 = [
           'nombreSitio',
            'url',
            'email:email',
            'username',
            'passwords',
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
    'filename'=>'Sitios',
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
    'filename'=>'Sitios',
]);
}





?>
<br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombreSitio',
            'url:url',
            'email',
            'username',
            'passwords',
            ['class' => 'yii\grid\ActionColumnProveedores'],
        ],
    ]); ?>


<?php echo $mensaje;?>
<br>
    </p>

     <?= Html::a('Ver Historial', ['listaeliminados'], ['class' => 'btn btn-default']) ?>
    
    
</div>
