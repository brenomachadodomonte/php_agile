<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "tarefa".
*
* @property int $id
* @property string $descricao
* @property int $tipo
* @property int $quadro
* @property int $usuario_id
* @property int $sprint_id
* @property string $data_criacao
* @property string $data_modificacao
*/
class Tarefa extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'tarefa';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['tipo', 'quadro', 'usuario_id', 'sprint_id', 'data_criacao', 'data_modificacao'], 'required'],
            [['tipo', 'quadro', 'usuario_id', 'sprint_id'], 'integer'],
            [['data_criacao', 'data_modificacao'], 'safe'],
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
            'descricao' => 'Descricao',
            'tipo' => 'Tipo',
            'quadro' => 'Quadro',
            'usuario_id' => 'Usuario ID',
            'sprint_id' => 'Sprint ID',
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
             "ifnull(descricao, '')",
             "ifnull(tipo, '')",
             "ifnull(quadro, '')",
             "ifnull(usuario_id, '')",
             "ifnull(sprint_id, '')",
             "ifnull(data_criacao, '')",
             "ifnull(data_modificacao, '')",
        ];

        $fields = implode(", ' ', ", $searchables);
        $search = "lower(concat({$fields}))";

        return ['like', $search, strtolower($q)];
    }
}
