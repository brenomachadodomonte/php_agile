<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Backlog */

$this->title = 'Atualizar Backlog: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Backlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="backlog-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
