<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

use app\models\FormRegister;
use app\models\Users;

class Users extends ActiveRecord{
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function tableName()
    {
        return 'users';
    }
    
}