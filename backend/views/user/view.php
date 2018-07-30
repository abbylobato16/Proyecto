<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-arrow-left"]);?>
    <?= Html::a($icon.' Volver', ['index'], ['class' => 'btn btn-default']) ?>
    <br>
    <center><h2>Usuario: <?= Html::encode($this->title) ?></h2></center>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'firts_name',
            'last_name',
            'username',
            'email',
            
        ],
    ]) ?>

</div>
