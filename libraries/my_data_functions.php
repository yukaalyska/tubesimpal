<?php

class My_data_functions {
	
	
	function __construct() {
		
		$this->CI =& get_instance();	
		
	}
	
	
	function get_admin_username($id){
	
		$this->CI->db->where('id_admin', $id);
		$query = $this->CI->db->get('user_admin');
		$row = $query->row();
		
		if($query->num_rows>0)
			$name = $row->username;	
		else
			$name = '-';
			
		return $name;	
		
	}
	
	
	function get_skpd_list(){
		
		$query = $this->CI->db->get('skpd');
		
		return $query;	
			
	}
	
	function cek_user_access($user_cat,$user_id,$menu_id){
		//die($user_cat);
		if($user_cat==2){
			return TRUE;
		}else {
		//	die("select * from user_menu where user_id = '$user_id' and menu_id='$menu_id'");
			$query =  $this->CI->db->query("select * from user_menu where user_id = '$user_id' and menu_id='$menu_id'");
			//$rs = mysql_query($sql);
			
			if($query->num_rows()==0)
				return FALSE;
			else
				return TRUE;
		}	
	}
	
	
	function get_menu_list(){
		//$this->db->order_by("no_urut");
		//$this->CI->db->order_by('no_urut');
		//$query = $this->CI->db->get('menu');
		
		$this->CI->db->order_by("no_urut");
		$query = $this->CI->db->get("menu");
		
		return $query;	
			
	}
	
	
}


?>