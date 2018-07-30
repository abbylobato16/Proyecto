<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = $model->nombresw;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-view">
    <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-arrow-left"]);?>
    <?= Html::a($icon.' Volver', ['index'], ['class' => 'btn btn-default']) ?>
<br>
    <center><h2>Producto: <?= Html::encode($this->title) ?></h2></center>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idProducto',
            'nombresw',
            'descripcion',
            'version',
           // 'estatusProducto',
        ],
    ]) ?>

</div>
