<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
        <div class="login-box-body">
                <p  class="login-box-msg">Registrarse</p>

            <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>

                <?= $form->field($model, 'firts_name') ?>
                
                <?= $form->field($model, 'last_name') ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
             
               <div class="modal-footer">
        <?= Html::button('Cancelar', ['class' => 'btn btn-default','data-dismiss'=>'modal']) ?>
         <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>


</div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>


<?php 
$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e)
{

        var \$form = $(this);
        $.post(
            \$form.attr("action"),
            \$form.serialize()

        )
            .done(function(result){
                if(result == 1)
              {
                   
                    $(\$form).trigger("reset");
                    $.pjax.reload({container:'#commodity-grid'});
                }else{
                    
                    $("#message").html(result);
                       
                }
                }).fail(function()
                {
                    console.log("server error");
                    });
            return false;

    });

JS;
$this->registerJs($script);
?>