<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ItemProd */

$this->title = 'Create Item Prod';
$this->params['breadcrumbs'][] = ['label' => 'Item Prods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
