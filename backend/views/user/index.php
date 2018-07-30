<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$mensaje=null;
  if(isset($_GET["accion"])){     
    if($_GET["accion"]=="update"){    
      $mensaje="<div class='alert alert-info'>
      <center>¡Datos <strong>Actualizados</strong>  Correctamente!</center></div>";
    }/*else if($_GET["accion"]=="insert"){    
      $mensaje="<div class='alert alert-success'>
      <center>¡Datos <strong>Ingresados</strong> Correctamente!</center></div>";
    }else if($_GET["accion"]=="delete"){    
      $mensaje="<div class='alert alert-danger'>
      <center>¡Datos <strong>Eliminados</strong> Correctamente!</center></div>";
    }else if($_GET["accion"]=="disable"){    
      $mensaje="<div class='alert alert-danger'>
      <center>¡Usuario <strong>Desactivado</strong> Correctamente!</center></div>";
    }*/
  }

$this->title = 'CONFIGURACIÓN';
$this->params['breadcrumbs'][] = 'Configuración';
?>
<div class="user-index">

    <center><h2><?= Html::encode($this->title) ?></h2>
    </center>

   <p>
          <?php //$icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-plus"]);?>
        <?php //Html::button($icon. ' Nuevo Usuario ',['value'=>Url::to('index.php?r=site/signup'),'class' => 'btn btn-default','id'=>'modalButton']) ?>
    </p>
<br>
<br>
<?php
        Modal::begin([
            'header'=>'<center><h2>Nuevo Usuario</h2></center>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);

        echo "<div id='modalContent'></div>";
        
        Modal::end();
 
    
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

             'firts_name',
            'last_name',
            'username',
            'email',

            ['class' => 'yii\grid\ActionColumnUsers'],
        ],
    ]); ?>

       <?php echo $mensaje;?>
<br>
     
</div>