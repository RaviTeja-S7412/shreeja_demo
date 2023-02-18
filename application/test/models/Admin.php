<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Admin extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}

	public function info($column=""){
		
		return $this->db->get_where("fdm_va_general_contact")->row()->$column;
		
	}

		public function insertoption($option_name,$option_value){
		
		
		$on=$this->db->get_where("fdm_va_options",array('option_name'=>$option_name));
		
		$os=$on->num_rows();
		
		if($os=='0'){
			
			$data=array("option_name"=>$option_name,
					   "option_value"=>$option_value);
			
			$oss=$this->db->insert("fdm_va_options",$data);
			
			
			
			
			
		}
		
		if($os='1'){
			
				$data=array("option_name"=>$option_name,
					   "option_value"=>$option_value);
			
			$oss=$this->db->set($data);
			
			$oss=$this->db->where("option_name",$option_name);
			
			$oss=$this->db->update("fdm_va_options");
			
			
			
		
		}		
		
		
		
		
	}
	
	
	public function get_option($option_name){
		
		$option=$this->db->get_where("fdm_va_options",array("option_name"=>$option_name));
		$o=$option->row();
		if($o){
		
		return $o->option_value;	
		}else{
			$oo='0';
		return $oo;
		}
	}


	public function get_admin($value=""){

		return $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id")))->row()->$value;


	}

	public function get_role(){
		return $this->db->get_where("fdm_va_roles")->result();
	}

	public function get_user($value=""){

		return $this->db->get_where("fdm_va_users",array("id"=>$this->session->userdata("user_id")))->row()->$value;
	}

	public function get_user_role(){
		$rr = $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id"),"role"=>2))->row();
        return $rr;
	}

	public function get_admin_role(){

		return $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id"),"role"=>1))->row();
	}
	public function get_editor_role(){

		return $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id"),"role"=>3))->row();
	}

	public function get_module($id){
		$umr = $this->db->get_where("fdm_va_admin_role_access",array("user_id"=>$id))->result_array();
		//print_r($umr);
		$kk = array();
		foreach ($umr as $key) {
		$kk[] =  $key["module_id"];

		}
		return $kk;

	}

	public function getUrlmodule($uid,$mid){

		$mod = $this->db->get_where("fdm_va_admin_role_access",array("user_id"=>$uid,"module_id"=>$mid))->row();
		return $mod;

	}

	public function getheaderLogo(){

		return $this->db->query("select * from fdm_va_general_logo where deleted=0 and logo_type='Header' order by id desc")->row()->logo;
	}

	public function getfooterLogo(){

		return $this->db->query("select * from fdm_va_general_logo where deleted=0 and logo_type='Footer' order by id desc")->row()->logo;
	}


	function seo_friendly_url($string){
	    $string = str_replace(array('[\', \']'), '', $string);
	    $string = preg_replace('/\[.*\]/U', '', $string);
	    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
	    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
	    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
	    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
	    return strtolower(trim($string, '-'));
	}
	
	public function getSociallinks(){
		
		return $this->db->get_where("fdm_va_social_networking",array("deleted"=>0,"status"=>"Active"))->result();
		
	}
	
	
		/*
	*Generate Order ID
	*
	*/
		public function generateOrderId(){
		
		$result = $this->db->query('SELECT id from orders order by id desc')->row(); 
		
		if(isset($result->id)){
			
			$c = $result->id + 1;
			$invoice = "ORD2130000".$c;
			
		}else{
			
			$invoice = "ORD21300000";
			
		}
		
		return $invoice;
	}
	
	public function generatefsOrderId(){
		
		$result = $this->db->query('SELECT id from tbl_free_sample_orders order by id desc')->row(); 
		
		if(isset($result->id)){
			
			$c = $result->id + 1;
			$invoice = "ORDFS2130000".$c;
			
		}else{
			
			$invoice = "ORDFS21300000";
			
		}
		
		
		return $invoice;
	}
	
	public function getNumberinwords($number){
$decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ?  ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paise' : '';
    return ($Rupees ? $Rupees . 'rupees ' : '') . $paise;

		
	}
	
	public function gst_total($pprice,$gst){
	    
	    $total = $pprice - ($pprice * (100/(100+$gst)));
	    
	    return round($total,2);
	    
	}
	
}