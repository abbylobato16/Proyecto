<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
      <center>¡Usuario <strong>Eliminado</strong> Correctamente!</center></div>";
    }else if($_GET["accion"]=="enable"){    
      $mensaje="<div class='alert alert-info'>
      <center>¡Usuario <strong>Activado</strong> Correctamente!</center></div>";
    }
  }

$this->title = 'HISTORIAL DE USUARIOS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
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

             'firts_name',
            'last_name',
            'username',
            'email',
            ['class' => 'yii\grid\ActionColumnRecuperaUsers'],
        ],
    ]); ?>

       <?php echo $mensaje;?>
       <br>
</div>
