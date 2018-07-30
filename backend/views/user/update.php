<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Editar Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="user-update">

 <center>   <h2><?= Html::encode($this->title) ?></h2></center>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
