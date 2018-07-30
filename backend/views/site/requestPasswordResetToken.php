<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$mensaje=null;
  if(isset($_GET["accion"])){     
    if($_GET["accion"]=="info"){    
      $mensaje="<div class='alert alert-info'>
      <center>Le hemos enviado un mensaje a su cuenta de correo para que pueda restablecer su contraseña.</center></div>";
    }
  }
$this->title = 'RECUPERAR CONTRASEÑA';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login">
   <h2><?= Html::encode($this->title) ?></h2>

   <br>
    <p>Por favor, ingresa tu Email. </p>


            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                
                <div class="form-group">
                      <?= Html::a('Cancelar', ['login'], ['class' => 'btn btn-default']) ?>
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                         
                </div>

            <?php ActiveForm::end(); ?>


            <?php echo $mensaje;?>

    </div>
</div>
