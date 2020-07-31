<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
 
/**
 * This is the model class for table "{{%usuario}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $authkey
 * @property string|null $accestoken
 */
class Usuario extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%usuario}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioQuery(get_called_class());
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey===$authKey;
    }

    public function validatePassword($password) {
        //return password_verify($password,$this->password);
        return $this->password===$password;
    }
    
    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findByUsername($username) {
        return self::findOne(['username'=>$username]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null) {
        //throw new \yii\base\NotSupprtedException();
        return static::findOne(['accessToken'=>$token]);
    }

}
