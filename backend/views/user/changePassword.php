<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\ChangePass */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambiar contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
   
    <div class="login-box-body">
        <div class="login-logo">

             <h2><?= Html::encode($this->title) ?></h2>
</div>
    <p>Por favor, ingrese su nueva contraseña:</p>



            <?php $form = ActiveForm::begin(); ?>
                <div class="form-group">
                <?= $form->field($model, 'oldpassword')->passwordInput(['autofocus' => true]) ?>
                </div>
                <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                </div>
                <div class="form-group">
                 <?= $form->field($model, "password_repeat")->input("password") ?>  
                </div>
                
                 <div class="form-group">
      
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-default']) ?>  
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php echo $msg ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
