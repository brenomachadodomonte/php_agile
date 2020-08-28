<?php

namespace app\controllers;

use app\models\ItemDailyScrum;
use app\models\PapelUsuario;
use app\models\Sprint;
use Yii;
use app\models\DailyScrum;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\helpers\Json;
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
        $dataProvider = new ActiveDataProvider([
            'query' => ItemDailyScrum::find()->where(['daily_scrum_id'=>$id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$dataProvider
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

        $transaction = Yii::$app->db->beginTransaction();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();

            try{
                $model->load($post);
                $model->save();

                foreach ($post['scrum'] as $scrum){
                    $scrum['daily_scrum_id'] = $model->id;

                    $item = new ItemDailyScrum();
                    $item->setAttributes($scrum);
                    if(!$item->save()){
                        Throw new Exception('Erro');
                    }
                }

                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', "Erro ao cadastrar Daily Scrum");
                return $this->redirect(['index']);
            }

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

    public function actionDaily(){
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $sprint = Sprint::findOne($post['id']);

            if($sprint !== null){

                $usuarios = PapelUsuario::find()->where(['produto_id'=>$sprint->backlog->produto_id, 'papel_id'=>1])->all();
                $result = [
                    'html'=>$this->renderPartial('_scrum', [
                        'usuarios'=>$usuarios
                    ]),
                    'error'=>false,
                ];
            }

            return Json::encode($result);
        }
    }
}
