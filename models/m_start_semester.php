<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('modelTemplate')) {
    require __DIR__ . '/modelTemplate.php';
}

class M_start_semester extends modelTemplate {

    public $nameTable = 'start_semester';

     /**
     * label of attribute
     * @param string $attributes default null
     * @return mixed 
     */
    public function getAttributesLabel($attributes = null, $valueOnly = false) {
        $result = array(
            'start_year' => 'Tahun',
            'start_semester' => 'semester',
            'from_date' => 'dari',
            'to_date' => 'sampai',
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
                'start_year,start_semester,from_date,to_date', 'required',
            ),
        );
    }

   

}

?>