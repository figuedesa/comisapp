<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Empresa]].
 *
 * @see Empresa
 */
class EmpresaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Empresa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Empresa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
