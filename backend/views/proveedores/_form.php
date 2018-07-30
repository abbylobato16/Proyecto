<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Proveedores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomproveedor')->textInput(['maxlength' => true,'placeholder' => "Nombre del Proveedor."]) ?>

    <?= $form->field($model, 'razonsocial')->textInput(['maxlength' => true,'placeholder' => "Razon Social del Proveedor."]) ?>

    <!--?= $form->field($model, 'estatusproveedor')->textInput() ?-->

    <div class="form-group">
      
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-default']) ?>  
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
