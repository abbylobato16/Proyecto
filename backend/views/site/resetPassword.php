<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'RESTABLECER CONTRASEÑA';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login">
   

             <h2><?= Html::encode($this->title) ?></h2>
             <br>
    <p>Por favor, llene los siguientes campos.</p>




   
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <div class="form-group">
                <?= $form->field($model, 'email')->input('email') ?>  
                </div>
                <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                </div>
                <div class="form-group">
                 <?= $form->field($model, "password_repeat")->input("password") ?>  
                </div>
                <div class="form-group">
                <?= $form->field($model, "verification_code")->input("text") ?>  
                </div>
                <div class="form-group">
                 <?= $form->field($model, "recover")->input("hidden")->label(false) ?>  
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                           <?= Html::a('Cancelar', ['login'], ['class' => 'btn btn-default']) ?>
                </div>


            <?php ActiveForm::end(); ?>
    <?php echo $msg ?>
</div>
