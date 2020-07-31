<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Pagoservicio]].
 *
 * @see Pagoservicio
 */
class PagoservicioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pagoservicio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pagoservicio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
