<?php
/* @var $dir string */
/* @var $usuario array */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><?=strtoupper(substr(Yii::$app->name, 0, 3))?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><?=Yii::$app->name?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=$usuario['foto']?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?=$usuario['nome']?></span>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?=$usuario['foto']?>" class="img-circle" alt="User Image">

                            <p>
                                <?=$usuario['nome']?>
                                <small><?=$usuario['tipo']?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?=Html::a('<i class="fa fa-user"></i> Perfil', ['/site/profile'], ['class' => 'btn btn-default btn-flat'])?>
                            </div>
                            <div class="pull-right">
                                <?=Html::beginForm(['/site/logout'], 'post')?>
                                <?=Html::submitButton(
                                    '<i class="fa fa-sign-out"></i> Sair',['class' => 'btn btn-default btn-flat']
                                )?>
                                <?=Html::endForm()?>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
