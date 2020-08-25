<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sprint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sprint-form box box-default">
    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'objetivo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'backlog_id')->dropDownList(\app\models\Backlog::find()->select(['descricao'])->orderBy('descricao')->indexBy('id')->column()) ?>

        <?= $form->field($model, 'data_finalizacao')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'status')->checkbox(['class'=>'icheck', 'checked'=>true]) ?>

        <?php if($model->isNewRecord) { 
            echo $form->field($model, 'data_criacao')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false);
        } ?>        
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Cadastrar' : '<i class="fa fa-save"></i> Salvar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
