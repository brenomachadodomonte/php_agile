<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $q String */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarefas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarefa-index box box-default">
    <div class="box-header with-border">
        <div class="div-button-add">
        <?= Html::a('<i class="fa fa-plus"></i> Cadastrar Tarefa', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <form action="" id="form-search">
            <div class="input-group col-md-4">
                <input type="search" value="<?=$q?>" name="q" class="form-control" placeholder="Pesquisar...">
                <span class="input-group-btn">
                <button class="btn btn-default btn-flat" type="submit">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </span>
            </div>
        </form>
    </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'Exibindo {begin}-{end} de {totalCount} itens',
            'pager' => [
                'options' => [
                    'class' => 'pagination pagination-sm no-margin pull-right',
                ],
            ],
            'emptyText' => 'Nenhum registro encontrado',
            'layout' => "<div class='box-body table-responsive'>{items}</div> <div class='box-footer'> <span>{summary}</span>{pager}</div>",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id',
                'descricao',
                'tipoDescricao',
                'quadroDescricao',
                'usuario.nome',
                // 'sprint_id',
                // 'data_criacao',
                // 'data_modificacao',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=> 'Ações',
                    'contentOptions' => ['class' => 'text-center action-buttons'],
                    'headerOptions' => ['class' => 'text-center'],
                    'buttons'=>[
                        'view'=>function ($url, $model) {
                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i> ', ['tarefa/view/'.$model->id], ['data-toggle'=>'tooltip', 'class' => 'btn btn-primary btn-sm btn-flat', 'title'=>'Visualizar']);
                        },
                        'update'=>function ($url, $model) {
                            return Html::a('<i class="glyphicon glyphicon-pencil"></i> ', ['tarefa/update/'.$model->id], ['data-toggle'=>'tooltip', 'class' => 'btn btn-warning btn-sm btn-flat', 'title'=>'Editar']);
                        },
                        'delete'=>function ($url, $model) {
                            return Html::a('<i class="glyphicon glyphicon-trash"></i> ', ['tarefa/delete/'.$model->id], ['data-toggle'=>'tooltip', 'class' => 'btn btn-danger btn-sm btn-excluir btn-flat',  'title'=>'Excluir']);
                        }
                    ],
                ],
            ],
        ]); ?>
    </div>
