<?php
// src/Model/Table/ArchiefgdTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Intervention\Image\ImageManager;
use Cake\Cache\Cache;

class ArchiefTable extends Table
{
    public function initialize(array $config) : void
    {
        $this->setTable('archief');

    }


    public function scanarchief($limit, $offset, $ids)
    {

        $query = $this->find('all')
            ->where(['Archief.team_ID IN' => $ids])
            ->where(['Archief.showa =' => '1'])
            ->where(['Archief.ID >=' => $offset])
            ->where(['Archief.datetaken >= ' => '20170101000000', 'Archief.datetaken <= ' => '20190102999999'])
            ->order(['Archief.ID' => 'ASC'])
            ->limit($limit);
        return $query;

    }


    public function showitem($id)
    {

        $timestamp = "Do not use without permission. ";

        $new_folder = str_replace('archive', 'xlprev', $id['directory']);
        $new_filename = "XL_".$id['filename'];

        $path_xl_preview = "/var/www/clients/client1/web1/web/".$new_folder;
        $new = $path_xl_preview."/".$new_filename;

        if(!is_dir($path_xl_preview)){
            @mkdir($path_xl_preview, 1775, true);
        }


        if (!file_exists('/var/www/clients/client1/web1/web/'.$new_folder."/".$new_filename)) {
            $copyright = "© ID/ photo agency - " . $id['team']['vol_naam'] . " | #" . $id['ID'];


            $manager = new ImageManager();
            if ($id['height'] <= $id['width']) { //horizontale foto
                $image = $manager->make('/var/www/clients/client1/web1/web/' . $id['URL'])
                    ->resize(1280, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->insert('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/img/copyright.png', 'center')
                    ->rectangle(0, 730, 870, 805, function ($draw) {
                        $draw->background('#cc3333');
                    })
                    ->text($copyright, 41, 760, function ($font) {
                        $font->file('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/font/OpenSans-Regular.ttf');
                        $font->size(25);
                        $font->color('#ffffff');
                    })
                    ->text($timestamp, 40, 785, function ($font) {
                        $font->file('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/font/OpenSans-Light.ttf');
                        $font->size(15);
                        $font->color('#ffffff');
                    })
                    ->insert('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/img/web20.png', 'bottom-right', 20, -55)
                    ->insert('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/img/print25.png', 'bottom-right', 20, -60)
                    ->interlace();
            } else {
                $image = $manager->make('/var/www/clients/client1/web1/web/' . $id['URL'])
                    ->resize(null, 1280, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->insert('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/img/copyright.png', 'center')
                    ->rectangle(0, 1170, 1000, 1245, function ($draw) {
                        $draw->background('#cc3333');
                    })
                    ->text($copyright, 40, 1205, function ($font) {
                        $font->file('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/font/OpenSans-Regular.ttf');
                        $font->size(25);
                        $font->color('#ffffff');
                    })
                    ->text($timestamp, 40, 1230, function ($font) {
                        $font->file('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/font/OpenSans-Light.ttf');
                        $font->size(15);
                        $font->color('#ffffff');
                    })
                    ->insert('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/img/web20.png', 'bottom-right', 20, -55)
                    ->insert('/var/www/clients/client1/web1/web/idphotoagency_public/webroot/img/print25.png', 'bottom-right', 20, -60)
                    ->interlace();
            }
            $image->save($new, 60);


        }


        $id['newname'] = $new_folder."/".$new_filename;
        $item  = $id;
        return $item;

    }


    public function scanteam($team)
    {

        $query = $this->find('all')
            ->where(['Archief.initialen' => $team])
            ->where(['Archief.backup' => '0'])
            ->order(['Archief.ID' => 'ASC']);
        return $query;

    }

    public function countuploads($id, $datefrom, $dateto)
    {

        $query = $this->find('all')
            ->where(['Archief.team_ID' => $id])
            ->where(['Archief.dateentered >' => $datefrom])
            ->where(['Archief.dateentered <' => $dateto])
            ->order(['Archief.ID' => 'ASC'])
            ->cache('__countuploads_' . md5($id), 'long');
        return $query->count();

    }

    public function counttaken($id, $datefrom, $dateto)
    {

        $query = $this->find('all')
            ->where(['Archief.team_ID' => $id])
            ->where(['Archief.datetaken >' => $datefrom])
            ->where(['Archief.datetaken <' => $dateto])
            ->order(['Archief.ID' => 'ASC'])
            ->cache('__counttaken_' . md5($id), 'long');
        return $query->count();

    }


    public function randomimage($team)
    {

        $query = $this->find('all')
            ->where(['Archief.initialen' => $team])
            ->where(['Archief.backup' => '0'])
            ->order(['Archief.ID' => 'desc'])
            ->limit(500);
        return $query->toArray();

    }
    public function randomimage_rest($team)
    {

        $query = $this->find('all')
            ->where(['Archief.initialen <>' => $team])
            ->where(['Archief.backup' => '0'])
            ->limit(10000);
        return $query->toArray();

    }

}

