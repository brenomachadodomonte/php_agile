<?php

namespace app\controllers;

use app\models\Tarefa;

class KanbanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $todo = Tarefa::find()->where(['quadro'=>0])->all();
        $doing = Tarefa::find()->where(['quadro'=>1])->all();
        $test = Tarefa::find()->where(['quadro'=>2])->all();
        $done = Tarefa::find()->where(['quadro'=>3])->all();

        return $this->render('index', [
            'todo' => $todo,
            'doing' => $doing,
            'test' => $test,
            'done' => $done
        ]);
    }

}
