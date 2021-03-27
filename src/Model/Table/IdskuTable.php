<?php
/**
 * Created by PhpStorm.
 * User: Joost De Bock
 * Date: 4/06/2015
 * Time: 8:56
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class IdskuTable extends Table
{
    public function initialize(array $config) : void
    {
        $this->setTable('ID_SKU');
        $this->addBehavior('Timestamp');


        $this->hasOne('Archief', [
            'className' => 'Archief',
            'bindingKey' => 'pid',
            'foreignKey' => 'ID'

        ]);

    }


    public function getsku($id)
    {
        $query = $this->find('all')->contain(['Archief']);
        $query->where(['Idsku.id' => $id]);
        $query->where(['Idsku.active' => '1']);
        return $query;

    }

    public function getlist($id)
    {
        $query = $this->find('all')->contain(['Archief']);
        $query->where(['Idsku.teamID' => $id]);
        $query->where(['Idsku.active' => '1']);
        return $query;

    }

    public function getlistall()
    {
        $query = $this->find('all')->contain(['Archief']);
        $query->where(['Idsku.active' => '1']);
        return $query;

    }


}
