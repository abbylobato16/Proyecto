<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Proveedores */

$this->title = $model->nomproveedor;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-view">
    <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-arrow-left"]);?>
    <?= Html::a($icon.' Volver', ['index'], ['class' => 'btn btn-default']) ?>
<br>
    <center><h2>Proveedor: <?= Html::encode($this->title) ?></h2></center>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idproveedor',
            'nomproveedor',
            'razonsocial',
          //  'estatusproveedor',
        ],
    ]) ?>

</div>
