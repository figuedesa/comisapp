<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ocupacion]].
 *
 * @see Ocupacion
 */
class OcupacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Ocupacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ocupacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
