<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "daily_scrum".
*
* @property int $id
* @property string $data
* @property int $sprint_id
*
    * @property Sprint $sprint
    */
class DailyScrum extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'daily_scrum';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['data', 'sprint_id'], 'required'],
            [['data'], 'safe'],
            [['sprint_id'], 'integer'],
            [['sprint_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sprint::className(), 'targetAttribute' => ['sprint_id' => 'id']],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'sprint_id' => 'Sprint ID',
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
             "ifnull(data, '')",
             "ifnull(sprint_id, '')",
        ];

        $fields = implode(", ' ', ", $searchables);
        $search = "lower(concat({$fields}))";

        return ['like', $search, strtolower($q)];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSprint()
    {
    return $this->hasOne(Sprint::className(), ['id' => 'sprint_id']);
    }
}
