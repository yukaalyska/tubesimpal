<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('modelTemplate')) {
    require __DIR__ . '/modelTemplate.php';
}

class aspek_model extends modelTemplate {

    // table name
    public $nameTable = 'aspek';
    private $_code = '4000/';

    /**
     * label of attribute
     * @param string $attributes default null
     * @return mixed 
     */
    public function getAttributesLabel($attributes = null, $valueOnly = false) {
        $result = array(
            'nama_aspek' => 'Nama Aspek',
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
                'nama_aspek', 'required',
               
            ),
        );
    }
 
   
}
