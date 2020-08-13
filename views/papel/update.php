<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Papel */

$this->title = 'Atualizar Papel: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Papels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="papel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
