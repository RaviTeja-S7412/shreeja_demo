<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Admin extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}
	
	public function getReferrers($referal_id,$user_id){
		
		$refdata = $this->db->get_where("shreeja_users",["referral_id"=>$referal_id]);
		
		if($refdata->num_rows() == 1){
			
			$rdata = $refdata->row();
			$chkref = $this->db->get_where("tbl_user_referrals",["referrer_id"=>$rdata->userid,"referee_id"=>$user_id])->num_rows();
			$chkref1 = $this->db->get_where("tbl_user_referrals",["referrer_id"=>$user_id,"referee_id"=>$rdata->userid])->num_rows();
			
			if(($chkref == 0) && ($chkref1 == 0)){
				
				$this->db->insert("tbl_user_referrals",["referrer_id"=>$rdata->userid,"referee_id"=>$user_id,"referrer_type"=>"Customer","cdate"=>date("Y-m-d H:i:s")]);
				return ["status"=>true,"message"=>"Successfully Refered"];
				
			}else{
				
				return ["status"=>false,"message"=>"Users Already Refered"];
				
			}
			
			
		}else{
			
			$arefdata = $this->db->get_where("fdm_va_auths",["referral_id"=>$referal_id]);
			
			if($arefdata->num_rows() == 1){
			
				$rdata = $arefdata->row();
				$chkref = $this->db->get_where("tbl_user_referrals",["referrer_id"=>$rdata->id,"referee_id"=>$user_id])->num_rows();
				$chkref1 = $this->db->get_where("tbl_user_referrals",["referrer_id"=>$user_id,"referee_id"=>$rdata->id])->num_rows();

				if(($chkref == 0) && ($chkref1 == 0)){

					$this->db->insert("tbl_user_referrals",["referrer_id"=>$rdata->id,"referee_id"=>$user_id,"referrer_type"=>"Agent","cdate"=>date("Y-m-d H:i:s")]);
					return ["status"=>true];
					
				}else{

					return ["status"=>false,"message"=>"Users Already Refered"];

				}	
				
			}else{
				
				return ["status"=>false,"message"=>"Referal ID Invalid."];
				
			}
			
		}
		
	}
	
	public function generatefsOrderId(){
		
		$result = $this->db->query('SELECT id from tbl_free_sample_orders order by id desc')->row(); 
		
		if(isset($result->id)){
			
			$c = $result->id + 1;
			$invoice = "ORDFS1930000".$c;
			
		}else{
			
			$invoice = "ORDFS19300000";
			
		}
		
		$i='1';
		
// 		do{
			
			$id = $invoice;
		    $oChk = $this->db->get_where("tbl_free_sample_orders",array("order_id"=>$id))->num_rows();
			
			if($oChk>0){
				$i='1';
				
				$c = $result->id + 2;
			    $id = "ORDFS1930000".$c; 
				
			}else{
				$i='10';
			}
			
			
			
// 		}while($i<5);
		
		return $id;
		
	}
	
				/*
	*Generate Order ID
	*
	*/
	public function generateOrderId(){
		
		$result = $this->db->query('SELECT id from orders order by id desc')->row(); 
		
		if(isset($result->id)){
			
			$c = $result->id + 1;
			$invoice = "ORD1830000".$c;
			
		}else{
			
			$invoice = "ORD18300000";
			
		}
		
		return $invoice;
		
		
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

		public function generateNewsid(){
		
		
		$i='1';
		
		do{
			
			$id="NEWS".random_string("numeric",8);
			
			$chk=$this->db->get_where("fdm_va_news_and_community",array('id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}


	public function generateOtp(){
		
		
		$i='1';
		
		do{
			
			$id=random_string("numeric",8);
			
			$chk=$this->db->get_where("fdm_va_otp",array('otp'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	public function generateReferralid(){
		
		
		$i='1';
		
		do{
			
			$id=random_string("numeric",6);
			
			$chk=$this->db->get_where("shreeja_users",array('referral_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	
	public function getAgentreferral_id(){
		
		
		$i='1';
		
		do{
			
			$id=random_string("numeric",6);
			
			$chk=$this->db->get_where("fdm_va_auths",array('referral_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
	

	public function get_admin($value="",$id=""){

		if($id){
			
			$uid = $id;
			
		}else{
			
			$uid = $this->session->userdata("admin_id"); 
			
		}
		
		return $this->db->get_where("fdm_va_auths",array("id"=>$uid))->row()->$value;


	}

	public function get_role(){
		return $this->db->get_where("fdm_va_roles")->result();
	}

	public function get_user($value=""){

		return $this->db->get_where("fdm_va_users",array("id"=>$this->session->userdata("user_id")))->row()->$value;
	}

	public function get_agent_role(){
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
	
	
	public function info($column=""){
		
		return $this->db->get_where("fdm_va_general_contact")->row()->$column;
		
	}
	
			/*
	*Generate Order ID
	*
	*/
	
	
	public function generateagentOrderId(){
			$i='1';
		
		do{
			
			$id="AO".random_string("numeric",8);
			
			$chk=$this->db->get_where("agent_orders",array('order_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
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

	
	function firebase_notification($tokens,$message){
	
		$url = "https://fcm.googleapis.com/fcm/send";
		$fields = array(

			"registration_ids" => $tokens,
			"data" => $message
		);

		$api_key = 'AIzaSyA8k2cSb1Lju1kWsTxCk02QBWra1uS5fYA';
		
		$headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );


		$ch = curl_init();
		   curl_setopt($ch, CURLOPT_URL, $url);
		   curl_setopt($ch, CURLOPT_POST, true);
		   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		   curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		   $result = curl_exec($ch);           
		   if ($result === FALSE) {
			   die('Curl failed: ' . curl_error($ch));
		   }
		   curl_close($ch);
		   return $result;
	}

	function firebase_notification_subscribe($tokens,$message){
	
		$url = "https://fcm.googleapis.com/fcm/send";
		$fields = array(

			"to" => $tokens,
			"data" => $message
		);

		$api_key = 'AIzaSyA8k2cSb1Lju1kWsTxCk02QBWra1uS5fYA';
		
		$headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );


		$ch = curl_init();
		   curl_setopt($ch, CURLOPT_URL, $url);
		   curl_setopt($ch, CURLOPT_POST, true);
		   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		   curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		   $result = curl_exec($ch);           
		   if ($result === FALSE) {
			   die('Curl failed: ' . curl_error($ch));
		   }
		   curl_close($ch);
		   return $result;
	}
	
	public function get_assigned_agents(){
		$rr = $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id")))->row()->assigned_agents;
        return json_decode($rr);
	}
	
	public function getAllagents(){	
			
		return $this->db->where_in("role",[2,3,4,5,13])->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();	
			
	}
	
	
	
	
	public function getAllunassdagents($city = ""){
		
		if($city != ""){
			$this->db->where(["city"=>$city]);
		}
		$exAgts = $this->db->select('assigned_agents')->get_where("fdm_va_auths",array("role"=>7))->result();
		foreach($exAgts as $eag){

			$this->db->where_not_in("id",json_decode($eag->assigned_agents)->agents);	

		}

		return $this->db->where_in("role",[2,3,4,5,13])->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();
		
	}
	
	public function allunAssndti($city = ""){
		
		if($city != ""){
			$this->db->where(["city"=>$city]);
		}
		$exAgts = $this->db->select('assigned_agents')->get_where("fdm_va_auths",array("role"=>11))->result();
		
		foreach($exAgts as $eag){

			$this->db->where_not_in("id",json_decode($eag->assigned_agents)->tincharge);	

		}
		return $this->db->where("role",12)->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();
		
	}
	
	public function allunAssndsemp($city = ""){
		
		if($city != ""){
			$this->db->where(["city"=>$city]);
		}
		$exAgts = $this->db->select('assigned_agents')->get_where("fdm_va_auths",array("role"=>12))->result();
		
		foreach($exAgts as $eag){

			$this->db->where_not_in("id",json_decode($eag->assigned_agents)->salesemployees);	

		}
		return $this->db->where("role",7)->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();
	}
			
	
	
	
	public function cunassignedsemp($id){
		
		$exAgts = $this->db->select('assigned_agents')->get_where("fdm_va_auths",array("role"=>11))->result();
		
		return($exAgts);
		
		if(count($exAgts) > 0){
			
			foreach($exAgts as $eag){
				
				$this->db->where_not_in("id",json_decode($eag->assigned_agents)->salesemployees);	
			
			}
			return $this->db->where("role",7)->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();
			
		}else{
			
			return $this->db->where("role",7)->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();
			
		}
	}

	
	
	
	
	
}