<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Compras */

$this->title = 'Editar Compra';
$this->params['breadcrumbs'][] = ['label' => 'Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NoFactura, 'url' => ['view', 'id' => $model->idCompra]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="compras-update">

    <center><h2><?= Html::encode($this->title) ?></h2></center>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsItemProd'=>$modelsItemProd,
    ]) ?>

</div>