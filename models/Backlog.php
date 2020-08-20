<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "backlog".
*
* @property int $id
* @property string $descricao
* @property int|null $prioridade
* @property int|null $categoria
* @property int $produto_id
*
* @property Produto $produto
* @property Sprint[] $sprints
*/
class Backlog extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'backlog';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['prioridade', 'categoria', 'produto_id'], 'integer'],
            [['produto_id'], 'required'],
            [['descricao'], 'string', 'max' => 200],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_id' => 'id']],
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
            'prioridade' => 'Prioridade',
            'categoria' => 'Categoria',
            'produto_id' => 'Produto ID',
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
             "ifnull(prioridade, '')",
             "ifnull(categoria, '')",
             "ifnull(produto_id, '')",
        ];

        $fields = implode(", ' ', ", $searchables);
        $search = "lower(concat({$fields}))";

        return ['like', $search, strtolower($q)];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProduto()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSprints()
    {
        return $this->hasMany(Sprint::className(), ['backlog_id' => 'id']);
    }

    public static function getCategorias(){
        return [
            0 => 'Pouco Importante',
            1 => 'Importante',
            2 => 'Muito Importante'
        ];
    }
}
