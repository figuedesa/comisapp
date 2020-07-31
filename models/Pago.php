<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property int $id
 * @property string $fecha
 * @property int $id_personal
 * @property int $id_persona
 * @property float $monto
 *
 * @property PagoServicio[] $pagoServicios
 * @property Servicio[] $servicios
 */
class Pago extends \yii\db\ActiveRecord
{
    public $proveedor;
    public $atencion;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fecha', 'id_personal', 'id_persona', 'monto'], 'required'],
            [['id', 'id_personal', 'id_persona'], 'integer'],
            [['monto'], 'number'],
            [['fecha'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['id_persona' => 'id']],
            [['id_personal'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_personal' => 'id']],
            [['proveedor','atencion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha' => Yii::t('app', 'Fecha'),
            'id_personal' => Yii::t('app', 'Id Personal'),
            'id_persona' => Yii::t('app', 'Id Persona'),
            'monto' => Yii::t('app', 'Monto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoServicios()
    {
        return $this->hasMany(PagoServicio::className(), ['id_pago' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicio::className(), ['id' => 'id_servicio'])->viaTable('pago_servicio', ['id_pago' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['id' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonal()
    {
        return $this->hasOne(Personal::className(), ['id' => 'id_personal']);
    }

    /**
     * {@inheritdoc}
     * @return PagoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagoQuery(get_called_class());
    }
    
    // Este método se invoca después de usarse Servicio::find()
    // Aquí se pueden establecer valores para los atributos virtuales
    public function afterFind() {
        parent::afterFind();
        // Concateno el nombre y apellido del proveedor en el nuevo atributo virtual
        $this->proveedor = "{$this->persona->nombre} {$this->persona->apellido}";
        // Concateno el nombre y apellido del personal que atendió en el nuevo atributo virtual
        $this->atencion = "{$this->personal->nombre} {$this->personal->apellido}";
    }    
}
