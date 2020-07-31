<?php

namespace app\models;

use Yii;
use \yii\db;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use \yii\web;
/**
 * This is the model class for table "{{%usuarios}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $authKey
 * @property string|null $accessToken
 */
class Usuarios extends ActiveRecord implements web\IdentityInterface 
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%usuarios}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'string', 'max' => 255],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
//            'authKey' => Yii::t('app', 'Auth Key'),
//            'accessToken' => Yii::t('app', 'Access Token'),
        ];
    }

    public function getAuthKey(): string {
        return $this->authKey; 
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey): bool {
        return $this->authKey===$authKey;
    } 

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return self::findOne(['accessToken'=>$token]);
    }

    public function findByUserName($username) {
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password) {
        return password_verify($password,$this->password);
    }
    
    }
