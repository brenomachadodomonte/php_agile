<?php
/* @var $content string */

use app\theme\widgets\AlertAdmin;
use yii\widgets\Breadcrumbs;

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?=$this->title?>
        </h1>
        <?= Breadcrumbs::widget(
                ['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]
            ) ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <?= AlertAdmin::widget() ?>
        <?=$content?>

    </section>
    <!-- /.content -->
</div>