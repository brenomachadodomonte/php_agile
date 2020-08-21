<?php

namespace app\controllers;

use app\models\Papel;
use app\models\PapelUsuario;
use app\models\Usuario;
use Yii;
use app\models\Produto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
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
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $q = Yii::$app->request->get('q');
        $where = Produto::searchables($q);

        $dataProvider = new ActiveDataProvider([
            'query' => Produto::find()->where($where)->orderBy('id desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'q' => $q
        ]);
    }

    /**
     * Displays a single Produto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PapelUsuario::find()->where(['produto_id'=>$id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produto();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();

            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model->load($post);
                $model->save();

                $owner = new PapelUsuario();
                $owner->papel_id = 2;
                $owner->produto_id = $model->id;
                $owner->usuario_id = $post['owner'];
                $owner->save();

                $master = new PapelUsuario();
                $master->papel_id = 3;
                $master->produto_id = $model->id;
                $master->usuario_id = $post['master'];
                $master->save();

                foreach ($post['developers'] as $developer){
                    $dev = new PapelUsuario();
                    $dev->papel_id = 1;
                    $dev->produto_id = $model->id;
                    $dev->usuario_id = $developer;
                    $dev->save();
                }

                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', "Erro ao cadastrar Produto");
                return $this->redirect(['index']);
            }

        } else {
            $usuarios = Usuario::find()->all();
            $papeis = Papel::find()->all();
            return $this->render('create', [
                'model' => $model,
                'usuarios'=>$usuarios,
                'papeis'=>$papeis
            ]);
        }
    }

    /**
     * Updates an existing Produto model.
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
            $usuarios = Usuario::find()->all();
            $papeis = Papel::find()->all();
            return $this->render('update', [
                'model' => $model,
                'usuarios'=>$usuarios,
                'papeis'=>$papeis
            ]);
        }
    }

    /**
     * Deletes an existing Produto model.
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
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
