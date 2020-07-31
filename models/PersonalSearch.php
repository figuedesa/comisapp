<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Personal;
use app\models\Funcion;

/**
 * PersonalSearch represents the model behind the search form of `app\models\Personal`.
 */
class PersonalSearch extends Personal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'], // Quité 'id_funcion' como entero y le puse abajo
            [['apellido', 'nombre', 'domicilio', 'telefono', 'id_funcion', 'fecha_alta', 'fecha_baja', 'Observacion'], 'safe'],
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
        $query = Personal::find();

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
        
        //Agrego la unión para poder buscar
        $query->joinWith('funcion');
        
        // grid filtering conditions
        $query->andFilterWhere([
            'personal.id' => $this->id,
            //'id_funcion' => $this->id_funcion, //Deshabilito la busqueda entera
            'fecha_alta' => $this->fecha_alta,
            'fecha_baja' => $this->fecha_baja,
        ]);

        $query->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'personal.nombre', $this->nombre])
            ->andFilterWhere(['like', 'domicilio', $this->domicilio])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'Observacion', $this->Observacion])
            //y agrego el filtro para el campo relacionado con la clave foránea
            ->andFilterWhere(['like', 'funcion.nombre', $this->id_funcion]);
            
        return $dataProvider;
    }
}
