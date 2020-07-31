<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Persona;

/**
 * PersonaSearch represents the model behind the search form of `app\models\Persona`.
 */
class PersonaSearch extends Persona
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_dni'], 'integer'],
            [['id_empresa', 'id_ocupacion', 'id_pais','apellido', 'nombre', 'cuil', 'nro_dni', 'telefono', 'mail', 'fecha_alta', 'fecha_baja', 'observacion'], 'safe'],
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
        $query = Persona::find();

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
        
        //Relaciones Paramétricas
        $query->joinWith('empresa');
        $query->joinWith('ocupacion');
        $query->joinWith('pais');
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'persona.id' => $this->id,
            //'id_empresa' => $this->id_empresa,
            'tipo_dni' => $this->tipo_dni,
            //'id_ocupacion' => $this->id_ocupacion,
            //'fecha_alta' => $this->fecha_alta,
            //'fecha_baja' => $this->fecha_baja,
            //'id_pais' => $this->id_pais,
        ]);
        //echo 'Fecha_Alta'.$this->fecha_alta;
        $query->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'persona.nombre', $this->nombre])
            ->andFilterWhere(['like', 'empresa.nombre', $this->id_empresa])
            ->andFilterWhere(['like', 'ocupacion.nombre', $this->id_ocupacion])
            ->andFilterWhere(['like', 'cuil', $this->cuil])
            ->andFilterWhere(['like', 'nro_dni', $this->nro_dni])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'cast(fecha_alta as char)', $this->fecha_alta])
            ->andFilterWhere(['like', 'cast(fecha_baja as char)', $this->fecha_baja])
            ->andFilterWhere(['like', 'pais.denominacion', $this->id_pais])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
