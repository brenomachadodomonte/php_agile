<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $q String */
/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index box box-default">
<?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : ''
?>    <div class="box-header with-border">
        <div class="div-button-add">
        <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i> Cadastrar <?=Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <form action="" id="form-search">
            <div class="input-group col-md-4">
                <input type="search" value="<?='<?=$q?>'?>" name="q" class="form-control" placeholder="Pesquisar...">
                <span class="input-group-btn">
                <button class="btn btn-default btn-flat" type="submit">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </span>
            </div>
        </form>
    </div>
<?php if(!empty($generator->searchModelClass)): ?>
<?= "        <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif;

if ($generator->indexWidgetType === 'grid'):
    echo "        <?= " ?>GridView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'Exibindo {begin}-{end} de {totalCount} itens',
            'pager' => [
                'options' => [
                    'class' => 'pagination pagination-sm no-margin pull-right',
                ],
            ],
            'emptyText' => 'Nenhum registro encontrado',
            'layout' => "<div class='box-body table-responsive'>{items}</div> <div class='box-footer'> <span>{summary}</span>{pager}</div>",
            <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n            'columns' => [\n" : "'columns' => [\n"; ?>
                ['class' => 'yii\grid\SerialColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6 && $name != 'status') {
            if($name === 'data_nascimento'){
            echo "                ['attribute'=> 'data_nascimento','format' => ['date', 'php:d/m/Y']],\n";
            } else {
            echo "                '" . $name . "',\n";
            }
        } else {
            echo "                // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6 && $column->name != 'status') {
            if($column->name === 'data_nascimento'){
            echo "                ['attribute'=> 'data_nascimento','format' => ['date', 'php:d/m/Y']],\n";
            } else {
            echo "                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        } else {
            echo "                // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
<?php if(in_array('status', $generator->getColumnNames())) { ?>
                [
                    'attribute'=> 'status',
                    'contentOptions' => ['style' => 'text-align: center'],
                    'headerOptions' => ['style' => 'text-align: center'],
                    'content' => function($model) {
                        $class = $model->status == 1 ? 'bg-green' : 'bg-red';
                        return Html::a("<span class='badge {$class}'><i class='fa fa-check'></i></span>", ['<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/status/'.$model->id], ['data-toggle'=>'tooltip', 'class'=>'btn-status','title'=>'Status']);
                    }
                ],
<?php } ?>

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=> 'Ações',
                    'contentOptions' => ['class' => 'text-center action-buttons'],
                    'headerOptions' => ['class' => 'text-center'],
                    'buttons'=>[
                        'view'=>function ($url, $model) {
                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i> ', ['<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/view/'.$model->id], ['data-toggle'=>'tooltip', 'class' => 'btn btn-primary btn-sm btn-flat', 'title'=>'Visualizar']);
                        },
                        'update'=>function ($url, $model) {
                            return Html::a('<i class="glyphicon glyphicon-pencil"></i> ', ['<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/update/'.$model->id], ['data-toggle'=>'tooltip', 'class' => 'btn btn-warning btn-sm btn-flat', 'title'=>'Editar']);
                        },
                        'delete'=>function ($url, $model) {
                            return Html::a('<i class="glyphicon glyphicon-trash"></i> ', ['<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/delete/'.$model->id], ['data-toggle'=>'tooltip', 'class' => 'btn btn-danger btn-sm btn-excluir btn-flat',  'title'=>'Excluir']);
                        }
                    ],
                ],
            ],
        ]); ?>
<?php else: ?>
        <?= "<?= " ?>ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
            },
        ]) ?>
<?php endif; ?>
    </div>
<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
