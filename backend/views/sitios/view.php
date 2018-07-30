<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sitios */

$this->title = $model->nombreSitio;
$this->params['breadcrumbs'][] = ['label' => 'Sitios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitios-view">
    <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-arrow-left"]);?>
    <?= Html::a($icon.' Volver', ['index'], ['class' => 'btn btn-default']) ?>
<br>
    <center><h2>Sitio: <?= Html::encode($this->title) ?></h2></center>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idSitio',
            'nombreSitio',
            'url:url',
            'username',
            'passwords',
            'email:email',
        ],
    ]) ?>

</div>
