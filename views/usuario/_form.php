<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form box box-default">
    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'senha')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'avatar')->fileInput(['class' => 'form-control']) ?>

        <?= $form->field($model, 'tipo')->dropDownList(\app\models\Usuario::getTipos()) ?>

        <?= $form->field($model, 'access_token')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'auth_key')->hiddenInput()->label(false) ?>

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
