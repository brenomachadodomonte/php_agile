<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tarefa */

$this->title = 'Atualizar Tarefa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tarefas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="tarefa-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
