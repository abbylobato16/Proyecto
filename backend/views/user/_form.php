<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'firts_name') ?>
                
                <?= $form->field($model, 'last_name') ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

        
                <div class="form-group">
                      <?= Html::a('Cancelar', ['user/index'], ['class' => 'btn btn-default']) ?>
                    <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                         
                </div>

    <?php ActiveForm::end(); ?>

</div>
