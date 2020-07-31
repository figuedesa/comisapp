<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nacionalidad".
 *
 * @property int $id
 * @property string $denominacion
 *
 * @property Persona[] $personas
 */
class Nacionalidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nacionalidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'denominacion'], 'required'],
            [['id'], 'integer'],
            [['denominacion'], 'string', 'max' => 60],
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
            'denominacion' => Yii::t('app', 'Denominacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['id_pais' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return NacionalidadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NacionalidadQuery(get_called_class());
    }
}
