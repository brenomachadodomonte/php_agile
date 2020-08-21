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
            <legend>Backlog: Configurar <?=$model->descricao?></legend>

            <?= $form->field($model, 'prioridade')->dropDownList(\app\models\Backlog::getPrioridades(),['prompt'=>'Selecione']) ?>
            <?= $form->field($model, 'categoria')->dropDownList(\app\models\Backlog::getCategorias(),['prompt'=>'Selecione']) ?>

        </div>
        <div class="box-footer">
            <?= Html::submitButton('<i class="fa fa-save"></i> Configurar', ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
