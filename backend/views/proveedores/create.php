<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Proveedores */

$this->title = 'NUEVO PROVEEDOR';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-create">

    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
