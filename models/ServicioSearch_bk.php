<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Servicio;

/**
 * ServicioSearch represents the model behind the search form of `app\models\Servicio`.
 */
class ServicioSearch extends Servicio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',  'numero', 'mesa', 'packs', 'estado_pago', 'id_Pago', 'id_personal'], 'integer'],
            //[['id_persona','fecha'], 'safe'],
            [['proveedor','fecha'], 'safe'],
            [['importe', 'porcentaje', 'importe_comision'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Servicio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'id_persona' => $this->id_persona,
            //'concat(persona.nombre," ",persona.apellido)' => $this->id_persona,
            'numero' => $this->numero,
            'mesa' => $this->mesa,
            'fecha' => $this->fecha,
            'importe' => $this->importe,
            'porcentaje' => $this->porcentaje,
            'importe_comision' => $this->importe_comision,
            'packs' => $this->packs,
            'estado_pago' => $this->estado_pago,
            'id_Pago' => $this->id_Pago,
            'id_personal' => $this->id_personal,
        ]);

        //Lo que sigue es para poder incluir el campo virtual proveedor en el ordenamiento y filtro
        
        //Relacionar para poder referencia persona
        $query->joinWith("persona");
        //Agregar el atributo de ordenamiento para el campo virtual
        $dataProvider->sort->attributes['proveedor'] = [
            'asc' => ['CONCAT(persona.apellido, " ", persona.nombre)' => SORT_ASC],
            'desc' => ['CONCAT(persona.apellido, " ", persona.nombre)' => SORT_DESC],
        ];

        $query->andFilterWhere(['like', 'concat(persona.nombre," ",persona.apellido)', $this->proveedor]);
        
        return $dataProvider;
    }
}
