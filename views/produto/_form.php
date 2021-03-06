<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */
/* @var $form yii\widgets\ActiveForm */
/* @var $usuarios array */
/* @var $papeis array */

$this->myJsFiles = [
    'produto.js'
];
?>

<div class="produto-form box box-default">
    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->checkbox(['class'=>'icheck', 'checked'=>true]) ?>

        <?php if($model->isNewRecord) { 
            echo $form->field($model, 'data_criacao')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false);
        } else { 
            echo $form->field($model, 'data_modificacao')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false);
        } ?>

        <legend><i class="fa fa-users"></i> Scrum Team</legend>

        <div class="form-group">
            <label class="control-label" for="owner">Product Owner</label>
            <select name="owner" id="owner" class="form-control">
                <option value="">Selecione o Usuário</option>
                <?php foreach($usuarios as $usuario){ ?>
                    <option value="<?=$usuario->id?>"><?=$usuario->nome?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label" for="master">Scrum Master</label>
            <select name="master" id="master" class="form-control">
                <option value="">Selecione o Usuário</option>
                <?php foreach($usuarios as $usuario){ ?>
                    <option value="<?=$usuario->id?>"><?=$usuario->nome?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label" for="developers">Scrum Developers</label>
            <select name="developers[]" multiple id="developers" class="form-control">
                <option value="">Selecione os Usuários</option>
                <?php foreach($usuarios as $usuario){ ?>
                    <option value="<?=$usuario->id?>"><?=$usuario->nome?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Cadastrar' : '<i class="fa fa-save"></i> Salvar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
