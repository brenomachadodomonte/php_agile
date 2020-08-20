<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "usuario".
*
* @property int $id
* @property string $nome
* @property string $email
* @property string $senha
* @property string|null $avatar
* @property int $tipo
* @property int $status
* @property string|null $access_token
* @property string|null $auth_key
* @property string $data_criacao
*
* @property PapelUsuario[] $papelUsuarios
*/
class Usuario extends \yii\db\ActiveRecord
{
    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['tipo', 'status', 'data_criacao'], 'required'],
            [['tipo', 'status'], 'integer'],
            [['data_criacao'], 'safe'],
            [['nome'], 'string', 'max' => 80],
            [['email', 'senha'], 'string', 'max' => 200],
            [['avatar', 'access_token', 'auth_key'], 'string', 'max' => 100],
            [['email'], 'unique'],
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
            'email' => 'Email',
            'senha' => 'Senha',
            'avatar' => 'Avatar',
            'tipo' => 'Tipo',
            'tipoDescricao'=>'Tipo',
            'status' => 'Status',
            'access_token' => 'Access Token',
            'auth_key' => 'Auth Key',
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
             "ifnull(nome, '')",
             "ifnull(email, '')",
             "ifnull(senha, '')",
             "ifnull(avatar, '')",
             "ifnull(tipo, '')",
             "ifnull(status, '')",
             "ifnull(access_token, '')",
             "ifnull(auth_key, '')",
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
        return $this->hasMany(PapelUsuario::className(), ['usuario_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->senha = sha1($this->senha);
            } else if ($this->isAttributeChanged('senha')){
                $this->senha = sha1($this->senha);
            }

            return true;
        }
        return false;
    }

    public static function getTipos(){
        return [
            0 => 'Administrador',
            1 => 'Usuário Comum',
        ];
    }

    public function getTipoDescricao(){
        return Usuario::getTipos()[$this->tipo];
    }

    public function getAvatarPath(){
        return $this->avatar ? Yii::$app->request->baseUrl . '/media/' . $this->avatar : null;
    }
}
