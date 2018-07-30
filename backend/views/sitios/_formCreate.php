<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sitios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sitios-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>

   <?= $form->field($model, 'nombreSitio')->textInput(['maxlength' => true,'placeholder' => "Nombre del Sitio."]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true,'placeholder' => "Link del Sitio."]) ?>

     <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder'=>'Correo Electronico.']) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'placeholder' => "Usuario del Sitio."]) ?>

    <?= $form->field($model, 'passwords')->textInput(['maxlength' => true, 'placeholder' => "Contraseña del Sitio."]) ?>



    <div class="modal-footer">
        <?= Html::button('Cancelar', ['class' => 'btn btn-default','data-dismiss'=>'modal']) ?>
         <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>


</div>

    <?php ActiveForm::end(); ?>

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