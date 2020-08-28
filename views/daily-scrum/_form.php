<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DailyScrum */
/* @var $form yii\widgets\ActiveForm */

$this->myJsFiles = [
    'daily-scrum.js'
];
?>

<div class="daily-scrum-form box box-default">
    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-bars"></i> Listar', ['index'], ['class' => 'btn btn-flat btn-info']) ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'data')->textInput(['picker'=>'date', 'value'=>date('Y-m-d')]) ?>

        <?= $form->field($model, 'sprint_id')->dropDownList(\app\models\Sprint::find()->select(['objetivo'])->orderBy('objetivo')->indexBy('id')->column(), ['prompt'=>'Selecione']) ?>

        <div id="scrum"></div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Cadastrar' : '<i class="fa fa-save"></i> Salvar', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
