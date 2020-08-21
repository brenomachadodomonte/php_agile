<?php

namespace app\controllers;

use app\models\Backlog;
use app\models\Produto;
use app\models\Sprint;
use app\models\Tarefa;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //Data For Dashboard
        $quickAccess = [
            'produtos' =>  Produto::find()->count('1'),
            'backlogs' =>  Backlog::find()->count('1'),
            'sprint' =>  Sprint::find()->count('1'),
            'tarefas' =>  Tarefa::find()->where(['quadro'=>0])->count('1')
        ];

        return $this->render('index',[
            'quickAccess'=>$quickAccess,
            'tarefas'=>[]
        ]);
    }

    public function actionCharts(){
        $query = new Query();
        $rs = $query->select(['DATE_FORMAT(data_criacao, "%Y%m") mes','count(1) qtde'])
            ->from('tarefa')
            ->groupBy('mes')
            ->orderBy('mes desc')
            ->limit(12)
            ->all();
        $categories = array_column($rs, 'mes');
        $data = array_map('intval', array_column($rs, 'qtde'));
        krsort($categories);
        krsort($data);
        $result = [
            'tarefas' => [
                'categories' => array_values($categories),
                'data' => array_values($data)
            ],
            'tipos' => [
                /*['name' => 'Nova', 'y'=>(int)Tarefa::find()->where(['tipo'=>1])->count('1')],
                ['name' => 'Alteração', 'y'=>(int)Tarefa::find()->where(['tipo'=>2])->count('1')],
                ['name' => 'Correção', 'y'=>(int)Tarefa::find()->where(['tipo'=>3])->count('1')],*/
                ['name' => 'Nova', 'y'=>62],
                ['name' => 'Alteração', 'y'=>16],
                ['name' => 'Correção', 'y'=>20]
            ]
        ];

        return Json::encode($result);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
