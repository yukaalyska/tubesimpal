<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('modelTemplate')) {
    require __DIR__ . '/modelTemplate.php';
}

class M_prestasi extends modelTemplate {

    // table name
    public $nameTable = 'prestasi';
    private $_code = '4000/';

    /**
     * label of attribute
     * @param string $attributes default null
     * @return mixed 
     */
    public function getAttributesLabel($attributes = null, $valueOnly = false) {
        $result = array(
            'nis' => 'Nis',
            'kategori_prestasi' => 'Nama Aspek',
            'keterangan' => 'Keterangan',
            'apresiasi' => 'apresiasi',
            'tanggal' => 'Tgl Input',
            'foto' => 'foto',
            'foto2' => 'foto2'
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
                'nis,kategori_prestasi,tanggal,keterangan,apresiasi', 'required',
            ),
        );
    }

}
