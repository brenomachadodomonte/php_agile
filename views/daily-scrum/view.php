<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DailyScrum */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Scrum #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daily Scrums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-scrum-view box box-default">
    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
        <?= Html::a('<i class="fa fa-plus"></i> Cadastrar', ['create'], ['class' => 'btn btn-flat btn-success']) ?>
        <?= Html::a('<i class="fa fa-pencil"></i> Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-flat btn-warning']) ?>
        <?= Html::a('<i class="fa fa-remove"></i> Excluir', ['delete', 'id' => $model->id], ['class' => 'btn btn-flat btn-danger btn-excluir']) ?>
    </div>
    <div class="box-body table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'data:date',
                ['attribute'=>'sprint.objetivo', 'label'=>'Sprint' ],
            ],
        ]) ?>
    </div>

    <div class="box-body">
        <h4>Scrum developers</h4>
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
            'usuario.nome',
            'fez_ontem',
            'fara_hoje',
            'impedimentos',
        ],
    ]); ?>
</div>
