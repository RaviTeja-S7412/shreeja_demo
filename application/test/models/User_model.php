<?php

defined("BASEPATH") OR exit("No direct script access allow");


class User_model extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}

    
    public function resend_otp($num){
         $string = '0123456789';
		    $string_shuffled = str_shuffle($string);
		    $otp = substr($string_shuffled, 1, 4);
		    $query = $this->db->where("user_mobile",$num)->update("shreeja_users",array("user_otp"=>$otp));
        	$fields = array(
				    "sender_id" => "FSTSMS",
				    "message" => "[#]".$otp." Use this OTP to register in SHREEJA MILKS. H/dLlrhjDfI",
				    "language" => "english",
				    "route" => "p",
				    "numbers" => $num,
				);
				if($query){
			        $this->send_sms($num,$fields['message']);
			        $data = array("status"=>true,"message"=>"OTP sent successfully");
				}else{
				    $data = array("status"=>false,"message"=>"something went wrong");
				}
			
			return $data;
    }
	public function insert_number($num){
		$check = $this->db->where(array('user_mobile'=>$num,"user_status"=>0))->get('shreeja_users');
		if($check->num_rows() > 0){
		    $string = '0123456789';
		    $string_shuffled = str_shuffle($string);
		    $otp = substr($string_shuffled, 1, 4);
				$fields = array(
				    "sender_id" => "FSTSMS",
				    "message" => "[#]".$otp." Use this OTP to register in SHREEJA MILKS. H/dLlrhjDfI",
				    "language" => "english",
				    "route" => "p",
				    "numbers" => $num,
				);
				$query = $this->db->where("user_mobile",$num)->update("shreeja_users",array("user_otp"=>$otp));
				if($query){
			    	$this->send_sms($num,$fields['message']);
		        	$data = array("status"=>true,"message"=>"user already registered, OTP sent successfully");
				}else{
				    $data = array("status"=>false,"message"=>"Something went wrong");
				}
		}else{
			$string = '0123456789';
		    $string_shuffled = str_shuffle($string);
		    $otp = substr($string_shuffled, 1, 4);

			$query = $this->db->insert("shreeja_users",array("user_mobile"=>$num,"user_otp"=>$otp,"user_status"=>1));
			if($query){
				$fields = array(
				    "sender_id" => "FSTSMS",
				    "message" => "[#]".$otp." Use this OTP to register in SHREEJA MILKS. H/dLlrhjDfI",
				    "language" => "english",
				    "route" => "p",
				    "numbers" => $num,
				);
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
		$check = $this->db->where(array('user_mobile'=>$num))->get('shreeja_users');
		if($check->num_rows() > 0){
			$row = $check->row();
			if($otp == $row->user_otp){
			    $query = $this->db->where("user_mobile",$num)->update("shreeja_users",array("users_status"=>0));
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
	
	public function areas($id){
		$check = $this->db->where('city_id',$id)->where("deleted",0)->get('tbl_areas');
		if($check->num_rows() > 0){
			$row = $check->result_array();
			if($row){
				$data = array("status"=>true, "areas"=>$row);
			}else{
				$data = array("status"=>false,"message"=>"Something went wrong , please try again");	
			}
		}else{
			$data = array("status"=>false,"message"=>"areas not found");
		}
		return $data;
	}

	public function get_user($userid){
		$check = $this->db->where('userid',$userid)->get('shreeja_users');
		if($check->num_rows() > 0){
			$row = $check->row_array();
				$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();

				if($sordChk == 1){

					/*$data["freesample_status"] = "You have already received sample order.";*/
					$sample["free_sample"] = "disable";

				}else{
					
					//$data["freesample_status"] = "You have already received sample order.";
					$sample["free_sample"] = "active";
				}

			if($row){
				$data = array("status"=>true,"message"=>"user data", "userdata"=>$row, "sample_order"=>$sample);
			}else{
				$data = array("status"=>false,"message"=>"Something went wrong , please try again");	
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}
	

	public function all_products($lid){
		$query = $this->db->where("deleted",0)->get("tbl_products")->result_array();
			$data = [];
			$i = 0;
			foreach ($query as $row) {
				$row['product_price'] = $this->get_quantity($row['id']);
				$data[$i] = $row;
				$i++;
			}
		return $data;
	}

	public function get_quantity($pid){
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"id"=>$pid))->row();
		$product_quantity = json_decode($products->product_quantity);
		$product_price = $product_quantity->price;
		$data = [];
		$i=0;
		foreach ($product_quantity->quantity as $key => $value) {
			$new['quantity'] = $value;
			$new['price'] = $product_price[$key];
			$data[$i] = $new;
			$i++;
		}
		return $data; 
	}

	public function productDiscountprice($pid){
		
		$pdate = date("m/d/Y");
		
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"id"=>$pid))->row();
		
		$cat = json_decode($products->product_quantity);	
							
		$pm = $this->db->query("select * from tbl_price_management where product_id = '$pid' AND  '$pdate' BETWEEN  startdate AND enddate")->row();
							
		$discPm = json_decode(isset($pm->price_management) ? $pm->price_management : "");
						
		$disType = isset($discPm->discount_type) ? $discPm->discount_type : "";
						
		$disPrice = isset($discPm->price) ? $discPm->price : "";
		
		if($pm){
								
			if(count($disPrice) >= 1){
									
				if($disPrice[0] != ""){
										
					 	if($disType == "percent"){
											
								$pe = $disPrice[0]/100*$cat->price[0];	
											
								$data = $cat->price[0]-$pe;
		
						}else{
											
							$data = $disPrice[0];
						
						}
						
				}else{
						
					$data = $cat->price[0];
								  
				}			
									
			}else{
						
				$data = $cat->price[0];
								  
			}
			
		}else{
								
			$data = $cat->price[0];
		
		}
		
		return($data);
		
	}

	public function free_sample(){
		$query = $this->db->get_where("tbl_sample_products",array("status"=>"Active"))->result_array();
		$products = [];
		$i=0;
		foreach ($query as $row) {
			$row['product_details'] = $this->productbyid($row['id']);
			$products[$i] = $row;
			$i++;
		}
		return array("status"=>true,"products"=>$products);

	}
	public function productbyid($pid){
		$query = $this->db->where(array("status"=>"Active","deleted"=>0,"id"=>$pid))->get("tbl_products")->row_array();
		$data['product_name'] = $query['product_name'];
		$data['description'] = $query['description'];
		$data['product_image'] = $query['product_image'];
		$data['product_banner'] = $query['product_banner_image'];
		return $data;
	}
	
	public function gst_total($pprice,$gst){
	    
	    $total = $pprice - ($pprice * (100/(100+$gst)));
	    
	    return round($total,2);
	    
	}

}