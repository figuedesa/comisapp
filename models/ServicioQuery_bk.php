<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Servicio]].
 *
 * @see Servicio
 */
class ServicioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Servicio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Servicio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
