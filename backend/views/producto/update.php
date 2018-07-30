<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = 'Editar Producto ';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombresw, 'url' => ['view', 'id' => $model->idProducto]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="producto-update">

  <center>  <h2><?= Html::encode($this->title) ?></h2></center>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
