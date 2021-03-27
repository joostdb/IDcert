<?php
// src/Controller/SiteController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Cache\Cache;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\I18n\Number;


class SitesController extends AppController
{
    public $paginate = [
        'limit' => 20
    ];

    public function initialize(): void
    {
        parent::initialize();

    }



    public function go()
    {
        if ($this->request->is(['post', 'put'])) {

            $this->loadModel('Idcert');
            $idcert = $this->Idcert->getcert($this->request->getData('otp'));
            if(!$idcert){
                return $this->redirect(['controller' => 'sites', 'action' => 'go']);
            }
            $idcert = $idcert['0'];
            $idcert['metadata'] = json_decode($idcert['metadata'], true);


            if(!$idcert){
                return $this->redirect(['controller' => 'sites', 'action' => 'go']);
            }


            $this->loadModel('Idsku');

            $idsku = $this->Idsku->get($idcert['SKU']);

            $idsku['des'] = explode("\n", $idsku['description']);
            foreach ($idsku['des'] AS $des){
                $arr = explode(":", $des);
                $deskr[$arr['0']] =  $arr['1'];
            }

            $this->loadModel('Archief');
            $img = $this->Archief->get($idcert['SKU']);





            $this->set('nr', $this->request->getData('otp'));
            $this->set('cert', $idcert);
            $this->set('sku', $idsku);
            $this->set('img', $img);
            $this->set('description', $deskr);
        }
    }

    public function contact()
    {

    }


}
