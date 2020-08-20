<?php

namespace app\controllers;

use Yii;
use app\models\DailyScrum;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DailyScrumController implements the CRUD actions for DailyScrum model.
 */
class DailyScrumController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DailyScrum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $q = Yii::$app->request->get('q');
        $where = DailyScrum::searchables($q);

        $dataProvider = new ActiveDataProvider([
            'query' => DailyScrum::find()->where($where)->orderBy('id desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'q' => $q
        ]);
    }

    /**
     * Displays a single DailyScrum model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DailyScrum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DailyScrum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DailyScrum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DailyScrum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionStatus($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = [
            'error'=> true,
            'message'=>'Erro ao alterar Status'
        ];
        if(Yii::$app->request->isAjax){
            try {
                $model = $this->findModel($id);
                $model->status = $model->status == 1 ? 0 : 1;
                if($model->save()){
                    $result = ['error' => false, 'status' => $model->status];
                }
            } catch (\Exception $e){
                $result['message'] = 'Erro ao alterar Status';
            }
        }
        return $result;
    }

    /**
     * Finds the DailyScrum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DailyScrum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DailyScrum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
