<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pagoservicio;

/**
 * PagoservicioSearch represents the model behind the search form of `app\models\Pagoservicio`.
 */
class PagoservicioSearch extends Pagoservicio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pago', 'id_servicio'], 'integer'],
            [['estado', 'monto', 'saldo'], 'safe'],
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
        $query = Pagoservicio::find();

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
            'id_pago' => $this->id_pago,
            'id_servicio' => $this->id_servicio,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'monto', $this->monto])
            ->andFilterWhere(['like', 'saldo', $this->saldo]);

        return $dataProvider;
    }
}
