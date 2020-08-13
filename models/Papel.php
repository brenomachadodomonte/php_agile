<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "papel".
*
* @property int $id
* @property string $descricao
* @property string $data_criacao
*
    * @property PapelUsuario[] $papelUsuarios
    */
class Papel extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'papel';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['data_criacao'], 'required'],
            [['data_criacao'], 'safe'],
            [['descricao'], 'string', 'max' => 80],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
            'data_criacao' => 'Data Criação',
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
             "ifnull(descricao, '')",
             "ifnull(data_criacao, '')",
        ];

        $fields = implode(", ' ', ", $searchables);
        $search = "lower(concat({$fields}))";

        return ['like', $search, strtolower($q)];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getPapelUsuarios()
    {
    return $this->hasMany(PapelUsuario::className(), ['papel_id' => 'id']);
    }
}
