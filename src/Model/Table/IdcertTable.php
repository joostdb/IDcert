<?php
/**
 * Created by PhpStorm.
 * User: Joost De Bock
 * Date: 4/06/2015
 * Time: 8:56
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class IdcertTable extends Table
{

    public function initialize(array $config) : void
    {
        $this->setTable('Idcert');
        $this->addBehavior('Timestamp');


        $this->hasOne('Archief', [
            'className' => 'Archief',
            'bindingKey' => 'SKU',
            'foreignKey' => 'ID'

        ]);

    }

    public function getcert($id)
    {
        $query = $this->find('all');
        $query->where(['Idcert.certID IS' => $id]);
        return $query->toArray();

    }
    public function getlist($id)
    {
        $query = $this->find('all');
        $query->where(['Idcert.SKU' => $id]);
        return $query;

    }

    public function getorder($id)
    {
        $query = $this->find('all');
        $query->where(['Idcert.orderID' => $id]);
        return $query;

    }

    public function idcertall()
    {
        $query = $this->find('all')->contain(['Archief']);
        $query->where(['Idcert.active' => 1]);
        return $query;

    }



}
