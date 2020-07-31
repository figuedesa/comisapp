<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%funcion}}".
 *
 * @property int $id
 * @property string|null $nombre
 *
 * @property Personal[] $personals
 */
class Funcion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%funcion}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonals()
    {
        return $this->hasMany(Personal::className(), ['id_funcion' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FuncionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FuncionQuery(get_called_class());
    }
}
