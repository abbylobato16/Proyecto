<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Proveedores;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProveedoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'HISTORIAL DE PROVEEDORES';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Historial de Proveedores';

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
<div class="proveedores-index">
    <center><h2><?= Html::encode($this->title) ?></h2></center>
<br>

<?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-arrow-left"]);?>

     <?= Html::a($icon.' Volver', ['index'], ['class' => 'btn btn-default']) ?>
<br><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'idproveedor',
            'nomproveedor',
            'razonsocial',
            //'estatusproveedor',
            ['class' => 'yii\grid\ActionColumnRecupera'],
        ],
    ]); ?>



       <?php echo $mensaje;?>

<br>
     
</div>
