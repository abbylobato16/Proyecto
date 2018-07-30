<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="busqueda">
        <?php /*$icon = Html::tag('i', '', ['class' => "glyphicon glyphicon-search"]);?>
        <?= Html::submitButton($icon, ['class' => 'btn btn-default']) */?>
      
         <?= $form->field($model, 'globalSearch')->textInput(array('placeholder' => 'Buscar'))->label('') ?>

    </div>
<br>
    <?php ActiveForm::end(); ?>

</div>
