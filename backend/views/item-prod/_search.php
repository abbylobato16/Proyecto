<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemProdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-prod-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

 <div class="busqueda">
       
         <?= $form->field($model, 'globalSearch')->textInput(array('placeholder' => 'Buscar'))->label('') ?>

    </div>
<br>
    <?php ActiveForm::end(); ?>

</div>
