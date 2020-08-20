<?php

use app\models\Produto;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Backlog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backlog-form box box-default">
    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

<!--        --><?//= $form->field($model, 'prioridade')->dropDownList(\app\models\Backlog::getPrioridades(),['prompt'=>'Selecione']) ?>
<!---->
<!--        --><?//= $form->field($model, 'categoria')->dropDownList(\app\models\Backlog::getCategorias(),['prompt'=>'Selecione']) ?>

        <?= $form->field($model, 'produto_id')->dropDownList(Produto::find()->where(['status'=>1])->select(['nome'])->orderBy('nome')->indexBy('id')->column(), ['prompt'=>'Selecione']) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Cadastrar' : '<i class="fa fa-save"></i> Salvar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
