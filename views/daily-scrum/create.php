<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DailyScrum */

$this->title = 'Cadastrar Daily Scrum';
$this->params['breadcrumbs'][] = ['label' => 'Daily Scrums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-scrum-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
