<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Papel */

$this->title = 'Cadastrar Papel';
$this->params['breadcrumbs'][] = ['label' => 'Papels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="papel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
