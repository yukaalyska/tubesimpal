<?php

class My_functions {
	
	
	function __construct(){
		
		$this->CI =& get_instance();

	}

	
	function get_indo_date_format($date,$showtime=0,$separator="-"){
	
		if(strlen($date)>10){
			$datetime = explode(" ",$date);
			$date = $datetime[0];			
			$time = $datetime[1];
		}
		
		$date = explode($separator,$date);
		
		if($showtime==0)
			$indodate = $date['2']."-".$date['1']."-".$date['0'];
		else
			$indodate = $date['2']."-".$date['1']."-".$date['0']." ".$time;
			
		return $indodate;	
		
	}
	
	
	function get_status_image($status){
		
		if($status==1)			
			$img ='<img src="'.base_url().$this->CI->config->item('media_images_url').'valid.png"/>';		
		else			
			$img = '<img src="'.base_url().$this->CI->config->item('media_images_url').'invalid.png"/>';
			
		return $img;
	
	}


	function create_add_button($mod){
		
		$button = 
		'<input name="addbutton" type="button" class="add-button" id="addbutton" 
		onclick="location=\''.$mod.'/show_add_form\'" />';
		
		return $button;
		
	}
	
	
	function create_edit_button($mod,$id,$action='show_edit_form'){

		$button = anchor(
					  'backend/'.$mod.'/'.$action.'/id/'.$id,
					  '<img src="'.base_url().$this->CI->config->item('media_images_url').'page_white_edit.png">',
					  array('title'=>'Edit Data')
				  );
		
		return $button;	
	
	}


	function create_delete_button($mod,$id){
		$button = anchor(
					 'backend/'. $mod.'/delete/id/'.$id,
					  '<img src="'.base_url().$this->CI->config->item('media_images_url').'page_white_delete.png">',
					  array('onclick'=>"return confirm('Apakah anda yakin akan menghapus data ini?')",'title'=>'Hapus Data')
				  );
		
		
		return $button;	
	
	}
	

}