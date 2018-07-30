<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'clave')->textInput(['maxlength' => true,'placeholder' => "Clave del Producto."]) ?>

    <?= $form->field($model, 'nombresw')->textInput(['maxlength' => true,'placeholder' => "Nombre del Producto."]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true,'placeholder' => "Escriba una descripción."]) ?>

    <?= $form->field($model, 'version')->textInput(['maxlength' => true,'placeholder' => "Versión del Producto."]) ?>

    <!--?= $form->field($model, 'estatusProducto')->textInput(['maxlength' => true]) ?-->

     <div class="form-group">
      
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-default']) ?>  
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
