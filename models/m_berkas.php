<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('modelTemplate')) {
    require __DIR__ . '/modelTemplate.php';
}

class M_berkas extends modelTemplate {

    public $nameTable = 'konseling';

     
    public function getAttributesLabel($attributes = null, $valueOnly = false) {
        $result = array(
            'berkas' => 'Berkas',
            'keterangan' => 'Keterangan',
            'tgl_upload' => 'Tgl Upload',
            'judul' => 'Judul',
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
     
    public function validation() {
        return array(
            array(
                'keterangan,tgl_upload,judul', 'required',
            ),
        );
    }
   

}

?>