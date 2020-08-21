<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */
/* @var $usuarios array */
/* @var $papeis array */

$this->title = 'Atualizar Produto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="produto-update">

    <?= $this->render('_form', [
        'model' => $model,
        'usuarios'=>$usuarios,
        'papeis'=>$papeis
    ]) ?>

</div>
