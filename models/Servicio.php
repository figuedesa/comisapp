<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%servicio}}".
 *
 * @property int $id
 * @property int $id_persona
 * @property string|null $descripcion
 * @property int|null $numero Campo NN
 * @property int $mesa
 * @property string $fecha
 * @property float|null $importe
 * @property float|null $porcentaje
 * @property float $importe_comision
 * @property int|null $packs Campo NN
 * @property int|null $id_personal
 *
 * @property PagoServicio[] $pagoServicios
 * @property Pago[] $pagos
 * @property Persona $persona
 * @property Personal $personal
 */
class Servicio extends \yii\db\ActiveRecord
{
    public $proveedor;
    public $atencion;
    public $titulo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%servicio}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_persona', 'mesa', 'fecha', 'importe_comision'], 'required'],
            [['id', 'id_persona', 'numero', 'mesa', 'packs', 'id_personal'], 'integer'],
            [['fecha'], 'safe'],
            [['importe', 'porcentaje', 'importe_comision'], 'number'],
            [['descripcion'], 'string', 'max' => 80],
            [['id'], 'unique'],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['id_persona' => 'id']],
            [['id_personal'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_personal' => 'id']],
            [['proveedor','atencion','titulo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_persona' => Yii::t('app', 'Proveedor'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'numero' => Yii::t('app', 'Numero'),
            'mesa' => Yii::t('app', 'Mesa'),
            'fecha' => Yii::t('app', 'Fecha'),
            'importe' => Yii::t('app', 'Importe'),
            'porcentaje' => Yii::t('app', 'Porcentaje'),
            'importe_comision' => Yii::t('app', 'Importe Comision'),
            'packs' => Yii::t('app', 'Packs'),
            'id_personal' => Yii::t('app', 'Personal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoServicios()
    {
        return $this->hasMany(PagoServicio::className(), ['id_servicio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['id' => 'id_pago'])->viaTable('{{%pago_servicio}}', ['id_servicio' => 'id']);
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
     * @return ServicioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicioQuery(get_called_class());
    }
    
    // Este método se invoca después de usarse Servicio::find()
    // Aquí se pueden establecer valores para los atributos virtuales
    public function afterFind() {
        parent::afterFind();
        // Concateno el nombre y apellido del proveedor en el nuevo atributo virtual
        $this->proveedor = "{$this->persona->nombre} {$this->persona->apellido}";
        // Concateno el nombre y apellido del personal que atendió en el nuevo atributo virtual
        $this->atencion = "{$this->personal->nombre} {$this->personal->apellido}";
        // Concateno datos del servicio para el nuevo atributo virtual
        $this->titulo = "N°Serv: {$this->id} {$this->fecha} {$this->descripcion} {$this->proveedor}";
        
        // Calculo y asigno la edad en años en el nuevo atributo virtual
        /*
        $nacimiento = new \DateTime($this->fecha_nacimiento);
        $hoy = new \DateTime();
        $edad = $hoy->diff($nacimiento);
        $this->edad = $edad->y; // Se puede usar también $edad->m (meses), $edad->d (días), etc.
        */
    }    
}
