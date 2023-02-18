<?php

defined("BASEPATH") OR exit("No direct script access allow");


class User_model extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}


	public function insert_number($num){
		$check = $this->db->where('user_mobile',$num)->get('shreeja_users');
		$string = '0123456789';
		    $string_shuffled = str_shuffle($string);
		    $otp = substr($string_shuffled, 1, 7);
		    
		    	$fields = array(
				    "sender_id" => "FSTSMS",
				    "message" => "Your OTP to register SHREEJA MILKS is ".$otp."",
				    "language" => "english",
				    "route" => "p",
				    "numbers" => $num,
				);
		    
		if($check->num_rows() > 0){
		    $this->send_sms($num,$fields['message']);
		    $this->db->where("user_mobile",$num)->update("shreeja_users",array("user_otp"=>$otp));
			$data = array("status"=>false,"message"=>"user already registered, OTP sent successfully");
		}else{
			$query = $this->db->insert("shreeja_users",array("user_mobile"=>$num,"user_otp"=>$otp));
			if($query){
			
				$this->send_sms($num,$fields['message']);
                
			/*	$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => json_encode($fields),
				  CURLOPT_HTTPHEADER => array(
				    "authorization: SFAH2nPCDJWw1iZeydTKvmptXMbgu94G8BQ6ajoscNkqYVOx3RXO4mK0DbcIMoCR7GsNJQEB8TrVe1lY",
				    "accept: ",
				    "cache-control: no-cache",
				    "content-type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);*/

				curl_close($curl);

				/*if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  echo $response;
				}*/

				$uid = $this->db->where('user_mobile',$num)->get('shreeja_users')->row()->userid;
				$data = array("status"=>true,"message"=>"mobile number added, check otp");
			}else{
				$data = array("status"=>false,"message"=>"something went wrong please try again");
			}
		}
		return $data;

	}
	
	public function send_sms($mobile,$message){

		
		$mob = urlencode($mobile);
		$mes = urlencode($message);	
		$sms=fopen("http://www.bulksmsapps.com/api/apismsv2.aspx?apikey=1a155645-2cb8-4fdf-9ef3-c4a84aa904d6&sender=SMMPCL&number=$mob&message=$mes",'r');
		$response = stream_get_contents($sms);
		if(empty ($response))
		{
			//echo " buffer is empty "; 
			log_message("info","buffer is empty");
		}
		else
		{
//			echo $response;
			log_message("info",$response);
		}


			log_message("info",$mobile);
			log_message("info",$message);

	}
	
	public function check_otp($num,$otp){
		$check = $this->db->where('user_mobile',$num)->get('shreeja_users');
		if($check->num_rows() > 0){
			$row = $check->row();
			if($otp == $row->user_otp){
				$data = array("status"=>true,"message"=>"successfully verified","userid"=>$row->userid);
			}else{
				$data = array("status"=>false,"message"=>"incorrect otp");
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}

	public function location_update($userid,$locid){
		$check = $this->db->where('userid',$userid)->get('shreeja_users');
		if($check->num_rows() > 0){
			$query = $this->db->where('userid',$userid)->update("shreeja_users",array('user_location'=>$locid));
			if($query){
				$data = array("status"=>true,"message"=>"location data updated successfully");
			}else{
				$data = array("status"=>false,"message"=>"Something went wrong , please try again");	
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}

	public function personal_update($data){
		$userid = $this->input->post('userid');
		$content =array(
			"user_name"=>$this->input->post('name'),
			"alt_number"=>$this->input->post('alt_number'),
			"user_email"=>$this->input->post('email'),
			"user_city"=>$this->input->post('city'),
			"user_area"=>$this->input->post('area'),
			"user_locality"=>$this->input->post('locality'),
			"user_current_address"=>$this->input->post('address'),
			"user_gps"=>$this->input->post('gps_loc')
		);
		$check = $this->db->where('userid',$userid)->get('shreeja_users');
		if($check->num_rows() > 0){
			$query = $this->db->where('userid',$userid)->update("shreeja_users",$content);
			if($query){
				$data = array("status"=>true,"message"=>"personal data updated successfully");
			}else{
				$data = array("status"=>false,"message"=>"Something went wrong , please try again");	
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}


	public function shreeja_locations(){
		$query = $this->db->where("status",0)->get("shreeja_locations")->result_array();
		$i = 0;
		$data = array();
		foreach ($query as $row) {
			$data[$i] = $row;
			$i++;
		}
		if($data){
			return array("status"=>true,"locations"=>$data);
		}else{
			return array("status"=>true,"message"=>"locations not found");	
		}
	}

	public function get_user($userid){
		$check = $this->db->where('userid',$userid)->get('shreeja_users');
		if($check->num_rows() > 0){
			$row = $check->row_array();
			if($row){
				$data = array("status"=>true,"message"=>"user data", "userdata"=>$row);
			}else{
				$data = array("status"=>false,"message"=>"Something went wrong , please try again");	
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}
	
		
}