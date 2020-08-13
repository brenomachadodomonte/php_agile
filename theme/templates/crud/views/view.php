<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = '<?=Inflector::camel2words(StringHelper::basename($generator->modelClass))?> #'.$model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view box box-default">
    <div class="box-header with-border">
        <?= "<?= " ?>Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i> Cadastrar', ['create'], ['class' => 'btn btn-flat btn-success']) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-pencil"></i> Editar', ['update', <?= $urlParams ?>], ['class' => 'btn btn-flat btn-warning']) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-remove"></i> Excluir', ['delete', <?= $urlParams ?>], ['class' => 'btn btn-flat btn-danger btn-excluir']) ?>
    </div>
    <div class="box-body table-responsive">
        <?= "<?= " ?>DetailView::widget([
            'model' => $model,
            'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "                '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        if(in_array($column->name, ['data_criacao', 'data_modificacao'])){
            echo "                " . '[\'attribute\' => \''.$column->name.'\',\'format\' => [\'date\', \'php:d/m/Y H:i:s\']]'.",\n";
        } else if ($column->name == 'status') {
            echo "                " . '[\'attribute\' => \''.$column->name.'\',\'value\' => $model->status == 1 ? \'Ativo\' : \'Inativo\']'.",\n";
        } else {
        $format = $generator->generateColumnFormat($column);
        echo "                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
            ],
        ]) ?>
    </div>
</div>
