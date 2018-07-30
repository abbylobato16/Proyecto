<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Compras */

$this->title = 'NUEVA COMPRA';
$this->params['breadcrumbs'][] = ['label' => 'Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compras-create">
    <center><h2><?= Html::encode($this->title) ?></h2></center>
        <br>
    <?= $this->render('_form', [
        'model' => $model,
        'modelsItemProd'=>$modelsItemProd,
    ]) ?>

</div>
