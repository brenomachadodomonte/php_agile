<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tarefa */

$this->title = 'Cadastrar Tarefa';
$this->params['breadcrumbs'][] = ['label' => 'Tarefas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarefa-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
