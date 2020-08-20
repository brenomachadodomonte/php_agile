<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $q = Yii::$app->request->get('q');
        $where = Usuario::searchables($q);

        $dataProvider = new ActiveDataProvider([
            'query' => Usuario::find()->where($where)->orderBy('id desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'q' => $q
        ]);
    }

    /**
     * Displays a single Usuario model.
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $file = UploadedFile::getInstance($model, 'avatar');

            if(isset($file) && !empty($file)){
                $filename = strtolower(str_replace('@', '_', $model->email)) .'.'. $file->extension;
                $file->saveAs('media/' . $filename);
                $model->avatar = $filename;
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Erro ao cadastrar Usuário");
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuario model.
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
     * Deletes an existing Usuario model.
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
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
