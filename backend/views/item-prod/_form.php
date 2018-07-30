<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemProd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-prod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Cantidad')->textInput() ?>

    <?= $form->field($model, 'Precio')->textInput() ?>

    <?= $form->field($model, 'Vencimiento')->textInput() ?>

    <?= $form->field($model, 'Producto_idProducto')->textInput() ?>

    <?= $form->field($model, 'Compras_idCompra')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
