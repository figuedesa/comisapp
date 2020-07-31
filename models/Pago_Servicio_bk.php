<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago_servicio".
 *
 * @property int $id_pago
 * @property int $id_servicio
 *
 * @property Pago $pago
 * @property Servicio $servicio
 */
class Pago_Servicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago_servicio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pago', 'id_servicio'], 'required'],
            [['id_pago', 'id_servicio'], 'integer'],
            [['id_pago', 'id_servicio'], 'unique', 'targetAttribute' => ['id_pago', 'id_servicio']],
            [['id_pago'], 'exist', 'skipOnError' => true, 'targetClass' => Pago::className(), 'targetAttribute' => ['id_pago' => 'id']],
            [['id_servicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicio::className(), 'targetAttribute' => ['id_servicio' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pago' => Yii::t('app', 'Id Pago'),
            'id_servicio' => Yii::t('app', 'Id Servicio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPago()
    {
        return $this->hasOne(Pago::className(), ['id' => 'id_pago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicio::className(), ['id' => 'id_servicio']);
    }

    /**
     * {@inheritdoc}
     * @return PagoServicioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagoServicioQuery(get_called_class());
    }
}
