<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modelTemplate extends CI_Model {

    public $nameTable;
    public $aktifitas_insert;
    public $aktifitas_update;
    public $aktifitas_delete;

    function __construct() {
        parent::__construct();
    }

    /**
     * insert into table
     * @param array $value 
     */
    public function insertTable($value) {
         if($this->nameTable =='pelanggaran_siswa' || $this->nameTable=='prestasi' || $this->nameTable=='konseling'){
            $value = $value + $this->dataAjaran();
        }
        return $this->db->insert($this->nameTable, $value);
    }

    /**
     * 
     * @param array condition
     * @param mixed $value
     * @return type 
     */
    public function updateTable($value, $condition = array()) {
        if (is_array($condition)) {
            if (count($condition) > 0) {
                foreach ($condition as $key => $row) {
                    $this->db->where($key, $row);
                }
            }
        }
        if($this->nameTable =='pelanggaran_siswa' || $this->nameTable=='prestasi' || $this->nameTable=='konseling'){
            $value = $value + $this->dataAjaran();
        }
        return $this->db->update($this->nameTable, $value);
    }

    /**
     * delete from table
     * @param array $param 
     */
    public function deleteTable($param) {
        return $this->db->delete($this->nameTable, $param);
    }

    /**
     * selecting data
     * @param array $condition
     * @return object 
     */
    public function selectTable($condition = null, $columnSort=null, $sortMethod=null, $limit=null, $offset=null) {
        if (isset($columnSort) && isset($sortMethod)){
            $this->db->order_by($columnSort,$sortMethod);
        }
        if (isset($limit)){
            $this->db->limit($limit); 
            if (isset($offset)){
                $this->db->limit($limit,$offset);
            }
        }
        if (is_array($condition)) {
            if (count($condition) > 0) {
                foreach ($condition as $key => $row) {
                    $this->db->where($key, $row);
                }
            }
        }else if (is_string($condition)){
            $this->db->where($condition);
        }
        $result = $this->db->get($this->nameTable);
        return $result;
    }
    
    /**
     * count field
     * @param array $condition
     * @return integer 
     */
    public function countTable($condition = null){
        $result = $this->db->count_all($this->nameTable);
        if (isset($condition)){
            $this->db->where($condition);
            $result = $this->db->count_all_results($this->nameTable);
        }
        return $result;
    }

    /**
     * get field attributte
     * @return object
     */
    public function getData() {
        return $this->db->field_data($this->nameTable);
    }

    /**
     * get all primary key
     * @return array 
     */
    public function primaryKey() {
        $metadata = $this->getData();
        $result = array();
        foreach ($metadata as $key => $value) {
            if ($value->primary_key == '1') {
                $result[] = $value->name;
            }
        }
        return $result;
    }

    /**
     * list all attributes
     * @return array 
     */
    public function getAttribute() {
        $metadata = $this->getData();
        $result = array();
        foreach ($metadata as $value) {
            $result[$value->name] = $value;
        }
        return $result;
    }

    /**
     * set table name
     * @param string $value 
     */
    public function setTable($value) {
        $this->tableName = $value;
    }
    public function dataAjaran(){
        $year = $this->session->userdata("year");
        $semester = $this->session->userdata("semester");
        
        return $data = array('year'=>$year,'semester'=>$semester);
    }

    /**
     * validate post data
     * @return boolean 
     */
    public function validate() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        if (method_exists($this, 'validation')) {
            $rules = $this->validation();
        }
        $result = true;
        if (isset($rules) && count($rules) > 0) {
            foreach ($rules as $value) {
                $column = explode(',', $value[0]);
                if (is_array($column)) {
                    foreach ($column as $valueColumn) {
                        if (!isset($this->form_validation->_field_data[$valueColumn])) {
                            $this->form_validation->set_rules($valueColumn, $this->getAttributesLabel($valueColumn), $value[1]);
                        } else {
                            $rules = $this->form_validation->_field_data[$valueColumn]['rules'];
                            if (!stripos($rules, $value[1])) {
                                $this->form_validation->set_rules($valueColumn, $this->getAttributesLabel($valueColumn), $rules . '|' . $value[1]);
                            }
                        }
                    }
                }
            }
            $result = $this->form_validation->run();
        }
        return $result;
    }

    /**
     * metadata of table
     * @return array 
     */
    public function getMetadata() { //**Mengambil Struktur dari Tabel dari phpmyadmin
        $metadata = $this->getData();
        $result = array();
        $result['table'] = $this->nameTable;
        foreach ($metadata as $key => $value) {
            if ($value->primary_key == '1') {
                $result['pk'][] = $value->name;
            }
            $result['columns'][$value->name] = $value;
        }

        return $result;
    }

    /**
     * list of tables
     * @return array 
     */
    public function getListTables() {
        return $this->db->list_tables();
    }
    
    
    
    /**
     * selecting data
     * @param array $condition
     * @return object 
     */
    public function selectTableWithJoin($condition = null, $join=null, $group_by= null,$limit=null, $offset=null, $columnSort=null, $sortMethod=null ) {
        if (isset($join)){
            if (is_array($join)){
                foreach ($join as $key => $value) {
                    $this->db->join($key,$value);
                }
            }
        }
        if(isset($group_by)){
            $this->db->group_by($group_by); 
        }
        if (isset($columnSort) && isset($sortMethod)){
            $this->db->order_by($columnSort,$sortMethod);
        }
        if (isset($limit)){
            $this->db->limit($limit); 
            if (isset($offset)){
                $this->db->limit($limit,$offset);
            }
        }
        if (is_array($condition)) {
            if (count($condition) > 0) {
                foreach ($condition as $key => $row) {
                    $this->db->where($key, $row);
                }
            }
        } else if (is_string($condition) && !empty($condition)){               
            $this->db->where($condition);
        }
        
        $result = $this->db->get($this->nameTable);
        return $result;
    }
    public function findBySql($query) {
        $query = $this->db->query($query);
        return $query;
    }
}