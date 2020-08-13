<?php

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form box box-default">
    <div class="box-header with-border">
        <?= "<?= " ?>Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </div>
    <?= "<?php " ?>$form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes) && !in_array($attribute, ['data_criacao', 'data_modificacao', 'status'])) {
        echo "        <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
<?php if(in_array("status", $generator->getColumnNames())) {
        echo "        <?= \$form->field(\$model, 'status')->checkbox(['class'=>'icheck']) ?>\n\n";
 } ?>
<?php if(in_array("data_criacao", $generator->getColumnNames())) { ?>
        <?= '<?php if($model->isNewRecord) { ' . "\n"?>
            echo $form->field($model, 'data_criacao')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false);
        <?php if(in_array("data_modificacao", $generator->getColumnNames())) { ?>
<?= '} else { ' . "\n" ?>
            echo $form->field($model, 'data_modificacao')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false);
        <?= '} ?>' ?>
        <?php } else { ?>
<?= '} ?>' ?>
        <?php } ?>
<?php } ?>

    </div>
    <div class="box-footer">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Cadastrar' : '<i class="fa fa-save"></i> Salvar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
