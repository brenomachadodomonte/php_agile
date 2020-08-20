<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DailyScrum */

$this->title = 'Atualizar Daily Scrum: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daily Scrums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="daily-scrum-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
