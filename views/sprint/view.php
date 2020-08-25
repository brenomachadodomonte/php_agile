<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sprint */

$this->title = 'Sprint #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sprints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sprint-view box box-default">
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
                'objetivo',
                ['attribute' => 'status','value' => $model->status == 1 ? 'Ativo' : 'Inativo'],
//                'backlog_id',
                ['attribute'=>'backlog.produto.nome', 'label'=>'Produto'],
                ['attribute'=>'backlog.descricao', 'label'=>'Backlog'],
                ['attribute' => 'data_criacao','format' => ['date', 'php:d/m/Y H:i:s']],
                'data_finalizacao',
            ],
        ]) ?>
    </div>
</div>
