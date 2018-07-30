<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Sitios */

$this->title = 'Create Sitios';
$this->params['breadcrumbs'][] = ['label' => 'Sitios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitios-create">

    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
