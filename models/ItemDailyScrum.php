<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "item_daily_scrum".
*
* @property int $id
* @property int $daily_scrum_id
* @property string $fez_ontem
* @property string $fara_hoje
* @property string $impedimentos
* @property int $usuario_id
*/
class ItemDailyScrum extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'item_daily_scrum';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['daily_scrum_id', 'usuario_id'], 'required'],
            [['daily_scrum_id', 'usuario_id'], 'integer'],
            [['fez_ontem', 'fara_hoje', 'impedimentos'], 'string', 'max' => 200],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'daily_scrum_id' => 'Daily Scrum ID',
            'fez_ontem' => 'Fez Ontem',
            'fara_hoje' => 'Fara Hoje',
            'impedimentos' => 'Impedimentos',
            'usuario_id' => 'Usuario ID',
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
             "ifnull(daily_scrum_id, '')",
             "ifnull(fez_ontem, '')",
             "ifnull(fara_hoje, '')",
             "ifnull(impedimentos, '')",
             "ifnull(usuario_id, '')",
        ];

        $fields = implode(", ' ', ", $searchables);
        $search = "lower(concat({$fields}))";

        return ['like', $search, strtolower($q)];
    }
}
