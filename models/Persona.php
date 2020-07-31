<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $id
 * @property string $apellido
 * @property string $nombre
 * @property int $id_empresa
 * @property string|null $cuil
 * @property int|null $tipo_dni
 * @property string|null $nro_dni
 * @property int $id_ocupacion
 * @property string $telefono
 * @property string|null $mail
 * @property string $fecha_alta
 * @property string|null $fecha_baja
 * @property string|null $observacion
 * @property int $id_pais
 *
 * @property Empresa $empresa
 * @property Nacionalidad $pais
 * @property Ocupacion $ocupacion
 * @property Servicio[] $servicios
 */
class Persona extends \yii\db\ActiveRecord
{
    public $nombre_completo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'apellido', 'nombre', 'id_empresa', 'id_ocupacion', 'telefono', 'fecha_alta', 'id_pais'], 'required'],
            [['id', 'id_empresa', 'tipo_dni', 'id_ocupacion', 'id_pais'], 'integer'],
            [['fecha_alta', 'fecha_baja'], 'safe'],
            [['apellido', 'nombre', 'cuil', 'nro_dni'], 'string', 'max' => 45],
            [['telefono', 'mail'], 'string', 'max' => 60],
            [['observacion'], 'string', 'max' => 128],
            [['id'], 'unique'],
            [['nombre_completo'],'safe'],
            [['id_empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_empresa' => 'id']],
            [['id_pais'], 'exist', 'skipOnError' => true, 'targetClass' => Nacionalidad::className(), 'targetAttribute' => ['id_pais' => 'id']],
            [['id_ocupacion'], 'exist', 'skipOnError' => true, 'targetClass' => Ocupacion::className(), 'targetAttribute' => ['id_ocupacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'apellido' => Yii::t('app', 'Apellido'),
            'nombre' => Yii::t('app', 'Nombre'),
            'id_empresa' => Yii::t('app', 'Empresa'),
            'cuil' => Yii::t('app', 'Cuil'),
            'tipo_dni' => Yii::t('app', 'Tipo Dni'),
            'nro_dni' => Yii::t('app', 'DNI'),
            'id_ocupacion' => Yii::t('app', 'Ocupacion'),
            'telefono' => Yii::t('app', 'Telefono'),
            'mail' => Yii::t('app', 'Mail'),
            'fecha_alta' => Yii::t('app', 'Fecha Alta'),
            'fecha_baja' => Yii::t('app', 'Fecha Baja'),
            'observacion' => Yii::t('app', 'Observacion'),
            'id_pais' => Yii::t('app', 'Nacionalidad'),
            'nombre_completo'=>Yii::t('app', 'Proveedor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'id_empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Nacionalidad::className(), ['id' => 'id_pais']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOcupacion()
    {
        return $this->hasOne(Ocupacion::className(), ['id' => 'id_ocupacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicio::className(), ['id_persona' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PersonaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaQuery(get_called_class());
    }
    
    //Atributo Virtual
    public function afterFind() {
        parent::afterFind();
        // Concateno el nombre y apellido en el nuevo atributo virtual
        $this->nombre_completo = "{$this->nombre} {$this->apellido}";
    }    
    
}
