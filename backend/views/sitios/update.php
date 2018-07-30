<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sitios */

$this->title = 'Editar Sitio ';
$this->params['breadcrumbs'][] = ['label' => 'Sitios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreSitio, 'url' => ['view', 'id' => $model->idSitio]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="sitios-update">
<center><h2><?= Html::encode($this->title) ?></h2></center>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
