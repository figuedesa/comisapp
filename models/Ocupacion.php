<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ocupacion".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Persona[] $personas
 */
class Ocupacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ocupacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre'], 'required'],
            [['id'], 'integer'],
            [['nombre'], 'string', 'max' => 60],
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
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['id_ocupacion' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OcupacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OcupacionQuery(get_called_class());
    }
}