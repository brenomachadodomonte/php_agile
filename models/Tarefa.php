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
* @property string|null $data_modificacao
*
    * @property Sprint $sprint
    * @property Usuario $usuario
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
            [['tipo', 'quadro', 'usuario_id', 'sprint_id', 'data_criacao'], 'required'],
            [['tipo', 'quadro', 'usuario_id', 'sprint_id'], 'integer'],
            [['data_criacao', 'data_modificacao'], 'safe'],
            [['descricao'], 'string', 'max' => 80],
            [['sprint_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sprint::className(), 'targetAttribute' => ['sprint_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
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
            'tipo' => 'Tipo',
            'quadro' => 'Quadro',
            'usuario_id' => 'Usuario',
            'sprint_id' => 'Sprint',
            'data_criacao' => 'Data Criação',
            'data_modificacao' => 'Data Modificação',
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

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSprint()
    {
        return $this->hasOne(Sprint::className(), ['id' => 'sprint_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id']);
    }

    public static function getTipos(){
        return [
            0 => 'Novo',
            1 => 'Alteração',
            2 => 'Correção'
        ];
    }

    public static function getQuadros(){
        return [
            0 => 'TODO',
            1 => 'DOING',
            2 => 'TEST',
            3 => 'DONE'
        ];
    }

    public function getTipoDescricao(){
        return isset($this->tipo) ? Tarefa::getTipos()[$this->tipo] : null;
    }

    public function getQuadroDescricao(){
        return isset($this->quadro) ? Tarefa::getQuadros()[$this->quadro] : null;
    }
}
