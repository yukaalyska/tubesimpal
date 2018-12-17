<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('modelTemplate')) {
    require __DIR__ . '/modelTemplate.php';
}

class M_siswa extends modelTemplate {

    public $nameTable = 'siswa';

     /**
     * label of attribute
     * @param string $attributes default null
     * @return mixed 
     */
    public function getAttributesLabel($attributes = null, $valueOnly = false) {
        $result = array(
            'nis' => 'Nis',
            'namasiswa' => 'Nama Siswa',
            'jurusan' => 'Jurusan',
            'kelas' => 'Kelas',
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
                'nis,namasiswa,jurusan', 'required',
            ),
            array(
               'nis','numeric',
            ),
        );
    }

}

?>