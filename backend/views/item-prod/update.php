<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemProd */

$this->title = 'Update Item Prod: ' . $model->idItem_Prod;
$this->params['breadcrumbs'][] = ['label' => 'Item Prods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idItem_Prod, 'url' => ['view', 'id' => $model->idItem_Prod]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-prod-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
