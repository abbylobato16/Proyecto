<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\dialog\Dialog;


echo Dialog::widget(['overrideYiiConfirm' => true]);



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
  
    if (Yii::$app->user->isGuest) {
   $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
      $span=Html::tag('span', '', ['class' => "glyphicon glyphicon-wrench"]);

      $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-print"]);

         $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index'] ],
        ['label' => 'Proveedores', 'url' => ['/proveedores/index']],
        ['label' => 'Productos', 'url' => ['/producto/index']],
        ['label' => 'Compras', 'url' => ['/compras/index']],
        ['label' => 'Sitios', 'url' => ['/sitios/index']],
    ];
         $menuItems[] = '
         <li class "dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span>' . Yii::$app->user->identity->username . '</span>
          </a>
          
           <ul class="dropdown-menu">
           <div class="visible-xs">
           <li>' . Html::a($span. ' Config',['user/index'],
                                    ['class' => 'btn btn-default btn-flat']) .
                '</li>
                <br>
           <li>  '. Html::Button(
                'Salir',
                ['class' => 'btn btn-primary btn-flat','data-toggle'=>'modal','data-target'=>'#Modal','id'=>'logout']
            ) .'</li>

           </div>
           <div class="headyfot">
                <center>  <p><b>'.Yii::$app->user->identity->firts_name.' '.Yii::$app->user->identity->last_name.'</b><br>
                  <small>' . Yii::$app->user->identity->username . '</small>
                  </p></center>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                      ' . Html::a($span. ' Config',['user/index'],
                                    ['class' => 'btn btn-default btn-flat']) .
                '
                </div>
                <div class="pull-right">
                '. Html::Button(
                'Salir',
                ['class' => 'btn btn-primary btn-flat','data-toggle'=>'modal','data-target'=>'#Modal','id'=>'logout']
            ) .'
                </div>
              </li>
            </div>
            </ul>
         
           
          </li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <center><h4 id="messageLogout">¿Seguro que desea cerrar la sesión?</h4></center> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <span class="glyphicon glyphicon-ban-circle"></span> Cancelar</button>

        <button hidden=""> <?php 
 $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-log-out"]);
$btn[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                $icon. ' Cerrar Sesión',
                ['class' => 'btn btn-primary']
            )
            . Html::endForm()
            . '</li>';
   echo Nav::widget([
       // 'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $btn,
    ]);
        ?></button>
        
      </div>
    </div>
  </div>
</div>
        <?= $content ?>
    </div>
</div>





<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>