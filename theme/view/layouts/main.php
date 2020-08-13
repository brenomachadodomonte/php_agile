<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

$themeOptions = require  __DIR__ . '/../../config.php';
$dir = Url::base() . '/web/admin-assets/';
$cssBase = $this->theme->getUrl('css');
$jsBase = $this->theme->getUrl('js');
$usuario = [
    'nome' => Yii::$app->user->isGuest ? 'Visitante' : Yii::$app->user->identity->name,
    'foto' => $this->theme->getUrl('img/default-user.jpg'),
    'tipo' => 'Teste',
    'type' => '1',
];
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <base href="<?=Yii::$app->homeUrl?>" data-controller="<?=Yii::$app->controller->id?>" data-action="<?=Yii::$app->controller->action->id?>"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->name ?> | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=$cssBase?>/bootstrap/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=$cssBase?>/font-awesome/css/font-awesome.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=$cssBase?>/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=$cssBase?>/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=$cssBase?>/iCheck/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=$cssBase?>/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=$cssBase?>/admin/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=$cssBase?>/admin/styles.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=$cssBase?>/admin/skins/<?=$themeOptions['skin']?>.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <?php foreach($this->myCssFiles as $css) { ?>
        <link rel="stylesheet" href="<?=$cssBase?>/src/css/<?=$css?>">
    <?php } ?>
</head>
<body class="hold-transition <?=$themeOptions['skin']?> sidebar-mini <?=$themeOptions['fixed']?'fixed':''?>">
<?php $this->beginBody() ?>
<div id="preloader">
    <div id="loader">
        <span class="fa fa-spinner fa-spin"></span>
    </div>
</div>
<div class="wrapper">
    <?= $this->render('_header', ['usuario'=>$usuario]) ?>
    <?= $this->render('_left', ['usuario'=>$usuario]) ?>
    <?= $this->render('_content', ['content'=>$content]) ?>
    <?= $this->render('_footer') ?>
</div>
<!-- ./wrapper -->
<?php $this->endBody() ?>
<!-- jQuery 3 -->
<script src="<?=$jsBase?>/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=$jsBase?>/bootstrap/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?=$jsBase?>/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?=$jsBase?>/inputmask/jquery.inputmask.bundle.js"></script>
<!-- MaskMoney -->
<script src="<?=$jsBase?>/mask-money/jquery.maskMoney.min.js"></script>

<!-- date-range-picker -->
<script src="<?=$jsBase?>/moment/moment.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=$jsBase?>/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?=$jsBase?>/bootstrap-datepicker/bootstrap-datepicker.pt-BR.min.js"></script>
<!-- SlimScroll -->
<script src="<?=$jsBase?>/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?=$jsBase?>/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?=$jsBase?>/fastclick/fastclick.js"></script>

<script src="<?=$jsBase?>/sweetalert2/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$jsBase?>/admin/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$jsBase?>/admin/demo.js"></script>

<script src="<?=$jsBase?>/admin/default.js"></script>

<?php foreach($this->myJsFiles as $js) { ?>
    <script src="<?=$jsBase?>/src/js/<?=$js?>"></script>
<?php } ?>
</body>
</html>
<?php $this->endPage() ?>

