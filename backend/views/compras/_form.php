<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\Producto;
use backend\models\Proveedores;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\JuiAsset;
use yii\web\JsExpression;
use kartik\file\FileInput;
use dosamigos\datepicker\DatePicker;
//use backend\models\Image;
//use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\Compras */
/* @var $form yii\widgets\ActiveForm */

$mensaje=null;
?>

<div class="compras-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false,
    'enableAjaxValidation' => false,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]

    ]); ?>

    <?= $form->field($model, 'NoFactura')->textInput(['placeholder' => 'Número de Factura.'])?>

     <!--?= $form->field($model, 'Proveedores_idproveedor')->dropDownList(
                ArrayHelper::map(Proveedores::find()->all(),'idproveedor','nomproveedor'),
                [
                    'prompt'=>'Seleccione el Proveedor...',
                    'onchange'=>
                    '$.post( "index.php?r=Proveedor/lists&id='.'"+$(this).val(), function( data ) {
                    $( "select#models-contact" ).html( data );
                });'

                ]); ?-->

     <?= $form->field($model, 'Proveedores_idproveedor')->dropDownList(
                ArrayHelper::map(Proveedores::find()->where(['estatusproveedor' => 'Active'])->all(),'idproveedor','nomproveedor'),

                [
                    'prompt'=>'Seleccione el Proveedor.',
                    'onchange'=>
                    '$.post( "index.php?r=Proveedor/lists?id='.'"+$(this).val(), function( data ) {
                    $( "select#models" ).html( data );
                });'

                ]); ?>


    <?= $form->field($model, 'Fecha')->widget(
                    DatePicker::className(), [
                        // inline too, not bad
                         'inline' => false, 
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ],'options' => [
                                           // 'class'=>'cust-form-control dob',
                                            'placeholder'=>'Seleccione la Fecha de Compra.']
                ]);?>


    <?= $form->field($model, 'PrecioTotal')->textInput(['placeholder' => "Precio Total de la Compra."]) ?>
  <?php echo "<div class='alert alert-info'>Separe los dígitos con <strong>','</strong> . Ejemplo: 100,000.00</div>"?>
    <?= $form->field($model, 'Titular')->textInput(['maxlength' => true,'placeholder' => "Nombre Completo del Titular."]) ?>

 
    <?= $form->field($model, 'Mantenimiento')->dropDownList([ 'Si' => 'Si', 'No' => 'No', ], 
        ['prompt' => 'Seleccione si el producto tiene mantenimiento...',
            'onchange'=>'Mantenimiento()',
            'id'=>'selectManto']) ?>
<script>
function Mantenimiento() {


    var valor = document.getElementById("selectManto").value;
if(valor=='Si'){
document.getElementById("demo").innerHTML = "<div class='alert alert-info'><center>Todos los productos que registrará deben ser <strong>CON MANTENIMIENTO</strong></center></div>";

}if(valor=='No'){
  document.getElementById("demo").innerHTML = "<div class='alert alert-success'><center>Todos los productos que registrará deben ser <strong>SIN MANTENIMIENTO</strong></center></div>";
}

}
</script>

<div id="demo">
  
<?php echo $mensaje;?>
</div>
        <br>
        <br>



        <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-large"></i> Productos</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 20, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsItemProd[0],
                'formId' => 'dynamic-form',
                'formFields' => [
'Cantidad',
'Precio',
'Importe',
'Vencimiento',
'Producto_idProducto',
'Proveedores_idproveedor',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsItemProd as $i => $modelsItemProd): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> </h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div> 
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelsItemProd->isNewRecord) {
                                echo Html::activeHiddenInput($modelsItemProd, "[{$i}]Compras_idCompra");
                            }
                        ?>


                        <div class="row">

                             <div class="col-sm-6">
                                <?= $form->field($modelsItemProd, "[{$i}]Producto_idProducto")->dropDownList(
                                        ArrayHelper::map(Producto::find()->where(['estatusProducto' =>'Active'])->all(),'idProducto','nombresw'),
                                        [
                                            'prompt'=>'Seleccione el Producto.',
                                            'onchange'=>
                                            '$.post( "index.php?r=Producto/lists&id='.'"+$(this).val(), function( data ) {
                                            $( "select#models-contact" ).html( data );
                                        });'

                                        ]); ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelsItemProd, "[{$i}]Cantidad")->textInput(['maxlength' => true,'placeholder' => "Cantidad de Productos."]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelsItemProd, "[{$i}]Precio")->textInput(['maxlength' => true,'placeholder' => "Precio Individual."]) ?>
                                <?php echo "<div class='alert alert-info'>Separe los dígitos con <strong>','</strong> . Ejemplo: 100,000.00</div>"?>
  
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelsItemProd, "[{$i}]Importe")->textInput(['maxlength' => true,'placeholder' => "Importe Total."]) ?>
                                <?php echo "<div class='alert alert-info'>Separe los dígitos con <strong>','</strong> . Ejemplo: 100,000.00</div>"?>
  
                            </div>
                             <div class="col-sm-6">


<?php
$this->registerJs(' 
$(function () {
    $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        $( ".dob" ).each(function() {
           $( this ).datepicker({
              dateFormat : "dd-mm-yy",
              yearRange : "1925:+0",
              maxDate : "-1D",
              changeMonth: true,
              changeYear: true
           });
      });          
    });
});
$(function () {
    $(".dynamicform_wrapper").on("afterDelete", function(e, item) {
        $( ".dob" ).each(function() {
           $( this ).removeClass("hasDatepicker").datepicker({
              dateFormat : "dd-mm-yy",
              yearRange : "1925:+0",
              maxDate : "-1D",
              changeMonth: true,
              changeYear: true
           });
      });          
    });
});
');


?>
                                <?= $form->field($modelsItemProd, "[{$i}]Vencimiento")->widget(DatePicker::className(), [
                                        // inline too, not bad
                                         'inline' => false, 
                                         // modify template for custom rendering
                                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd',
                                        ],
                                        'options' => [
                                            'class'=>'cust-form-control dob',
                                            'placeholder'=>'Seleccione la Fecha de Vencimiento.']
                                ]);?>
                            </div>

                            
                             
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>


            <br>
        <br>
  <?php
$img = '';
$namefile='';
                            if ($model->image_web_filename!='') {
                                //$pathImg ='uploads/'.$model->image_web_filename.'' ;
                                //$initialPreview[] = Html::embed($pathImg);

                               $img='<embed src="uploads/'.$model->image_web_filename.'" style="width:70%;height:100%;">';
                               $namefile=$model->image_src_filename;
                            }
   //  if ($model->image_web_filename!='') {
    //    $img='"uploads/'.$model->image_web_filename.'"';
        
         //           }  

    ?>
  
  <?=$form->field($model, 'file')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*','id' => 'input-pd',],
               'pluginOptions'=>[
                    'allowedFileExtensions'=>['jpg','pdf','png','jpeg'],
                    'showUpload' => false, 'uploadAsync'=> false,
                    'overwriteInitial'=> true,
                    'initialPreview'=>[ $img],
                    'msgSelected'=>$namefile,
                    'initialPreviewCount'=>false,
                    'msgPlaceholder'=>'Seleccione el archivo...',
                    'dropZoneTitle'=>'Arrastre y suelte archivos aquí',
                    'browseLabel'=>' Buscar ',
                    'removeLabel'=>' Eliminar ',
                    
     ], 
          ]);  ?>

            <br>
        <br>

    <div class="form-group">
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-default']) ?>  
       <?= Html::submitButton($modelsItemProd->isNewRecord ? 'Guardar' : 'Guardar Cambios', ['class' => 'btn btn-primary']) ?>
    </div>

   <?php ActiveForm::end(); ?> 

</div>
