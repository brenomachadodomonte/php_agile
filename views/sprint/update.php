<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sprint */

$this->title = 'Atualizar Sprint: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sprints', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="sprint-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
