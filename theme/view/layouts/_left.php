<?php
/* @var $dir string */
/* @var $usuario array */

$items = [];
if($usuario['type'] == 1){
    $items = [
        ['label' => 'Menu', 'options' => ['class' => 'header']],
        ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index']],
        ['label' => 'Planos', 'icon' => 'clipboard', 'url' => ['/plano'], 'active' => Yii::$app->controller->id == 'plano'],
        ['label' => 'Modelos', 'icon' => 'motorcycle', 'url' => ['/modelo'], 'active' => Yii::$app->controller->id == 'modelo'],
        ['label' => 'Preços', 'icon' => 'dollar', 'url' => ['/tabela-preco'], 'active' => Yii::$app->controller->id == 'tabela-preco'],
        ['label' => 'Concessionárias', 'icon' => 'building', 'url' => ['/concessionaria'], 'active' => Yii::$app->controller->id == 'concessionaria'],
        ['label' => 'Usuários', 'icon' => 'users', 'url' => ['/usuario'], 'active' => Yii::$app->controller->id == 'usuario'],
        ['label' => 'Versões', 'icon' => 'check-square-o', 'url' => ['/versao'], 'active' => Yii::$app->controller->id == 'versao'],
        /*['label' => 'DEV HELP', 'options' => ['class' => 'header']],
        ['label' => 'Configuration','url' => ['/site/config'], 'active' => Yii::$app->controller->id == 'versao'],
        ['label' => 'Pickers e Masks', 'url' => ['/site/config'], 'active' => Yii::$app->controller->id == 'versao'],
        ['label' => 'Fields', 'url' => ['/site/config'], 'active' => Yii::$app->controller->id == 'versao'],*/
    ];
} else if($usuario['type'] == 2){
    $items = [
        ['label' => 'Menu', 'options' => ['class' => 'header']],
        ['label' => 'Usuários', 'icon' => 'users', 'url' => ['/usuario-concessionaria'], 'active' => Yii::$app->controller->id == 'usuario-concessionaria'],
    ];
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=$usuario['foto']?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$usuario['nome']?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" id="search-menu" autocomplete="off" class="form-control" placeholder="Pesquisar...">
                <span class="input-group-btn">
                <button type="submit" readonly="" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?= \app\theme\widgets\MenuAdmin::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $items,
            ]
        );?>
    </section>
    <!-- /.sidebar -->
</aside>