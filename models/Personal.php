<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal".
 *
 * @property int $id
 * @property string $apellido
 * @property string $nombre
 * @property string $domicilio
 * @property string $telefono
 * @property int $id_funcion
 * @property string $fecha_alta
 * @property string|null $fecha_baja
 * @property string|null $Observacion
 *
 * @property Funcion $funcion
 * @property Servicio[] $servicios
 */
class Personal extends \yii\db\ActiveRecord
{
    public $nombre_completo;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'apellido', 'nombre', 'domicilio', 'telefono', 'id_funcion', 'fecha_alta'], 'required'],
            [['id', 'id_funcion'], 'integer'],
            [['fecha_alta', 'fecha_baja'], 'safe'],
            [['apellido', 'nombre', 'Observacion'], 'string', 'max' => 45],
            [['domicilio'], 'string', 'max' => 80],
            [['telefono'], 'string', 'max' => 60],
            [['id'], 'unique'],
            [['nombre_completo'],'safe'],
            [['id_funcion'], 'exist', 'skipOnError' => true, 'targetClass' => Funcion::className(), 'targetAttribute' => ['id_funcion' => 'id']],
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
            'domicilio' => Yii::t('app', 'Domicilio'),
            'telefono' => Yii::t('app', 'Telefono'),
            'id_funcion' => Yii::t('app', 'Funcion'),
            'fecha_alta' => Yii::t('app', 'Fecha Alta'),
            'fecha_baja' => Yii::t('app', 'Fecha Baja'),
            'Observacion' => Yii::t('app', 'Observacion'),
            'nombre_completo'=>Yii::t('app', 'Personal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncion()
    {
        return $this->hasOne(Funcion::className(), ['id' => 'id_funcion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicio::className(), ['id_personal' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PersonalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonalQuery(get_called_class());
    }
    
    //Atributo Virtual
    public function afterFind() {
        parent::afterFind();
        // Concateno el nombre y apellido en el nuevo atributo virtual
        $this->nombre_completo = "{$this->nombre} {$this->apellido}";
    }    
    
}
