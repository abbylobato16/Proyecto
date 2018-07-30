<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = 'Nuevo Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-create">

    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
