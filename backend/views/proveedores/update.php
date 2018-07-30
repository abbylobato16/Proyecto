<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Proveedores */

$this->title = 'Editar Proveedor';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nomproveedor, 'url' => ['view', 'id' => $model->idproveedor]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="proveedores-update">

 <center><h2><?= Html::encode($this->title) ?></h2></center>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
