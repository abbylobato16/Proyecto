<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Proveedores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedores-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>

      <?= $form->field($model, 'nomproveedor')->textInput(['maxlength' => true,'placeholder' => "Nombre del Proveedor."]) ?>
    <?= $form->field($model, 'razonsocial')->textInput(['maxlength' => true,'placeholder' => "Razon Social del Proveedor."]) ?>


    <!--?= $form->field($model, 'estatusproveedor')->textInput() ?-->
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