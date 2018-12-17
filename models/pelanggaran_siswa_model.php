<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('modelTemplate')) {
    require __DIR__ . '/modelTemplate.php';
}

class pelanggaran_siswa_model extends modelTemplate {

    // table name
    public $nameTable = 'pelanggaran_siswa';
    private $_code = '4000/';

    /**
     * label of attribute
     * @param string $attributes default null
     * @return mixed 
     */
    public function getAttributesLabel($attributes = null, $valueOnly = false) {
        $result = array(
            'nis' => 'Nis',
            'id_aspek' => 'Nama Aspek',
            'idpelanggaran' => 'Jenis Pelanggaran',
            'tgl_pelanggaran' => 'Tanggal',
            'poin_pelanggaran' => 'Point Pelanggaran',
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
                'nis,id_aspek,idpelanggaran,poin_pelanggaran,tgl_pelanggaran', 'required',
            ),
            array(
               'poin_pelanggaran','numeric',
            ),
        );
    }

}
