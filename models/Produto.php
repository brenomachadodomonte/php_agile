<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "produto".
*
* @property int $id
* @property string $nome
* @property string $descricao
* @property int $status
* @property string $data_criacao
* @property string|null $data_modificacao
*
    * @property Backlog[] $backlogs
    * @property PapelUsuario[] $papelUsuarios
    */
class Produto extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'produto';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['status', 'data_criacao'], 'required'],
            [['status'], 'integer'],
            [['data_criacao', 'data_modificacao'], 'safe'],
            [['nome'], 'string', 'max' => 80],
            [['descricao'], 'string', 'max' => 400],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'status' => 'Status',
            'data_criacao' => 'Data Criacao',
            'data_modificacao' => 'Data Modificacao',
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
             "ifnull(nome, '')",
             "ifnull(descricao, '')",
             "ifnull(status, '')",
             "ifnull(data_criacao, '')",
             "ifnull(data_modificacao, '')",
        ];

        $fields = implode(", ' ', ", $searchables);
        $search = "lower(concat({$fields}))";

        return ['like', $search, strtolower($q)];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBacklogs()
    {
    return $this->hasMany(Backlog::className(), ['produto_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getPapelUsuarios()
    {
    return $this->hasMany(PapelUsuario::className(), ['produto_id' => 'id']);
    }
}
