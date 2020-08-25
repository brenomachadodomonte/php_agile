<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "sprint".
*
* @property int $id
* @property string $objetivo
* @property int $status
* @property int $backlog_id
* @property string $data_criacao
* @property string|null $data_finalizacao
*
* @property DailyScrum[] $dailyScrums
* @property Backlog $backlog
*/
class Sprint extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'sprint';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['status', 'backlog_id', 'data_criacao'], 'required'],
            [['status', 'backlog_id'], 'integer'],
            [['data_criacao', 'data_finalizacao'], 'safe'],
            [['objetivo'], 'string', 'max' => 400],
            [['backlog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Backlog::className(), 'targetAttribute' => ['backlog_id' => 'id']],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetivo' => 'Objetivo',
            'status' => 'Status',
            'backlog_id' => 'Backlog',
            'data_criacao' => 'Data Criação',
            'data_finalizacao' => 'Data Finalização',
        ];
    }

    /**
    * {@inheritdoc}
    */
    public static function searchables($q)
    {
        if(!$q) {
            return null;
        }

        $searchables = [
             "ifnull(id, '')",
             "ifnull(objetivo, '')",
             "ifnull(status, '')",
             "ifnull(backlog_id, '')",
             "ifnull(data_criacao, '')",
             "ifnull(data_finalizacao, '')",
        ];

        $fields = implode(", ' ', ", $searchables);
        $search = "lower(concat({$fields}))";

        return ['like', $search, strtolower($q)];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getDailyScrums()
    {
    return $this->hasMany(DailyScrum::className(), ['sprint_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBacklog()
    {
    return $this->hasOne(Backlog::className(), ['id' => 'backlog_id']);
    }
}
