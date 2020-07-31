<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pagoservicio}}".
 *
 * @property int $id_pago
 * @property int $id_servicio
 * @property string $estado
 * @property string $monto
 * @property string|null $saldo
 *
 * @property Pago $pago
 * @property Servicio $servicio
 */
class Pagoservicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pagoservicio}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id_pago', 'id_servicio', 'estado', 'monto'], 'required'],
            [['id_servicio', 'estado', 'monto'], 'required'],
            [['id_pago', 'id_servicio'], 'integer'],
            [['estado', 'monto', 'saldo'], 'string', 'max' => 45],
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
            'estado' => Yii::t('app', 'Estado'),
            'monto' => Yii::t('app', 'Monto'),
            'saldo' => Yii::t('app', 'Saldo'),
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
     * @return PagoservicioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagoservicioQuery(get_called_class());
    }
}
