<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "papel_usuario".
*
* @property int $id
* @property int $papel_id
* @property int $usuario_id
* @property int $produto_id
*
    * @property Usuario $usuario
    * @property Papel $papel
    * @property Produto $produto
    */
class PapelUsuario extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'papel_usuario';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['papel_id', 'usuario_id', 'produto_id'], 'required'],
            [['papel_id', 'usuario_id', 'produto_id'], 'integer'],
            [['papel_id', 'usuario_id', 'produto_id'], 'unique', 'targetAttribute' => ['papel_id', 'usuario_id', 'produto_id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['papel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Papel::className(), 'targetAttribute' => ['papel_id' => 'id']],
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
            'papel_id' => 'Papel ID',
            'usuario_id' => 'Usuario ID',
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
             "ifnull(papel_id, '')",
             "ifnull(usuario_id, '')",
             "ifnull(produto_id, '')",
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
    public function getPapel()
    {
    return $this->hasOne(Papel::className(), ['id' => 'papel_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProduto()
    {
    return $this->hasOne(Produto::className(), ['id' => 'produto_id']);
    }
}
