<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('modelTemplate')) {
    require __DIR__ . '/modelTemplate.php';
}

class pelanggaran_model extends modelTemplate {

    // table name
    public $nameTable = 'pelanggaran';
    private $_code = '4000/';

    /**
     * label of attribute
     * @param string $attributes default null
     * @return mixed 
     */
    public function getAttributesLabel($attributes = null, $valueOnly = false) {
        $result = array(
            'id_aspek' => 'Nama Aspek',
            'jenis_pelanggaran' => 'Jenis Pelanggaran',
            'sanksi_pelanggaran' => 'Sanksi',
            'poin_pelanggaran' => 'Point',
        );

        if (isset($attributes)) {
            if (isset($result[$attributes])) {
                $result = $result[$attributes];
            }
        }

        if ($valueOnly && is_array($result)) {
            $result = array_values($result);
        }

        return $result;
    }
    /**
     * pass validation data here
     * @return array 
     */
    public function validation() {
        return array(
            array(
                'jenis_pelanggaran,sanksi_pelanggaran,poin_pelanggaran', 'required',
               
            ),
            
            
            array(
               'poin_pelanggaran','numeric',
            ),
        );
    }
 
   
}
