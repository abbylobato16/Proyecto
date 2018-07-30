<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemProd */

$this->title = $model->idItem_Prod;
$this->params['breadcrumbs'][] = ['label' => 'Item Prods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prod-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idItem_Prod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idItem_Prod], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idItem_Prod',
            'Cantidad',
            'Precio',
            'Vencimiento',
            'Producto_idProducto',
            'Compras_idCompra',
        ],
    ]) ?>

</div>
