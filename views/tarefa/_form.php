<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tarefa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarefa-form box box-default">
    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tipo')->textInput() ?>

        <?= $form->field($model, 'quadro')->textInput() ?>

        <?= $form->field($model, 'usuario_id')->textInput() ?>

        <?= $form->field($model, 'sprint_id')->textInput() ?>

        <?php if($model->isNewRecord) { 
            echo $form->field($model, 'data_criacao')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false);
        } else { 
            echo $form->field($model, 'data_modificacao')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false);
        } ?>        
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Cadastrar' : '<i class="fa fa-save"></i> Salvar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
