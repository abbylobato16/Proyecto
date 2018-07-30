<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sitios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sitios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreSitio')->textInput(['maxlength' => true,'placeholder' => "Nombre del Sitio Web."]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true,'placeholder' => "Link del Sitio."]) ?>

     <?= $form->field($model, 'email')->textInput(['maxlength' => true, ]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'placeholder' => "Usuario del Sitio."]) ?>

    <?= $form->field($model, 'passwords')->textInput(['maxlength' => true, 'placeholder' => "Contraseña del Sitio."]) ?>



    <div class="form-group">
       <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-default']) ?>  
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
