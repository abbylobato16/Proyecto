<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
 <div class="login-box">
   <div class="titlelogin"> <center><h1>SIGECS</h1></center>
    <center><h4>Sistema Gestor de Compras de Software.</h4></center>
    <br><br></div>
  <div class="login-box-body">

    <p class="login-box-msg">Inicia sesión para comenzar.</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username',['options'=>[
                        'tag'=>'div',
                        'class'=>'form-group field-loginform-username has-feedback required'
                ],
                        'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>{error}{hint}',
            ])->textInput(['placeholder'=>'Usuario']) ?>

                <?= $form->field($model, 'password',['options'=>[
                        'tag'=>'div',
                        'class'=>'form-group field-loginform-password has-feedback required'
                ],
                        'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}{hint}',
            ])->passwordInput(['placeholder'=>'Contraseña']) ?>


                <div>
                    <?= Html::a('Olvide mi contraseña.', ['site/request-password-reset'],['class'=>'olvcon']) ?>
                </div>

<br>


                <div class="form-group">
                  <div id="loginresponsive">
                        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                  </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

