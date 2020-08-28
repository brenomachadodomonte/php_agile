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
*
* @property Usuario $usuario
* @property DailyScrum $dailyScrum
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
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['daily_scrum_id'], 'exist', 'skipOnError' => true, 'targetClass' => DailyScrum::className(), 'targetAttribute' => ['daily_scrum_id' => 'id']],
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

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuario()
    {
    return $this->hasOne(Usuario::className(), ['id' => 'usuario_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getDailyScrum()
    {
    return $this->hasOne(DailyScrum::className(), ['id' => 'daily_scrum_id']);
    }
}
