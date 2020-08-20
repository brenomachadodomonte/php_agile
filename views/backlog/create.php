<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Backlog */

$this->title = 'Cadastrar Backlog';
$this->params['breadcrumbs'][] = ['label' => 'Backlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backlog-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
