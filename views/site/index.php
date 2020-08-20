<?php

/* @var $this yii\web\View */
/* @var $quickAccess array */
/* @var $usuariosEstado array */
/* @var $estados array */

$this->title = 'Dashboard';

$this->myJsFiles = [
    'highcharts.js',
    'dashboard.js'
];
$this->myCssFiles = [
    'highcharts.css',
    'dashboard.css'
];
use yii\helpers\Url; ?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?=$quickAccess['produtos']?></h3>

                <p>Produtos</p>
            </div>
            <div class="icon">
                <i class="fa fa-cube"></i>
            </div>
            <a href="<?=Url::to(['produto/'])?>" class="small-box-footer">Saiba Mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?=$quickAccess['backlogs']?></h3>

                <p>Backlogs</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="<?=Url::to(['backlog/'])?>" class="small-box-footer">Saiba Mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?=$quickAccess['sprint']?></h3>

                <p>Sprints</p>
            </div>
            <div class="icon">
                <i class="fa fa-send"></i>
            </div>
            <a href="<?=Url::to(['sprint/'])?>" class="small-box-footer">Saiba Mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?=$quickAccess['tarefas']?></h3>

                <p>Tarefas a fazer</p>
            </div>
            <div class="icon">
                <i class="fa fa-check-square-o"></i>
            </div>
            <a href="<?=Url::to(['tarefas/'])?>" class="small-box-footer">Saiba Mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs">
                <li class="pull-left header"><i class="fa fa-check-square-o"></i> Tarefas por mês</li>
            </ul>
            <div class="tab-content no-padding">
                <div class="chart tab-pane active" id="tarefas-chart" style="position: relative; height: 300px;"></div>
            </div>
        </div>
        <!-- /.nav-tabs-custom -->

        <div class="box box-default">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">Usuários por Estado</h3>
            </div>
            <div class="box-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered">
                        <tr>
                            <th>Estado</th>
                            <th style="width: 60px">Qtde</th>
                        </tr>
                        <?php foreach($usuariosEstado as $estado){ ?>
                            <tr>
                                <td><?=$estados[$estado['estado']]?></td>
                                <td><?=$estado['qtde']?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">

        <!-- Map box -->
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-check-circle-o"></i>

                <h3 class="box-title">
                    Tarefas por Tipo
                </h3>
            </div>
            <div class="box-body">
                <div id="tipos-chart" style="height: 277px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
        </div>
        <!-- /.box -->

        <!-- solid sales graph -->
        <div class="box box-solid bg-blue">
            <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Calendário</h3>
            </div>
            <div class="box-body no-padding">
                <div id="calendar" style="width: 100%"></div>
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->