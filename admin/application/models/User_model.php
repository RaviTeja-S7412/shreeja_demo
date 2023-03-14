<?php

defined("BASEPATH") OR exit("No direct script access allow");


class User_model extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}
	
	public function offer_banners(){
	   // $date = date("d/m/Y", strtotime("now"));
//	    $query = $this->db->query("SELECT banner FROM tbl_product_offers WHERE status='Active' and banner != ''");
		
		$banners = [["banner"=>"assets/modalImages/1.jpg"],["banner"=>"assets/modalImages/2.jpg"],["banner"=>"assets/modalImages/3.jpg"],["banner"=>"assets/modalImages/4.jpg"],["banner"=>"assets/modalImages/5.jpg"],["banner"=>"assets/modalImages/6.jpg"],["banner"=>"assets/modalImages/7.jpg"],["banner"=>"assets/modalImages/8.jpg"],["banner"=>"assets/modalImages/9.jpg"],["banner"=>"assets/modalImages/10.jpg"],["banner"=>"assets/modalImages/11.jpg"],["banner"=>"assets/modalImages/12.jpg"]];
		
		$payment_gateway_credentials = $this->admin->get_option("payment_gateway");
		
		return array("status"=>true,"offers"=>$banners,"payment_gateway_credentials"=>json_decode($payment_gateway_credentials));
		
	    /*if($query->num_rows() > 0){
	        return array("status"=>true,"offers"=>$query->result(),"payment_gateway_credentials"=>json_decode($payment_gateway_credentials));
	    }else{
	        return array("status"=>false,"offers"=>[],"payment_gateway_credentials"=>json_decode($payment_gateway_credentials));
	    }*/
	}
	
	
	 public function indent_update(){
        $uid = $this->input->post("userid");
        $products = json_decode($this->input->post("products"),true);
        $ddate = $this->input->post("deliverydate");
        $dtime = $this->input->post("deliverytime");
        $tid = $this->input->post("transactionid");
        $bname = $this->input->post("bankName");
      $tamount = $this->input->post("transactionamount");
      $tdate = $this->input->post("transactiondate");
      $timage = $this->input->post("files");
      $oid =  $this->input->post("orderid");
		 
	  $udata = $this->db->get_where("fdm_va_auths",["id"=>$uid])->row();	 
      
      $check = $this->db->where(array("agent_id"=>$uid,"order_id"=>$oid))->get("agent_orders");
      if($check->num_rows() ==0){
          return array("status"=>false,"message"=>"indent not found");
      }
      $indent = $check->row();
         if($_FILES["files"]["name"][0] != "")
              {	
            	$config["upload_path"] = 'uploads/agentPayments/';
                $config["allowed_types"] = '*';
            //	$config["encrypt_name"] = TRUE;   
               	$this->load->library('upload', $config);
            	$this->upload->initialize($config);
               
               $ppaySlip = [];
               
            	for($count = 0; $count<count($_FILES["files"]["name"]); $count++){
            	
            		$_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
            		$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
            		$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
            		$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
            		$_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
            		if($this->upload->do_upload('file')){
            
            			$data1 = $this->upload->data();
            			$ppaySlip[] = "uploads/agentPayments/".$data1["file_name"];
            
            		}
        		}
				  
			$expaySlip = explode(",",$indent->transaction_document); 
			$paySlip = array_merge($expaySlip,$ppaySlip); 
			
          }else{
              
              $expaySlip = explode(",",$indent->transaction_document); 
              $paySlip = $expaySlip;  
              
          }
          
          $tdoc = implode(",",$paySlip);
		 
		  $data2 = [];
		  foreach($products as $pr){
			  
			  $pdata = $this->db->get_where("tbl_products",["id"=>$pr["productId"]])->row();
			  $data2[] = array ('productId' => $pr["productId"], 'category' => $pr["category"], 'productQty' =>$pr["productQty"], 'qtyType' => $pr["qtyType"],"pid"=>$pdata->product_id,"product_data"=>json_encode($pdata));
			  
		  }
		 
          $data = array(

					//"order_id" => $oid,	
					"product_id" => json_encode($data2),
					"delivery_date" => $ddate,
					//"agent_id" => $uid,
					"order_delivery_time" => $dtime,
					"amount" => $tamount,
					"transaction_number" => $tid,
					"bank_name" => $bname,
					"transaction_document" => $tdoc,
					"transaction_date" => $tdate,
			  		"city" => $udata->city,
					//"created_by" => 2

				);
	
			$u = $this->db->where(array("order_id"=>$oid))->update("agent_orders",$data);

			if($u){
			    
			    $this->updatehistory_model->agentorderupdateHistory($indent,$oid,$uid,$uid);
			    
			    return array("status"=>true, "message"=>"Indent updated successfully");

			}else{
			      return array("status"=>false, "message"=>"Somenthing went, please try again");		
			}
	
      
    }
    
    
	public function cancle_indent(){
	     $uid = $this->input->post("userid");
	     $oid = $this->input->post("orderid");
	    
	    $check = $this->db->where(array("order_id"=>$oid,"deleted"=>0))->get("agent_orders");
	     
	     if($check->num_rows() > 0){
	         
	         $this->updatehistory_model->deletedHistory($oid,$uid);
	         
	            $this->db->where(array("order_id"=>$oid))->update("agent_orders",array("deleted"=>1,"order_status"=>"Cancelled"));
	            //return $check->num_rows();
	            return array("status"=>true,"message"=>'Order canceled successfully');
	     }else{
	         return array("status"=>false,"message"=>'Could not cancel order at this moment');
	     }
	     
	}
    public function indentbyorderid($products){
        $pdata = [];
         $i = 0;
        foreach(json_decode($products) as $row2){
                  $pdetails = $this->db->where(array("id"=>$row2->productId,"assigned_to"=>'agents'))->get("tbl_products")->row_array();
                  $new['id'] = $row2->productId;
                  $new['product_name'] = $pdetails['product_name'];
                  $new['product_image'] = $pdetails['product_image'];
                   $new['category'] = $row2->category;
                   $new['productQty'] = $row2->productQty;
                   $new['qty_type'] = $row2->qtyType;
                $pdata[$i] = $new;
                $i++;    
              }
              return $pdata;
              
    }
    public function my_indents(){
         $uid = $this->input->post("userid");
         $bulk = $this->db->where(array("agent_id"=>$uid))->order_by("id","DESC")->get("agent_orders")->result_array();
         
         $final = [];
         $j=0;
         if(count($bulk)>0){
         foreach($bulk as $row){
              $products = $row['product_id'];
                $pdata = $this->indentbyorderid($products);
              if($row['deleted']==1){
                  $row['order_state'] = "Cancelled";
              }else{
                  $row['order_state'] = "Active";
              }
              $row['products'] = $pdata;
              $final[$j]=$row;
             $j++; 
         }
         return array("status"=>true, "orders"=>$final);
         }else{
    	    return array("status"=>false, 'message'=>'No order data');
    	}
         
    }
    
     public function indent_view(){
         $uid = $this->input->post("userid");
         $oid = $this->input->post("orderid");
         $bulk = $this->db->where(array("agent_id"=>$uid,"order_id"=>$oid))->get("agent_orders")->row_array();
         $pdata = [];
         $i = 0;
         $final = [];
         $j=0;
     
      $shift = ['morning','evening'];
              $products = $bulk['product_id'];
    
               
              foreach(json_decode($products) as $row2){
                  $pdetails = $this->db->where(array("id"=>$row2->productId,"assigned_to"=>'agents'))->get("tbl_products")->row_array();
                  $new['id'] = $row2->productId;
                  $new['product_name'] = $pdetails['product_name'];
                   $new['product_image'] = $pdetails['product_image'];
                    //$new['qty_type'] = $pdetails['qty_type'];
                   $new['category'] = $row2->category;
                   $new['productQty'] = $row2->productQty;
                   $new['qtyType'] = json_decode($pdetails['qty_type'],true);
                   $new['qty_type'] = $row2->qtyType;
                $pdata[$i] = $new;
                $i++;    
              }
              $bulk['products'] = $pdata;
         
         return array("status"=>true, "orders"=>$bulk,"batch"=>$shift);
        
         //$final['products'] = $pdata;
         
    }
    
    public function indent_order(){
        
        $uid = $this->input->post("userid");
        $products = $this->input->post("products");
        $ddate = $this->input->post("deliverydate");
        $dtime = $this->input->post("deliverytime");
        $tid = $this->input->post("transactionid");
      $tamount = $this->input->post("transactionamount");
      $bname = $this->input->post("bankName");
      $tdate = $this->input->post("transactiondate");
      $timage = $this->input->post("files");
      $oid = $this->admin->generateagentOrderId();
      //return $this->input->post();
         if($_FILES["files"]["name"] != ''){	
            	$config["upload_path"] = 'uploads/agentPayments/';
                $config["allowed_types"] = '*';
            //	$config["encrypt_name"] = TRUE;   
               	$this->load->library('upload', $config);
            	$this->upload->initialize($config);
               
            	for($count = 0; $count<count($_FILES["files"]["name"]); $count++){
            	
            		$_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
            		$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
            		$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
            		$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
            		$_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
            		if($this->upload->do_upload('files')){
            
            			$data1 = $this->upload->data();
            			$paySlip = "uploads/agentPayments/".$data1["file_name"];
            
            		}else{
            			$paySlip = "";
            			//echo $this->upload->display_errors();
            			
            		}
        	    }
        	  
          }else{
              $paySlip = ""; 
          }
		
		  $tdocument = implode(",",$paySlip);
		
		  $udata = $this->db->get_where("fdm_va_auths",["id"=>$uid])->row();
		  
          $data = array(

					"order_id" => $oid,	
					"product_id" => $products,
					"delivery_date" => ($ddate)?$ddate : "",
					"agent_id" => $uid,
			  		"city" => $udata->city,
					"order_delivery_time" => ($dtime)?$dtime :"",
					"amount" => ($tamount)?$tamount:"",
					"transaction_number" => $tid,
					"bank_name" => ($bname)?$bname:"",
					"transaction_document" => $tdocument,
					"transaction_date" => ($tdate)?$tdate:"",
					"created_by" => 2


				);
	
			$u = $this->db->insert("agent_orders",$data);

			if($u){
			    return array("status"=>true, "message"=>"Indent created successfully");

			}else{
			      return array("status"=>false, "message"=>"Indent not created, please try again");		
			}
	
      
    }
	
    public function resend_otp($num){
         $string = '0123456789';
		    $string_shuffled = str_shuffle($string);
		    $otp = substr($string_shuffled, 1, 4);
		    $query = $this->db->where("user_mobile",$num)->update("shreeja_users",array("user_otp"=>$otp));
        	$fields = array(
				    "sender_id" => "FSTSMS",
				    "message" => "[#]".$otp." Use this OTP to register in SHREEJA MILK. gbFAGla+HKI",
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
    
    public function forgot_otp($num){
         $string = '0123456789';
		    $string_shuffled = str_shuffle($string);
		    $otp = substr($string_shuffled, 1, 4);
		    $chkUser = $this->db->get_where("shreeja_users",array("user_mobile"=>$num))->num_rows();
		    
		    if($chkUser == 1){
		    
    		    $query = $this->db->where("user_mobile",$num)->update("shreeja_users",array("user_otp"=>$otp));
    		    
            	$fields = array(
    				    "sender_id" => "FSTSMS",
    				    "message" => "[#]".$otp." Use this OTP to reset password in SHREEJA MILKS. gbFAGla+HKI",
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
    				
		    }else{
		        
		        $data = array("status"=>false,"message"=>"mobile number not registered with us.");
		        
		    }
			
			return $data;
    }
    
	public function insert_number($num){
		$check = $this->db->where(array('user_mobile'=>$num,"user_status"=>0))->get('shreeja_users');
		if($check->num_rows() > 0){
		        $row = $check->row();
		    
				$query = $this->db->where("user_mobile",$num)->update("shreeja_users",array("user_otp"=>$otp));
				if($query){
			    	//$this->send_sms($num,$fields['message']);
		        	$data = array("status"=>true,"message"=>"user already registered","isRegistered"=>true,"steps_completed"=>$row->steps_completed);
				}else{
				    $data = array("status"=>false,"message"=>"Something went wrong");
				}
		}else{
		    
			$string = '0123456789';
		    $string_shuffled = str_shuffle($string);
		    $otp = substr($string_shuffled, 1, 4);
            
            $check2 = $this->db->where(array('user_mobile'=>$num,"user_status"=>1))->get('shreeja_users');
            if($check2->num_rows() > 0){
                $query = $this->db->where(array("user_mobile"=>$num))->update("shreeja_users",array("user_otp"=>$otp));
                
            }else{
                $query = $this->db->insert("shreeja_users",array("user_mobile"=>$num,"user_otp"=>$otp,"user_status"=>1,"steps_completed"=>1));   
            }
			
			if($query){
				$fields = array(
				    "sender_id" => "FSTSMS",
				    "message" => "[#]".$otp." Use this OTP to register in SHREEJA MILK. gbFAGla+HKI",
				    "language" => "english",
				    "route" => "p",
				    "numbers" => $num,
				);
				$this->send_sms($num,$fields['message']);
                

				$uid = $this->db->where('user_mobile',$num)->get('shreeja_users')->row()->userid;
				$data = array("status"=>true,"message"=>"mobile number added, check otp", "isRegistered"=>false,"steps_completed"=>1);
			}else{
				$data = array("status"=>false,"message"=>"something went wrong please try again");
			}
		}
		return $data;

	}
	
	public function send_sms($mobile,$message){

		
		$mob = urlencode($mobile);
		$mes = urlencode($message." *SHREEJA MILK*");	
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
			$uid = $row->userid;
				$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();
               // $sample="";
				if($sordChk == 1){

					/*$data["freesample_status"] = "You have already received sample order.";*/
					$sample["free_sample"] = "disable";

				}else{
					
					//$data["freesample_status"] = "You have already received sample order.";
					$sample["free_sample"] = "active";
				}
				
			if($otp == $row->user_otp){
			    $query = $this->db->where("user_mobile",$num)->update("shreeja_users",array("user_status"=>0,"steps_completed"=>2));
			    $row1 = $check->row();
				$data = array("status"=>true,"message"=>"successfully verified","userid"=>$row->userid, "sample_order"=>$sample,"steps_completed"=>2);
				
			}else{
				$data = array("status"=>false,"message"=>"incorrect otp");
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}
	
	
	public function check_forgototp($num,$otp){
		$check = $this->db->where(array('user_mobile'=>$num))->get('shreeja_users');
		if($check->num_rows() > 0){
			$row = $check->row();
			$uid = $row->userid;
				$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();
               // $sample="";
				if($sordChk == 1){

					/*$data["freesample_status"] = "You have already received sample order.";*/
					$sample["free_sample"] = "disable";

				}else{
					
					//$data["freesample_status"] = "You have already received sample order.";
					$sample["free_sample"] = "active";
				}
				
			if($otp == $row->user_otp){
			    $row1 = $check->row();
				$data = array("status"=>true,"message"=>"successfully verified","userid"=>$row->userid, "sample_order"=>$sample,"steps_completed"=>$row1->steps_completed);
				
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
			    $row = $check->row();
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
		$pass = $this->input->post('password');
		
		$fbKey = $this->input->post("firebaseToken");
						
	    if($pass !=""){
	        
	        $password = $this->secure->encrypt($pass);   
	    }else{
	       
	        $password = $this->db->where("userid",$userid)->get("shreeja_users")->row()->password;
	         //return array($password);
	    }
		
		
		$ref_id = $this->input->post("referral_id");
		if($ref_id){

			$r = $this->admin->getReferrers($ref_id,$userid);	
			if(!$r["status"]){
				
				return $r;
				
			}
			
		}
		
	    
	    if($this->input->post('area')==""){
	           $this->db->where(array("userid"=>$userid))->update("shreeja_users",array("area_delivery_status"=>'Inactive'));
	    }
		$content =array(
			"user_name"=>$this->input->post('name'),
			"alt_number"=>$this->input->post('alt_number'),
			"user_email"=>$this->input->post('email'),
			"user_location"=>$this->input->post('city'),
			"user_city"=>$this->input->post('city'),
			"user_area"=>$this->input->post('area'),
			"areanotlisted"=>$this->input->post('areanotlisted'),
			"user_locality"=>$this->input->post('locality'),
			"house_no"=>$this->input->post('house_no'),
			"landmark"=>$this->input->post('landmark'),
			"user_current_address"=>$this->input->post('address'),
			"user_gps"=>$this->input->post('gps_loc'),
			"password"=>$password,
			"firebase_token"=>$fbKey,
			"referral_id" => $this->admin->generateReferralid(),
			"user_status"=>0,
			"steps_completed" => 4
		);
		$check = $this->db->where('userid',$userid)->get('shreeja_users');
		if($check->num_rows() > 0){
			$query = $this->db->where('userid',$userid)->update("shreeja_users",$content);
			if($query){
			    $row1 = $check->row();
				
				$data = array("status"=>true,"message"=>"personal data updated successfully","steps_completed" => 4);
			}else{
				$data = array("status"=>false,"message"=>"Something went wrong , please try again");	
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}
    
    public function password_update($data){
		$userid = $this->input->post('userid');
		$content =array(
			"password"=>$this->secure->encrypt($this->input->post('password'))
		);
		$check = $this->db->where('userid',$userid)->get('shreeja_users');
		if($check->num_rows() > 0){
			$query = $this->db->where('userid',$userid)->update("shreeja_users",$content);
			if($query){
				$data = array("status"=>true,"message"=>"Password updated successfully");
			}else{
				$data = array("status"=>false,"message"=>"Something went wrong , please try again");	
			}
		}else{
			$data = array("status"=>false,"message"=>"user not found");
		}
		return $data;
	}

	public function shreeja_locations(){
		$query = $this->locations_model->getConsumercities();
		$i = 0;
		$data = array();
		foreach ($query as $row) {
		   // $row['image'] = "admin/"==.$row['image'];
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
		$check = $this->db->where('city_id',$id)->where("deleted",0)->order_by('area_name','ASC')->get('tbl_areas');
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
			$row['user_city'] = $this->db->where(array("id"=>$row['user_city']))->get("tbl_locations")->row()->location;
			
				$row['user_area'] = $this->db->where(array("id"=>$row['user_area']))->get("tbl_areas")->row()->area_name;
			if($row['user_area']==""){
			    $row['user_area'] = $row['areanotlisted'];
			}
				$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();

				if($sordChk == 1){
				    
					$sample["free_sample"] = "disable";

				}else{
				     $check = $this->db->get_where("orders",array("user_id"=>$userid,"order_status"=>"Success"))->num_rows();
				    if($check > 0){
				        	$sample["free_sample"] = "disable"; 
				    }else{
				        	$sample["free_sample"] = "active";   
				    }
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
	

	public function all_products($lid,$uid){
	    	$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();
	    
				if($sordChk == 1){
					$free_sample = "disable";

				}else{
				    $check = $this->db->get_where("orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();
				    if($check > 0){
                        	$free_sample= "disable"; 
				    }else{
                            $free_sample = "active";   
				    }
				
				}
	
		$udata = $this->db->get_where("shreeja_users",["userid"=>$uid])->row();
		$query = $this->db->where(array("status"=>"active","deleted"=>0))->get("tbl_categories")->result_array();
		$data = [];
	
			$i = 0;
			foreach ($query as $row) {
			   $new["categoryName"] = $row['category_name'];
			   $new['products'] = $this->productsby_cat($row['id'],$udata->user_location);
				$data[$i] = $new;
				$i++;
			}
			/*$categories = $this->db->where("deleted",0)->get("tbl_categories")->result_array();
			$categ = [];
			$j = 0;
			foreach($categories as $cat){
			    $categ[$j] =$cat['category_name'];
			    $j++;
			}*/
		
			$mu = $this->admin->get_option("is_mandatory_update");
		
			if($mu == 1){
				
				$manu = true;
				
			}else{
				
				$manu = false;
				
			}
		$dm = $this->admin->get_option("is_development_mode");
		
			if($dm == 1){
				
				$devmode = true;
				
			}else{
				
				$devmode = false;
				
			}
		
		return array("status"=>true,"categorisedList"=>$data,"freesample"=>$free_sample,"is_mandatoryupdate"=>$manu,"is_devmode"=>$devmode,"welcome_offer"=>json_decode($this->admin->get_option("welcome_note")),"app_version"=>$this->admin->get_option("app_version"));
	}
    public function agent_products($location,$aid){

		$query = $this->db->where(array("status"=>"active","deleted"=>0))->get("tbl_categories")->result_array();
		
		$adata = $this->db->get_where("fdm_va_auths",["id"=>$aid])->row();
		
		$data = [];
	$shift = ['morning','evening'];
			$i = 0;
			foreach ($query as $row) {
			    
			   $new["categoryName"] = $row['category_name'];
			   
			   $new['products'] = $this->agentproductsby_cat($row['id'],$adata->city);
			   
				$data[$i] = $new;
				$i++;
			}
			/*$categories = $this->db->where("deleted",0)->get("tbl_categories")->result_array();
			$categ = [];
			$j = 0;
			foreach($categories as $cat){
			    $categ[$j] =$cat['category_name'];
			    $j++;
			}*/
		return array("status"=>true,"categorisedList"=>$data,"batch"=>$shift);
	}
	
	public function agentproductsby_cat($id,$loc){
	    $products = $this->db->order_by("product_name","asc")->where(array("deleted"=>0,"assigned_to"=>"agents","status"=>"Active","product_category"=>$id))->get("tbl_products")->result_array();
         $i = 0;
         $data = [];
         foreach($products as $row1){
			 
			 if(in_array($loc,json_decode($row1["location"]))){
			  // $pdata['products'] = $row1;
				$row1['product_price'] = $this->get_agentquantity($row1['id']);
				 $row1["qtyType"] = ($row1['qty_type'])?json_decode($row1['qty_type'],true):[];
				//$row["qty_type"] = json_decode($row['qty_type'],true);
				$data[$i] = $row1;
				$i++;
			 }
		 }
			   return $data;
	}
	
	public function get_agentquantity($pid){
	    //error_reporting(0);
	    $pdate = date("m/d/Y");
	    //return $pdate;
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"assigned_to"=>"consumers","id"=>$pid))->row();
		$pm = $this->db->query("select * from tbl_price_management where product_id = '$pid' AND  '$pdate' BETWEEN  startdate AND enddate")->row();
		
		$discPm = json_decode(isset($pm->price_management) ? $pm->price_management : "");
			//return $discPm;			
		$disType = isset($discPm->discount_type) ? $discPm->discount_type : "";
						
		$disPrice = isset($discPm->price) ? $discPm->price : "";
		$disquantity = isset($discPm->quantity) ? $discPm->quantity : "";
		
		
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"id"=>$pid))->row();
		
		$product_quantity = json_decode($products->product_quantity);
		$product_price = $product_quantity->price;
	    //return count($disquantity);
		$data = [];
		$i=0;
		
		//return ($product_price);
		if($discPm ==""){	
	            foreach ($product_quantity->quantity as $key => $value) {
    		    
						$new['quantity'] = $value;
						$new['originalprice'] = $product_price[$key];
						$new['discountprice'] = 0;
						$new['finalprice'] = $product_price[$key];
						$new['discountType'] =0;
						$data[$i] = $new;
						$i++;
					
    	    	}  
    	    	return $data;
		}else{
		   	
	    		foreach ($disquantity as $key => $value) {
					
						
						//$new['key'] = $value;
						$dprice = $disPrice[$key];
						if($dprice !=""){
							$new['quantity'] = $value;
							$new['originalprice'] = $product_price[$key];
							$new['discountprice'] = $product_price[$key]-$disPrice[$key];
							$new['finalprice'] = $disPrice[$key];//$orprice;
							$new['discountType'] = $disType;
						}else{
							$new['quantity'] = $value;
							$new['originalprice'] = $product_price[$key];
							$new['discountprice'] = 0;
							$new['finalprice'] = $product_price[$key];
							$new['discountType'] =0;
						}

						$data[$i] = $new;
						$i++;
					
        		}
        		return $data; 
		}	//return $data;
	}	
	
	public function productsby_cat($id,$loc){
	    $products = $this->db->where(array("deleted"=>0,"assigned_to"=>"consumers","status"=>"Active","product_category"=>$id))->get("tbl_products")->result_array();
         $i = 0;
         $data = [];
         foreach($products as $row1){
			 
			 if(in_array($loc,json_decode($row1["location"]))){
			      // $pdata['products'] = $row1;
				
				$offers = $this->get_product_offers($row1['id'],$loc); 
				 
				$row1['product_price'] = $this->get_quantity($row1['id']);
				$row1['offers'] = $offers;
				$row1['offer_status'] = (count($offers) > 0) ? true : false;
				$data[$i] = $row1;
				$i++;
				 
			 }
		 }
			   return $data;
	}
	
	public function get_product_offers($pid,$loc){
		
		$offers = $this->db->get_where("tbl_product_offers",["city"=>$loc,"offerType !="=>"Amount","inputProduct"=>$pid,"status"=>"Active"])->result_array();
		$date = date("m/d/Y", strtotime("now"));
		
		$off = [];
		$outputProduct = [];
		
		foreach($offers as $o){
			
			if ((strtotime($date) >= strtotime($o["from_date"])) && (strtotime($date) <= strtotime($o["to_date"]))){
				
				$opr = $this->db->get_where("tbl_products",["id"=>$o["outputProduct"]])->row_array();
				
				if($opr){
				    $outputProduct[] =  $opr;
                }
				$off[] = ["orderType"=>$o["orderType"],"offerType"=>$o["offerType"],"description"=>$o["description"],"banner"=>$o["banner"],"status"=>$o["status"],"outputProduct"=>$outputProduct,"outputQty"=>$o["outputQty"]];
				
				
			}
			
		}
		
		return $off;
		
	}

	public function get_quantity($pid){
	    //error_reporting(0);
	    $pdate = date("m/d/Y");
	    //return $pdate;
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"assigned_to"=>"consumers","id"=>$pid))->row();
		$pm = $this->db->query("select * from tbl_price_management where product_id = '$pid' AND  '$pdate' BETWEEN  startdate AND enddate")->row();
		
		$discPm = json_decode(isset($pm->price_management) ? $pm->price_management : "");
			//return $discPm;			
		$disType = isset($discPm->discount_type) ? $discPm->discount_type : "";
						
		$disPrice = isset($discPm->price) ? $discPm->price : "";
		$disquantity = isset($discPm->quantity) ? $discPm->quantity : "";
		
		
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"id"=>$pid))->row();
		
		$product_quantity = json_decode($products->product_quantity);
		$product_price = $product_quantity->price;
	    //return count($disquantity);
		$data = [];
		$i=0;
		
		//return ($product_price);
		if($discPm ==""){	
	            foreach ($product_quantity->quantity as $key => $value) {
    		    
                	if($product_quantity->status[$key] == "Active"){
					
						$new['quantity'] = $value;
						$new['originalprice'] = $product_price[$key];
						$new['discountprice'] = 0;
						$new['finalprice'] = $product_price[$key];
						$new['discountType'] =0;
						$data[$i] = $new;
						$i++;
					
					}
					
    	    	}  
    	    	return $data;
		}else{
		   	
	    		foreach ($disquantity as $key => $value) {
					
					if($product_quantity->status[$key] == "Active"){
						
						//$new['key'] = $value;
						$dprice = $disPrice[$key];
						if($dprice !=""){
							$new['quantity'] = $value;
							$new['originalprice'] = $product_price[$key];
							$new['discountprice'] = $product_price[$key]-$disPrice[$key];
							$new['finalprice'] = $disPrice[$key];//$orprice;
							$new['discountType'] = $disType;
						}else{
							$new['quantity'] = $value;
							$new['originalprice'] = $product_price[$key];
							$new['discountprice'] = 0;
							$new['finalprice'] = $product_price[$key];
							$new['discountType'] =0;
						}

						$data[$i] = $new;
						$i++;
						
					}
        		}
        		return $data; 
		}	//return $data;
	}
	
	public function get_discount($pid){
	    $pdate = date("m/d/Y");
	    
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"id"=>$pid))->row();
			$pm = $this->db->query("select * from tbl_price_management where product_id = '$pid' AND  '$pdate' BETWEEN  startdate AND enddate")->row();
		
		$discPm = json_decode(isset($pm->price_management) ? $pm->price_management : "");
						
		$disType = isset($discPm->discount_type) ? $discPm->discount_type : "";
						
		$disPrice = isset($discPm->price) ? $discPm->price : "";
		$disquantity = isset($discPm->quantity) ? $discPm->quantity : "";

		$data = [];
		$i=0;
		foreach ($disquantity as $key => $value) {
		    
		    $new['quantity'] = $value;
			$new['price'] = $disPrice[$key];
			$new['discountType'] = $disType;
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

	public function free_sample($userid){
	    
	    $udata = $this->db->get_where("shreeja_users",["userid"=>$userid])->row();
	    
		$query = $this->db->get("tbl_sample_products")->result_array();
		$products = [];
		$i=0;
		foreach ($query as $row) {
		    
		    $pdata = $this->productbyid($row['product_id']);
		    if(in_array($udata->user_location,$pdata["location"])){
		    
    			$row['product_details'] = $pdata;
    			$products[$i] = $row;
    			$i++;
    			
		    }
		}
		return array("status"=>true,"products"=>$products);

	}
	public function productbyid($pid){
		$query = $this->db->where(array("deleted"=>0,"id"=>$pid))->get("tbl_products")->row_array();
		$data['product_name'] = $query['product_name'];
		$data['description'] = $query['description'];
		$data['product_image'] = $query['product_image'];
		$data['product_banner'] = $query['product_banner_image'];
		$data['location'] = ($query["location"]) ? json_decode($query["location"]) : [];
		return $data;
	}
	public function product_view($pid){
	       $query = $this->db->where(array("status"=>"Active","deleted"=>0,"id"=>$pid))->get("tbl_products")->row_array();
	       $data= $query;
	       $data['product_quantity'] = $this->get_quantity($pid);
	       return array("status"=>true,"product"=>$data);
	       
	}
	
	public function sample_product_view($id){
	       $query = $this->db->where(array("id"=>$id,"status"=>"Active"))->get('tbl_sample_products')->row_array();
	       $query['product_details'] = $this->productbyid($query['product_id']);
	        return array("status"=>true,"product"=>$query);
	       
	}
	
		
		/*
	*Generate Order ID
	*
	*/
	public function generateOrderId(){
			$i='1';
		
		do{
			
			$id="ORD".random_string("numeric",7);
			
			$chk=$this->db->get_where("orders",array('order_id'=>$id))->num_rows();
			
			if($chk>0){
				$i='1';
				
			}else{
				$i='10';
			}
			
			
		}while($i<5);
		
		return $id;
	}
 
	public function insertSampleOrder($uid,$ddate,$address,$id,$shift){
		
	   if($shift =='evening'){
			return array("status"=>false,"message"=>"Due to Covid19 we are not accepting evening orders");

		}	
		
		
	   $oid = $this->admin->generatefsOrderId();
	     $ck = $this->db->where("userid",$uid)->get("shreeja_users")->row_array();
	    if($ck['area_delivery_status']=="Inactive"){
	        return array("status"=>false, "message"=>"We are unable to serve this location now. Will contact you soon to serve the order");
	    }
	 
	 
	 $ordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();
	 
	 $sp = $this->db->get_where("tbl_sample_products",array("id"=>$id))->row();
	 $udata = $this->db->where("userid",$uid)->get("shreeja_users")->row();
	 $num = $udata->user_mobile;
	 
	 $result = $this->db->query('SELECT MAX(id) as Invoice from tbl_free_sample_orders')->row(); 
		
		if(isset($result->Invoice)){
			
			$invoice = "INFS1990000".$result->Invoice;
			
		}else{
			
			$invoice = "INFS19900000";
			
		}
		
	  $userdata = ["user_name"=>$udata->user_name,"user_email"=>$udata->user_email,"user_mobile"=>$udata->user_mobile,"user_current_address"=>$udata->user_current_address];	
		
      $pdata = $this->db->get_where("tbl_products",array("id"=>$sp->product_id))->row();	
		
		
	  $data = array(
	 	"shipping_address" => $address,
		"delivery_date" => $ddate,
		"order_status" => "Success",
		"deliveryShift" => $shift,
		"order_id" => $oid,
		"product_id" => $sp->product_id,
		"product_data"=>json_encode($pdata),  
		"qty" => $sp->qty,
		"user_id" => $uid,
		"user_data" => json_encode($userdata),  
		"invoice_number" => $invoice,
		"location" => $udata->user_location  
		  
	  );
	  
	  
	  
	 	if($ordChk == 1){
		
    		$msg = "Free sample used";
    		return array("status"=>false,"message"=>$msg);
		
    	}else{
    		
    		 $current_date =date("d-m-Y");
            $current_hour = date("H");
            $start_date =  $ddate;
             if($shift == 'morning'){
            	if(strtotime($start_date) == strtotime($current_date)){
            		
            		return array("status"=>false,"message"=>"Try ordering for next shift/day");
            	}elseif(strtotime($start_date) == strtotime('+1 day',strtotime($current_date))){
    
            		if($current_hour >= 17){
            			return array("status"=>false,"message"=>"Try ordering for next shift/day");
            		}
            	}
             }elseif($shift =='evening'){
             	if(strtotime($start_date) == strtotime($current_date)){
            		if($current_hour >= 12){
            			 return array("status"=>false,"message"=>"Try ordering for next shift/day");
            		}
            	}
             }
         
    		$op = $this->db->insert("tbl_free_sample_orders",$data);
    		
    // 		$this->db->set($data)
    // 		        ->where("user_id",$uid)
    // 	        ->update("tbl_free_sample_orders");
    
    
    		if($op){
    		    
        		$msg = "Order placed successfully";
        		
        			$fields = array(
    				    "sender_id" => "FSTSMS",
    				    "message" => "your free sample will be delivered shortly",
    				    "language" => "english",
    				    "route" => "p",
    				    "numbers" => $num,
    				);
    				$this->send_sms($num,$fields['message']);
    				
    				$token = $this->db->get_where("shreeja_users",array("userid"=>$uid))->row()->firebase_token;
    
    				$udata = array(
    
    					"user_id" => $uid,
    					"message" => "Your order is confirmed.",
    					"title" => "Order Success",
    			//		"image" => base_url().$u->image,
    
    				);
    
    				$this->db->insert("tbl_user_notifications",$udata);
    
    				$nmessage = array(
    			
    					"title" =>"Order Success",
    					"message" => "Your order is confirmed.",
    					"imageUrl" => "assets/nimages/order_success.jpg",
    					"redirect_to" => "order_placed",
    
    				);
    
    				$this->admin->firebase_notification_subscribe($token,$nmessage);
    				
				    return array("status"=>true,"message"=>$msg);
    	
    		}else{
    		    
				    return array("status"=>false,"message"=>"Error Occured");
    		    
    		}
    		    
    	}  
    	
	
	
 }	
 
  public function add_cart($object,$uid){
     
	    $ck = $this->db->where("userid",$uid)->get("shreeja_users")->row_array();
	    if($ck['area_delivery_status']=="Inactive"){
	        return array("status"=>false, "message"=>"We are unable to serve this location now. Will contact you soon to serve the order");
	    }
	    $this->db->where("userid",$uid)->delete("tbl_cart");
	     $mg = [];
	     $i=0;
	     foreach(json_decode($object) as $row){
	         $dd['pid'] = $row->productId;
	          $dd['cat'] = $row->productCategory;
	           $dd['qty'] = $row->productQty;
	           $dd['price'] = $row->productPrice;
	           
	        $check = $this->db->where(array("userid"=>$uid, "product_id"=>$dd['pid'],"product_cat"=>$dd['cat']))->get("tbl_cart")->num_rows();
            
            $data = array("userid"=>$uid, "product_id"=>$dd['pid'],"product_cat"=>$dd['cat'],"qty"=>$dd['qty'],"price"=>$dd['price']);  
	        if($check == 0){

	            $this->db->insert("tbl_cart",$data);
	        }else{
	           $this->db->set(array("qty"=>$dd['qty'],"price"=>$dd['price']))->where(array("userid"=>$uid, "product_id"=>$dd['pid'],"product_cat"=>$dd['cat']))->update('tbl_cart'); 
	        }
	        
	         $mg[$i] = $dd;
	         $i++;
	     }
	    // return array("status"=>true,"message"=>json_decode($object)); exit;
    return array("status"=>true,"message"=>"cart updated successfully");

	 }
	 
	 public function update_cart($data){
	     $uid = $this->input->post('userid');
	     $cid = $this->input->post('cartid');
	    $qty = $this->input->post('qty');
	     //$qty = $this->input->post('cat');
	    $message = "";
	    $check  = $this->db->where(array("userid"=>$uid,"id"=>$cid))->get("tbl_cart");
	    if($check->num_rows() > 0){
	            if($qty>0){
	                $this->db->set(array("qty"=>$qty))->where(array("userid"=>$uid,"id"=>$cid))->update("tbl_cart");
	                $message = "Cart updated successfully";
	            }else{
	               $this->db->where(array("userid"=>$uid,"id"=>$cid))->delete('tbl_cart');
	                $message = "item deleted";
	            }
	    }
	    return array("status"=>true,"message"=>$message);
	}
	 
	public function get_cart($uid){
	    
	    $check  = $this->db->where("userid",$uid)->get("tbl_cart")->result_array();
	    $data = [];
	    	/*$gstPrice = array();
			$nGst = array();	*/
	    $i = 0;
	    foreach($check as $row){
	        $pinfo = $this->db->get_where("tbl_products",array("id"=>$row["product_id"],"assigned_to"=>'consumers'))->row();
								
								if($pinfo->gst_charges_status == "Active"){
								
									$gstPrice = $row["price"] * $row["qty"];
									$gstCharge = $pinfo->gst_charges;
									
								//	$nGst[] = $gstPrice * ($gstCharge)/100;
									
									$row["gst"] = $gstPrice * ($gstCharge)/100;
									$row["deliveryFee"] = 0;
								}else{
								    	$row["gst"] = 0;
								    	$row["deliveryFee"] = 0;
								}
			
	           $pid = $row['product_id'];
	           $row['product_details'] =$this->productbyid($pid);
	           $data[$i] = $row;
	           $i++;
	    }
	    
	    return array("status"=>true,"cart"=>$data);
	}
	public function get_dfee($uid,$tamount){
	    $udata = $this->db->where("userid",$uid)->get("shreeja_users")->row_array();
	    $location = $udata['user_location'];
	    $ldata = $this->db->where("id",$location)->get("tbl_locations")->row_array();
	    $dfee = $ldata['deliveryCharges'];
	    $cutoff = $ldata['cutoffCharges'];
	    if($tamount >= $cutoff){
	        $fee = 0;
	    }else{
	        $fee = $dfee;
	    }
	    return $fee;
	}
	public function get_gst($data){
	    $uid = $this->input->post('userid');
	    $dtype = $this->input->post('delivery_type');
	    $check  = $this->db->where("userid",$uid)->get("tbl_cart")->result_array();
	    
	    $data = [];
	    	$gst = [];
			//$nGst = array();
			$delivery = [];
			$total = [];
			$gtotal = [];
	    $i = 0;
	    foreach($check as $row){
	        $pinfo = $this->db->get_where("tbl_products",array("id"=>$row["product_id"],"assigned_to"=>'consumers'))->row();
						$total[$i] = $row["price"] * $row["qty"];		
								if($pinfo->gst_charges_status == "Active"){
								
									$gstPrice = $row["price"] * $row["qty"];
									$gstCharge = $pinfo->gst_charges;
									
								// 	$new["gst"] = $gstPrice * ($gstCharge)/100;
									$new["gst"] = $this->admin->gst_total($gstPrice,$gstCharge);
									$new["deliveryFee"] = 0;
									$new["gtotal"] = ($row["price"] * $row["qty"]) - $new["gst"];
									
								}else{
								    	$new["gst"] = 0;
								    	$new["deliveryFee"] = 0;
								    	$new["gtotal"] = ($row["price"] * $row["qty"]);
								}
			
	           $pid = $row['product_id'];
	           $row['product_details'] =$this->productbyid($pid);
	           $gst[$i] = $new['gst'];
	           $gtotal[$i] = $new['gtotal'];
	           $delivery[$i] = $new['deliveryFee'];
	          // $data[$i] = $new;
	           $i++;
	    }
	    $dfee = $this->get_dfee($uid,array_sum($total));
	    $finalgst = number_format((float)array_sum($gst), 2, '.', '');
	    $finalgtotal = number_format((float)array_sum($gtotal), 2, '.', '');
	  // return array("status"=>true,"gst"=>$finalgst,"deliveryFee"=>$dfee);
	 
	   //$od = $this->offers_api->value_offer_notification('Amount',array_sum($total),$uid);
	   $od = $this->offers_api->check_value_offer_on_this_day($dtype,array_sum($total),$uid);
	   // return $od;
	    if($od['status']){
	        
	           return array("status"=>true,"gst"=>$finalgst,"grand_total"=>$finalgtotal,"deliveryFee"=>$dfee,"offer"=>$od["offer"]);
	    }else{
	        return array("status"=>true,"gst"=>$finalgst,"grand_total"=>$finalgtotal,"deliveryFee"=>$dfee,"offer"=>[]);
	    }
	        
	}
	
	public function get_gst2($uid){
	    //$uid = $this->input->post('userid');
	    $check  = $this->db->where("userid",$uid)->get("tbl_cart")->result_array();
	   
	    $data = [];
	    	$gst = [];
			//$nGst = array();
			$delivery = [];
	    $i = 0;
	    foreach($check as $row){
	        $pinfo = $this->db->get_where("tbl_products",array("id"=>$row["product_id"],"assigned_to"=>'consumers'))->row();
								
								if($pinfo->gst_charges_status == "Active"){
								
									$gstPrice = $row["price"] * $row["qty"];
									$gstCharge = $pinfo->gst_charges;
									
								//	$nGst[] = $gstPrice * ($gstCharge)/100;
									
									$new["gst"] = $this->admin->gst_total($gstPrice,$gstCharge);//$gstPrice * ($gstCharge)/100;
									$new["deliveryFee"] = 0;
								}else{
								    	$new["gst"] = 0;
								    	$new["deliveryFee"] = 0;
								}
			
	           $pid = $row['product_id'];
	           $row['product_details'] =$this->productbyid($pid);
	           $gst[$i] = $new['gst'];
	           $delivery[$i] = $new['deliveryFee'];
	          // $data[$i] = $new;
	           $i++;
	    }
	   $finalgst = number_format((float)array_sum($gst), 2, '.', '');
	    
	    return $finalgst; //array("gst"=>$finalgst,"deliveryfee"=>array_sum($delivery));
	        
	}
	
	
	public function get_invoice($oid){
	    $data["o"] = $this->db->get_where("orders",array("order_id"=>$oid,"payment_status"=>"Success"))->row();
		return $this->load->view('orders/invoice',$data);	
	}
	public function empty_cart($uid){
	    
	    $check  = $this->db->where("userid",$uid)->delete("tbl_cart");
	    return array("status"=>true,"message"=>"Cart deleted successfully");
	}
	
	public function agent_login($mobile,$password){
	
	$agent_check = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"status"=>'Active'));
	
	if($agent_check->num_rows() >=1){
	    $agdata = $agent_check->row_array();
	    	$cpass = $this->secure->decrypt($agdata['password']);
	    	if($cpass == $password){
		        
			    $data = array("status"=>true, message=>"Logged in successfully",'userid'=>$agdata['id'],"logintype"=>$agdata["role"]);
			
		    }else{
		        
		        $data = array("status"=>false, message=>"Details incorrect");
		    }
	}else{
			$data = array("status"=>true, message=>"User not registered");

	}
	
	return $data;
}	
	
	
	
	
	
public function do_login($mobile,$password){
	
	$agent_check = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"status"=>'Active', "role"=>2));
	$mchk = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile,"user_status"=>0))->num_rows();
	

	if($mchk == 1){

	$pchk = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile,"user_status"=>0))->row_array();
	
	$cpass = $this->secure->decrypt($pchk['password']);
	
		
		if($cpass == $password){
			
			$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$pchk['userid'],"order_status"=>"Success"))->num_rows();
              // $sample="";
				if($sordChk == 1){
					$sample["free_sample"] = "disable";

				}else{
				     $check = $this->db->get_where("orders",array("user_id"=>$pchk['userid'],"order_status"=>"Success"))->num_rows();
				    if($check > 0){
				        	$sample["free_sample"] = "disable"; 
				    }else{
				        	$sample["free_sample"] = "active";   
				    }
				}
				
				$fbKey = $this->input->post("firebaseToken");
				$this->db->where("user_mobile",$mobile)->update("shreeja_users",array("firebase_token"=>$fbKey));
	
			$data = array("status"=>true, message=>"Logged in successfully",'userid'=>$pchk['userid'],"free_sample"=>$sample,"logintype"=>'user',"steps_completed"=>$pchk['steps_completed']);
			
		}else{
			
				$data = array("status"=>false, message=>"Details incorrect");
		}

		
	}else{
			$data = array("status"=>false, message=>"User not registered");

	}
	
	return $data;
}

public function freesamplebyoid($oid){
     $opdata = $this->db->get_where("tbl_free_sample_orders",array("order_id"=>$oid))->result_array();
                        
	    $j = 0;
		$pdata = [];
        		foreach($opdata as $fd){
        											   
            		      $aOrders["product_name"] = $this->db->get_where("tbl_products",array("id"=>$fd['product_id']))->row()->product_name;
                		  $aOrders["description"] = $this->db->get_where("tbl_products",array("id"=>$fd['product_id']))->row()->description;
                		  $aOrders["product_image"] = $this->db->get_where("tbl_products",array("id"=>$fd['product_id']))->row()->product_image;
                		  $aOrders["product_banner"] = $this->db->get_where("tbl_products",array("id"=>$fd['product_id']))->row()->product_banner_image;
                		  $aOrders["category"] =  $fd['qty'];
                		  $aOrders["qty"] ='1';
        		    $pdata[$j] =$aOrders;// $this->productbyid($op->product_id);
        		    $j++;
        
        		} 
        		return $pdata;
}

public function delivered_orders($aid){
   
	$orders = $this->db->query("select order_id,user_id,shipping_address,user_data,delivery_status,order_type,deliveryonce_date as deliverydate from orders where assigned_to='$aid' and payment_status='Success' and order_status='Success' and delivery_status='Success' ")->result_array();

	$fsorders = $this->db->query("select order_id,user_id,shipping_address,user_data,delivery_status,order_type,delivery_date as deliverydate from tbl_free_sample_orders where assigned_to='$aid' and order_status='Success' and delivery_status='Success'")->result_array();
	
	$data = array_merge($orders,$fsorders);
    $date = date("Y-m-d",strtotime("+1 day"));
	//return gettype(date);
   $i = 0;
   $aOrders = [];	
    $all = [];
    	$j = 0;
		$pdata = [];
		
   foreach($data as $u){
       
	   
	   if(json_decode($u["user_data"])){
											   
		   $udata = json_decode($u["user_data"]);

	   }else{

		  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u['user_id'],"user_status"=>0))->row();	   

	   }	   
	   
    	if($u['order_type'] == "deliveryonce"){
    
    		$ddate = date("Y-m-d",strtotime($u['deliverydate']));
    
    	}elseif($u['order_type'] == "freesample"){
    
    		$ddate = date("Y-m-d",strtotime($u['deliverydate']));
    
    	}elseif($u['order_type']  == "subscribe"){
    
    		$sdate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u['order_id'],"delivery_date"=>$date,"pause_status"=>"Inactive"))->row();
    
    		$ddate = date("Y-m-d",strtotime($sdate->delivery_date));
    	}
	    
	    
	    if(strtotime($ddate) == strtotime($date)){  
	    //return array("dd"=>strtotime($ddate),"date"=>strtotime($date),"original"=>$date); 
	        $pdata = $this->productsbyorderid($u['order_id']);
        	 	$opdata = $this->db->get_where("order_products",array("order_id"=>$u['order_id']))->result();	

            		
            		foreach($opdata as $op){
											   
		  $aOrders["product_name"] = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row()->product_name;
		    //$pdata[$j] = $this->productbyid($op->product_id);
		    $j++;

		}
		
		foreach($opdata as $op){
											   
		   $aOrders["quantity"] = $op->category;

		}
		$aOrders["order_id"] = $u['order_id'];
    		$aOrders["user_name"] = $udata->user_name;
    		$aOrders["user_mobile"] = $udata->user_mobile;
    		$aOrders["address"] = $u['shipping_address'];
    		$aOrders["delivery_date"] = $ddate;
    		$aOrders["delivery_status"] = $sdate->deliver_status;
    		$aOrders["order_type"] = $u['order_type'];    
    		$aOrders["productDetails"] = $pdata;
		    $u['products'] = $aOrders;
       $all[$i] = $aOrders;
       $i++;
		
	    }
	    	
   }
    	if(count($all)>0){
	
	return array("status"=>true,"orders"=>$all);
	}else{
	       	return array("status"=>false,"message"=>"Orders not found");
	}

}


public function filter_delivered_orders($aid,$from_date){
    $fdate =date("d-m-Y",strtotime($from_date)); 
    $from_date = date("Y-m-d",strtotime($from_date)); 
    
	$orders = $this->db->query("select order_id,user_id,shipping_address,user_data,delivery_status,order_type,deliveryonce_date as deliverydate,deliveryShift from orders where assigned_to='$aid' and payment_status='Success' and order_status='Success'")->result_array();

	$fsorders = $this->db->query("select order_id,user_id,shipping_address,user_data,delivery_status,order_type,delivery_date as deliverydate,deliveryShift from tbl_free_sample_orders where assigned_to='$aid' and order_status='Success' and delivery_status='Success'")->result_array();
	
	$data = array_merge($orders,$fsorders);
	//return $data;
    $date =$from_date; //date("Y-m-d",strtotime("+1 day")) ;
	//return gettype(date);
   $i = 0;
   $aOrders = [];	
    $all = [];
    	$j = 0;
		$pdata = [];
		
   foreach($data as $u){

	   if(json_decode($u["user_data"])){
											   
		   $udata = json_decode($u["user_data"]);

	   }else{

		  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u['user_id'],"user_status"=>0))->row();	   

	   }	
    	if($u['order_type'] == "deliveryonce" AND $u['delivery_status']=="Success"){
    		//return $u;
    		$ddate = date("Y-m-d",strtotime($u['deliverydate']));
    
    	}elseif($u['order_type'] == "freesample"){
    
    		$ddate = date("Y-m-d",strtotime($u['deliverydate']));
    
    	}elseif($u['order_type']  == "subscribe"){
    
    		$sdate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u['order_id'],"delivery_date"=>$date,"pause_status"=>"Inactive","deliver_status"=>"Success"))->row();
    
    		$ddate = date("Y-m-d",strtotime($sdate->delivery_date));
    	}
	    
	    
	    if(strtotime($ddate) == strtotime($date)){  
	    //return array("dd"=>strtotime($ddate),"date"=>strtotime($date),"original"=>$date); 
	        $pdata = $this->productsbyorderid($u['order_id']);
        	 	$opdata = $this->db->get_where("order_products",array("order_id"=>$u['order_id']))->result();	

    			if($u['order_type'] == "freesample"){
	 	        
	 	            $pdata = $this->freesamplebyoid($u['order_id']);
	 	       
        	 	}
        foreach($opdata as $op){
											   
        		  $aOrders["product_name"] = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row()->product_name;
        		    //$pdata[$j] = $this->productbyid($op->product_id);
        		    $j++;

		}
		
		foreach($opdata as $op){
											   
		   $aOrders["quantity"] = $op->category;

		}
		$aOrders["order_id"] = $u['order_id'];
    		$aOrders["user_name"] = $udata->user_name;
    		$aOrders["user_mobile"] = $udata->user_mobile;
    		$aOrders["address"] = $u['shipping_address'];
    		$aOrders["delivery_date"] = $ddate;
    		$aOrders["delivery_shift"] = $u['deliveryShift'];
    		$aOrders["delivery_status"] = $sdate->deliver_status;
    		$aOrders["order_type"] = $u['order_type'];    
    		$aOrders["productDetails"] = $pdata;
		    $u['products'] = $aOrders;
       $all[$i] = $aOrders;
       $i++;
		
	    }
	    	
   }
    	if(count($all)>0){
	
	return array("status"=>true,"orders"=>$all);
	}else{
	       	return array("status"=>false,"message"=>"Orders not found");
	}

}


	
public function getOrders($aid,$sdate){
	
	// delivery once orders
	
	$this->db->select('order_id,user_id,shipping_address,user_data,delivery_status,order_type,deliveryShift,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","deliveryonce");
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
	$this->db->where('deliveryonce_date', date("d-m-Y",strtotime($sdate)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$dorders = $this->db->get()->result();

// subscription orders
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,user_data,order_type,sub_start_date,deliveryShift,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","subscribe");
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
	$this->db->where("sdate <='".date("Y-m-d",strtotime($sdate))."' AND edate >= '".date("Y-m-d",strtotime($sdate))."'");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$sorders = $this->db->get()->result();
	
	
	
// free sample orders 
	
	$this->db->select('order_id,user_id,shipping_address,product_id,user_data,qty,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift,order_status');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$resutset1 = $this->db->get();
	
	$fsorders = $resutset1->result();
	
		
	$data = array_merge($dorders,$sorders,$fsorders);
	
	return $data;	
}	

public function filter_active_orders($aid,$sdate){

	$data = $this->getOrders($aid,$sdate);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
		
	$pname = array();	
	$pqty = array();	
		
	$orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();
	$oop = $this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();
		
		
	foreach($orderproducts as $op){
		
		if($op->orderRef != "offer"){
		
			$pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"assigned_to"=>"consumers"))->row(); 

			$pname[] = $pdata->product_name." ".$op->category;

			$pqty[] = $op->qty;
			
		}
		
	}
	
	if($oop->orderRef == "offer"){	
		$pdata1 = $this->db->get_where("tbl_products",array("id"=>$oop->product_id))->row(); 

		if(strtotime($sdate) == strtotime($u->sub_start_date) || $u->order_type == "deliveryonce"){

			$pname[] = $pdata1->product_name." ".$oop->category;

			$pqty[] = $oop->qty;
		}
	}
		
//	$udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();
		
	   if(json_decode($u->user_data)){
											   
		   $udata = json_decode($u->user_data);

	   }else{

		  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   

	   }			
		
//	$ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
//	$uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;

//	$area = isset($uarea) ? $uarea : $udata->areanotlisted;
		
		
	if($u->order_type == "deliveryonce"){	
		
	
	   $fDelivery = ((strtotime($u->deliverydate) == strtotime($sdate)) && ($u->delivery_status=="Pending"));
		
	   if($fDelivery){
		   
	     
			$nData1 = array();
			$nData1["order_id"] =  $u->order_id;
			$nData1["user_name"] = $udata->user_name;
			$nData1["user_mobile"] = $udata->user_mobile;
			$nData1["address"] = nl2br($u->shipping_address);
			$nData1["order_type"] =  $u->order_type;
			$nData1["delivery_shift"] =$u->deliveryShift;
			$nData1["delivery_date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData1["delivery_status"] =$u->delivery_status;
			$nData1["productDetails"] = $this->productsbyorderid($u->order_id,"","",$u->order_type);
		   
			$jsonData[] = $nData1;

		  $id++; 
	   }
	 }elseif($u->order_type == "subscribe"){
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date = '$stdate' and deliver_status='Pending'")->result();
		   
		foreach($sdata as $sd){
			
			
		   $nData = array();
			$nData["order_id"] =  $u->order_id;
			$nData["user_name"] = $udata->user_name;
			$nData["user_mobile"] = $udata->user_mobile;
			$nData["address"] = nl2br($u->shipping_address);
			$nData["order_type"] =  $u->order_type;
			$nData["delivery_shift"] =$u->deliveryShift;
			$nData["delivery_date"] = date("Y-m-d",strtotime($sd->delivery_date));
			$nData["delivery_status"] =$u->delivery_status;
			$nData["productDetails"] = $this->productsbyorderid($u->order_id,$sdate,$u->sub_start_date,"");
		   
			$jsonData[] = $nData;
			
		  $id++;
			   
		}
	}elseif($u->order_type == "freesample"){
		
		
	   if((strtotime($u->deliverydate) == strtotime($sdate)) && ($u->delivery_status=="Pending")){
		   
	   		$pd = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row(); 
	   		
	   		$pdata = array();
		   
		         $pdata[] = array(
    		          
    		          "product_name"=>$this->db->get_where("tbl_products",array("id"=>$u->product_id))->row()->product_name,
    		          "category" => $u->qty,
    		          "qty" => 1
    		      );
		    
			$nData2 = array();
			$nData2["order_id"] =  $u->order_id;
			$nData2["user_name"] = $udata->user_name;
			$nData2["user_mobile"] = $udata->user_mobile;
			$nData2["address"] = nl2br($u->shipping_address);
			$nData2["order_type"] =  $u->order_type;
			$nData2["delivery_shift"] =$u->deliveryShift;
			$nData2["delivery_date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData2["delivery_status"] =$u->delivery_status;
			$nData2["productDetails"] = $pdata;
		   
			$jsonData[] = $nData2;
		  $id++;  
	   }
	
	}
}
	

	$finalData["products"] = $jsonData;
	
	
    if(count($jsonData)>0){
	
		return array("status"=>true,"orders"=>$jsonData);
	}else{
	       	return array("status"=>false,"message"=>"Orders not found");
	}

}
	

public function productsbyorderid($oid,$sdate="",$subDate="",$order_type=""){
    $opdata = $this->db->get_where("order_products",array("order_id"=>$oid))->result();
	$oop = $this->db->get_where("order_products",array("order_id"=>$oid,"orderRef"=>"offer"))->row();
	
	$j = 0;
		$pdata = [];
		foreach($opdata as $op){

			if(json_decode($op->product_data)){
				   
				$pd = json_decode($op->product_data);

			}else{

				$pd = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row();

			}
			
			
			if($op->orderRef != "offer"){							   
			  $aOrders["product_name"] = $pd->product_name;
			  $aOrders["description"] = $pd->description;
			  $aOrders["product_image"] = $pd->product_image;
			  $aOrders["product_banner"] = $pd->product_banner_image;
			  $aOrders["category"] = $op->category;
			  $aOrders["qty"] = $op->qty;
				$pdata[$j] =$aOrders;// $this->productbyid($op->product_id);
				$j++;
			}

		} 
	
		if($oop->orderRef == "offer"){	
			
			if(json_decode($oop->product_data)){
				   
				$pdata1 = json_decode($oop->product_data);

			}else{

				$pdata1 = $this->db->get_where("tbl_products",array("id"=>$oop->product_id))->row();

			}
			
			if(strtotime($sdate) == strtotime($subDate) || $order_type == "deliveryonce"){

				  $aOrders["product_name"] = $pdata1->product_name;
				  $aOrders["description"] = $pdata1->description;
				  $aOrders["product_image"] = $pdata1->product_image;
				  $aOrders["product_banner"] = $pdata1->product_banner_image;
				  $aOrders["category"] = $oop->category;
				  $aOrders["qty"] = $oop->qty;
					$pdata[$j] =$aOrders;// $this->productbyid($op->product_id);
					$j++;
			}
		}
	
	
		return $pdata;
}	
	

public function active_agent_list($aid){
  
	$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,user_data,order_type,deliveryShift,deliveryonce_date as deliverydate from orders where assigned_to='$aid' and payment_status='Success' and order_status='Success' and delivery_status='Pending' ")->result_array();

	$fsorders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,product_id,user_data,qty,deliveryShift,delivery_date as deliverydate from tbl_free_sample_orders where assigned_to='$aid' and order_status='Success' and delivery_status='Pending'")->result_array();
    
	$data = array_merge($orders,$fsorders);
	
// 	return $data;
	
	
    $date = date("Y-m-d",strtotime("+1 day"));
	//return gettype(date);
   $i = 0;
   $aOrders = [];	
    $all = [];
    	$j = 0;
		$pdata = [];
		
   foreach($data as $u){

       
        if(json_decode($u["user_data"])){
											   
		   $udata = json_decode($u["user_data"]);

	   }else{

		  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u['user_id'],"user_status"=>0))->row();	   

	   }
    	if($u['order_type'] == "deliveryonce"){
    
    		$ddate = date("Y-m-d",strtotime($u['deliverydate']));
    
    	}elseif($u['order_type'] == "freesample"){
    
    		$ddate = date("Y-m-d",strtotime($u['deliverydate']));
    
    	}elseif($u['order_type']  == "subscribe"){
           
                $sdate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u['order_id'],"delivery_date"=>$date,"pause_status"=>"Inactive"))->row();
          
    		
    
    		$ddate = date("Y-m-d",strtotime($sdate->delivery_date));
    	}
	    
	    
	    if(strtotime($ddate) == strtotime($date)){  
    	    //return array("dd"=>strtotime($ddate),"date"=>strtotime($date),"original"=>$date); 
    	        $pdata = $this->productsbyorderid($u['order_id']);
            	$opdata = $this->db->get_where("order_products",array("order_id"=>$u['order_id']))->result();	
            	
            	$oop = $this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();
                		
        	foreach($opdata as $op){
    		
    		    if($op->orderRef != "offer"){									   
        		  $aOrders["product_name"] = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row()->product_name."(".$op->category.")";
        		  $aOrders["quantity"] = $op->qty;
        		    //$pdata[$j] = $this->productbyid($op->product_id);
        		    $j++;
    		    }
    
    		}
    		
    		 if($oop->orderRef == "offer"){
    		     
    		     if(strtotime($date) == strtotime($u['sub_start_date']) || $u['order_type'] == "deliveryonce"){
            		  $aOrders["product_name"] = $this->db->get_where("tbl_products",array("id"=>$oop->product_id))->row()->product_name."(".$oop->category.")";
            		  $aOrders["quantity"] = $oop->qty;
            		    //$pdata[$j] = $this->productbyid($op->product_id);
            		    $j++;
    		     }
    		  }
    		  
    		  if($u['order_type'] == "freesample"){
    		      
    		      $pdata = array(
    		          
    		          "product_name"=>$this->db->get_where("tbl_products",array("id"=>$u["product_id"]))->row()->product_name,
    		          "category" => $u["qty"],
    		          "qty" => 1
    		      );
        	
    		  }
    		
    // 		foreach($opdata as $op){
    											   
    // 		   $aOrders["quantity"] = $op->qty;
    
    // 		}
    		    $aOrders["order_id"] = $u['order_id'];
        		$aOrders["user_name"] = $udata->user_name;
        		$aOrders["user_mobile"] = $udata->user_mobile;
        		$aOrders["address"] = $u['shipping_address'];
        		$aOrders["delivery_date"] = $ddate;
        		$aOrders["delivery_status"] = $sdate->deliver_status;
        		$aOrders["order_type"] = $u['order_type'];    
        		$aOrders["delivery_shift"] = $u['deliveryShift'];  
        		$aOrders["productDetails"] = $pdata;
    		    $u['products'] = $aOrders;
                $all[$i] = $aOrders;
                $i++;
		
	    }
	    	
   }
    	if(count($all)>0){
	
	return array("status"=>true,"orders"=>$all);
	}else{
	       	return array("status"=>false,"message"=>"Orders not found");
	}

}

public function order_product(){
    
    // return array("status"=>false,"message"=>"Currently we are not accepting orders, Please try again after sometime.");
    
            $object = json_decode($this->input->post('object'));
	        $discount_amount = $this->input->post("discount_amount");
	        $promocode_status = $this->input->post("promocode_status");
	        $renewal_status = $this->input->post("renewal_status");
	        $renewal_order_id = $this->input->post("renewal_order_id");
	        $shift = $this->input->post("shift");
            $order_id = $this->admin->generateOrderId();
            $uid = $object[0]->userid;
            $udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();
        	if($udata->area_delivery_status == "Inactive"){
        		
        		$msg = 'We cannot deliver to your location';
        		return array("status"=>false, "message"=>$msg);
        	}
        	$payment_type = "mobile";
        	$order_status = "pending";
	        $payment_status = "pending";
	        $start_date = date("d-m-Y",strtotime($object[0]->from_date));
	        $end_date = date("d-m-Y",strtotime($object[0]->to_date));
	        $gst  = $object[0]->gst;
	
			if($shift =='evening'){
        		return array("status"=>false,"message"=>"Due to Covid19 we are not accepting evening orders");
        		
        	}
	
	
	       // $total_order_amount = $object[0]->total_amount + $gst;

        /*	$gst = $this->admin->get_option("gst_charges");
        	
        	$gst_charges = $gst/100*$total_order_amount;
        	$total_amount ="";
        	if($gst_charges != 0){
        		
        		$total_amount = $object[0]->total_amount+$gst_charges;
        	
        	}else{
        		
        		$total_amount = $object[0]->total_amount;
        		
        	}
        	
        	if($start_date != "" && $end_date != ""){
		
        		$total_amount = $total_amount * 30;
        		
        	}else{
        		
        		$total_amount = $total_amount;
        	}*/
        
        $dtype = $object[0]->delevery_type;
        
        $total_amount = $object[0]->total_amount + $gst;
	    $minAmt = $this->db->get_where("tbl_charges",array("chargeType"=>"minOrder","status"=>"Active","deliveryType"=>$dtype))->row();

		$this->db->where("sdate >='".date("Y-m-d")."' AND sdate <= '".date("Y-m-d")."'");
		$this->db->or_where("edate >='".date("Y-m-d")."' AND edate <= '".date("Y-m-d")."'");	
		$subChk = $this->db->get_where("orders",array("payment_status"=>"Success","order_type"=>"subscribe","user_id"=>$uid))->num_rows();
		if($minAmt){

			if($total_amount < $minAmt->minimumCharges && $subChk == 0){
				
				$msg = 'Cart value should be greater than'.$minAmt->minimumCharges;
				return array("status"=>false,"message"=>$msg);
	
			}
		}
            	
        $cf = $this->offers_api->check_value_offer_on_this_day($dtype,$total_amount,$uid);
	    //return $cf;
	    if($cf['status']){
	     
	        $hasOffer = "Active";
	        
	    }else{
	        
	        $hasOffer = "Inactive";
	        
	    }
	
//		$userdata = ["user_name"=>$udata->user_name,"user_email"=>$udata->user_email,"user_mobile"=>$udata->user_mobile,"user_current_address"=>$udata->user_current_address];
            	
        $odata = array(
			"order_id" => $order_id,
			"payment_type" => $payment_type,
			"total_amount" => $object[0]->total_amount - $discount_amount,
			"total_order_amount" => $total_amount,
			"gst_charges" => $gst,
			"shipping_address" =>  $object[0]->address,
			"location" => $udata->user_location,
			"user_id" => $uid,
			"user_data" => json_encode($udata),
			"order_type" => $object[0]->delevery_type,
			"sub_start_date" =>  ($dtype=='subscribe')?$start_date:"",
			"sub_end_date" =>  ($dtype=='subscribe')?$end_date:"",
			"sdate" =>  ($dtype=='subscribe')?date("Y-m-d",strtotime($start_date)):"",
			"edate" =>  ($dtype=='subscribe')?date("Y-m-d",strtotime($end_date)):"",
			"deliveryonce_date" =>  $start_date,
			"deliveryShift"=>$shift,
			"date_of_order" => date("Y-m-d H:i:s"),
			"hasOffer" => $hasOffer,
			"discount_amount" => $discount_amount,
			"promocode_status" => $promocode_status,
			"renewal_status" => $renewal_status,
			"renewal_order_id" => $renewal_order_id ? $renewal_order_id : ""
	   );
	   
	    $current_date = date("d-m-Y");
        $current_hour = date("H");
        $order_date =  $odata['sub_start_date'];
         if($shift == 'morning'){
        	if(strtotime($start_date) == strtotime($current_date)){
        		
        		return array("status"=>false,"message"=>"Try ordering for next shift/day");
        	}elseif(strtotime($start_date) == strtotime('+1 day',strtotime($current_date))){

        		if($current_hour >= 17){
        			return array("status"=>false,"message"=>"Try ordering for next shift/day");
        		}
        	}
         }elseif($shift =='evening'){
         	if(strtotime($start_date) == strtotime($current_date)){
        		if($current_hour >= 12){
        			 return array("status"=>false,"message"=>"Try ordering for next shift/day");
        		}
        	}
         }
	       
    		//return $odata;   
        	$oinsert = $this->db->insert("orders",$odata);
	
	        if($oinsert){
	            
                foreach($object as $row){
                        $cid =  $row->cartid;
                        $product_id = $this->db->where("id",$cid)->get("tbl_cart")->row()->product_id;
                        $product_category = $this->db->where("id",$cid)->get("tbl_cart")->row()->product_cat;
                        $price = $this->db->where("id",$cid)->get("tbl_cart")->row()->price;
                        $qty = $this->db->where("id",$cid)->get("tbl_cart")->row()->qty;
                        
                        $ngst = $this->db->get_where("tbl_products",array("id"=>$product_id,"gst_charges_status"=>"Active"))->row()->gst_charges;	
					
						$pdata = $this->db->get_where("tbl_products",array("id"=>$product_id))->row();
		
	                	$gst = isset($ngst) ? $ngst : 0;
                        
                      	 $cidata = array(
        			 
                			"order_id" => $order_id,
                			"product_id" => $product_id,
							"product_data"=>json_encode($pdata), 
                			"category" =>$product_category,
                			"price" => $price,
                			"qty" => $qty,
                			"gst" => $gst,
                			"delivery_date" => date("Y-m-d H:i:s"),
                			
                		 );
                		 //return ($cidata);
        			
        	        	 $op = $this->db->insert("order_products",$cidata);	
                         
                }
                
                $cf = $this->offers_api->check_value_offer_on_this_day($dtype,$total_amount,$uid);
        	    //return $cf;
        	    if($cf['status']){
        	        //return $cf['offer'];
        	        
        	        foreach($cf['offer'] as $cof){
        	        
        	            if($cof["type"] == $dtype){
        	            
                	        $pdata = $this->db->where(array("id"=>$cof['pid']))->get("tbl_products")->row_array();
                            $cat = json_decode($pdata["product_quantity"]);
            	        
                	        $cidata2 = array(
                			 
                    			"order_id" => $order_id,
                    			"product_id" => $cof['pid'],
        						"product_data"=>json_encode($pdata),
                    			"category" =>$cat->quantity[0],
                    			"price" => 0,
                    			"qty" => $cof["qty"],
                    			"delivery_date" => date("Y-m-d H:i:s"),
                    			"orderRef" => "offer"
                    		 );
                    		 $op2 = $this->db->insert("order_products",$cidata2);
                		 
        	            }
                		 
        	        }
                		 
        	    }
        	    	            
        	    return array("status"=>true,"message"=>"Order inserted waiting for payment status","orderid"=>$order_id);

	        }else{
	            
        	    return array("status"=>false,"message"=>"something went wrong try again later.");
	            
	        }
        	    
        
    }

public function order_status($oid="",$tid="",$ostatus="",$roid=""){

    // $uid = $this->input->post('userid');
    $order_id = $oid != "" ? $oid : $this->input->post('orderid');
    $txn_id = $tid != "" ? $tid : $this->input->post('txn_id');
    $status = $ostatus != "" ? $ostatus : $this->input->post('status');
	// $rorder_id = $roid != "" ? $roid : $this->input->post('ren_orderid');

    $odata = $this->db->where(array("order_id"=>$order_id))->get("orders")->row_array();
    $uid = $odata["user_id"];
    $rorder_id = $odata["renewal_order_id"];
	
	$result = $this->db->query('SELECT MAX(id) as Invoice from orders')->row(); 
	
	if(isset($result->Invoice)){
		
		$invoice = "IN1990000".$result->Invoice;
		
	}else{
		
		$invoice = "IN19900000";
			
	}
		
    //$invoice = 'IN'.strtotime(date("d-m-Y H:i:s"));  
     //$data = array("txn_id"=>$uid,"payment_status"=>$order_id,"date_of_payment"=>date("Y-m-d H:i:s"),"order_status"=>$status);
    if($status=="100"){
		
		
        $data = array("txn_id"=>$txn_id,"payment_status"=>"Success","date_of_payment"=>date("Y-m-d H:i:s"),"order_status"=>"Success","invoice_number"=>$invoice);
		
		if($rorder_id){
			
			$this->db->where("order_id",$rorder_id)->update("orders",array("is_renew"=>"Active"));
			
			$data["assigned_to"] = $odata['assigned_to'];
			
		}
		
		
        	if($odata['order_type'] == "subscribe"){
				 
			 $begin = new DateTime( $odata['sub_start_date'] );
			 $end   = new DateTime( $odata['sub_end_date'] );

				for($i = $begin; $i <= $end; $i->modify('+1 day')){

					$ddate = $i->format("Y-m-d");

					$data1 = array("delivery_date"=>$ddate,"order_id"=>$odata['order_id'],"user_id"=>$uid);

                    $oiChk = $this->db->get_where("tbl_subscribed_deliveries",$data1)->num_rows();
                    if($oiChk == 0){
					    $this->db->insert("tbl_subscribed_deliveries",$data1);
                    }
					
				}

		 }
		
		
		$udata = array(

			"user_id" => $uid,
			"message" => "Your order is confirmed.",
			"title" => "Order Success",
	//						"image" => base_url().$u->image,

		);

		$this->db->insert("tbl_user_notifications",$udata);
		
		$token = $this->db->get_where("shreeja_users",array("userid"=>$uid))->row()->firebase_token;
		 
		$nmessage = array(
			
			"title" =>"Order Success",
			"message" => "Your order is confirmed.",
			"imageUrl" => "assets/nimages/order_success.jpg",
			"redirect_to" => "order_placed",

		);

		$this->admin->firebase_notification_subscribe($token,$nmessage);
		
		 
    }else{
        
        $token = $this->db->get_where("shreeja_users",array("userid"=>$uid))->row()->firebase_token;
        
        if($status == "101"){
            $ustatus = "Cancelled";
		    $data = array("txn_id"=>$txn_id,"payment_status"=>"Failed","order_status"=>"Cancelled");
        }else{
            $ustatus = "Processing";
            $data = array("order_status"=>"Processing");   
        }
		
		
		$udata = array(

			"user_id" => $uid,
			"message" => "Your order id $order_id is $ustatus",
			"title" => "Order Failure",
	//		"image" => base_url().$u->image,

		);

		$this->db->insert("tbl_user_notifications",$udata);
		
		$nmessage = array(
			
			"title" =>"Order Failure",
			"message" => "Your order id $order_id is $ustatus",
			"imageUrl" => "assets/nimages/order_failure.jpg",
			"redirect_to" => "order_cancelled",

		);

		$this->admin->firebase_notification_subscribe($token,$nmessage);
		
    }
	
		$this->db->set($data);
		$this->db->where("order_id",$order_id);
	    $d = $this->db->update("orders");

        if($d){
            
            return array("status"=>true, 'message'=>'Payment status has been updated');   
            
        }else{
            
            return array("status"=>false, 'message'=>'error occured');
            
        }

		 
}

public function my_orders($uid){
    /* payment_status='Success' and*/
    $orders = $this->db->query("select * from orders where user_id='$uid' order by id desc")->result_array();
    $i = 0;
    $data = [];
    $or = [];
    $j=0;
    	if(count($orders) > 0){
    	    
		    foreach($orders as $o){
		            $o['order_status'] = ($o['order_status']=='Pending')?"Unsuccessfull":$o['order_status'];
		            $o['payment_status'] = ($o['order_status']=='')?"Failed":$o['payment_status'];
		            $order['orderData'] = $o;
		            $order['productDetailsList'] = $this->productsbyorderid($o['order_id']);//$data;
		       $or[$j]= $order;
		       $j++;
		      
		    }
    	}else{
    	    //return array("status"=>false, 'message'=>'No order data');
    	}
    	
    	
    
        
          $orders2 = $this->db->query("select * from tbl_free_sample_orders where user_id='$uid' order by id desc")->result_array();
   
    $or2 = [];
    $j2=0;
    	if(count($orders2) > 0){
    	    
		    foreach($orders2 as $o2){
		        
                $o2["payment_type"] = "";
                $o2["total_amount"]= "0";
                $o2["total_order_amount"]= "0";
                $o2["gst_charges"]= "0";
                $o2["deliveryCharges"]= "0";
                $o2["payment_gateway_charges"] = "0";
                $o2["discount_amount"] = "0";
                $o2["promocode_status"] = "0";
           
                $o2["location"] = "";
                $o2["user_id"] = "";
                $o2["bank_ref_no"] = "";

                $o2["sub_start_date"] = "";
                $o2["sub_end_date"] = "";
                $o2["deliveryonce_date"] = $o2['delivery_date'];
                $o2["date_of_order"] = $o2['order_date'];
                $o2["date_of_payment"] = "";
                $o2["cancelledDate"] = "";
                $o2["order_type"] = "Free sample";
               
             
                $o2["remark"] = "";
                
		            $o2['order_status'] = "Success";//($o['order_status']=='Pending')?"Unsuccessfull":$o['order_status'];
		            $o2['payment_status'] = "0";//($o['order_status']=='')?"Failed":$o['payment_status'];
		            $order2['orderData'] = $o2;
		            $order2['productDetailsList'][] = $this->productbyfreesample($o2['product_id'],$o2['category'],$o2['qty']);
		            
		       $or2[$j2]= $order2;
		       $j2++;
		      
		    }
    	}
    	$mydata = array_merge($or,$or2);
    	return array("status"=>true, "ordersList"=>$mydata);
}


public function productbyfreesample($pid,$cat,$qty){
		$query = $this->db->where(array("deleted"=>0,"id"=>$pid))->get("tbl_products")->row_array();
		$data['product_name'] = $query['product_name'];
		$data['description'] = $query['description'];
		$data['product_image'] = $query['product_image'];
		$data['product_banner'] = $query['product_banner_image'];
			$data['category'] = $qty;
		$data['qty'] = "1";
		return $data;
	}

public function my_payments($uid){
    /*payment_status='Success' and*/
    $orders = $this->db->query("select * from orders where user_id='$uid' order by id desc")->result_array();
    $i = 0;
    $data = [];
    	if(count($orders) > 0){
    	    
		    foreach($orders as $o){
                   $o['payment_status'] = ($o['payment_status']=='')?"Failed":$o['payment_status'];    
		      	$data[$i] = $o;
		      	$i++;  
		    }
    	}else{
    	    return array("status"=>false, 'message'=>'No payment data');
    	}
    	return array("status"=>true, "data"=>$data);
}


public function subscribe_dates($uid,$oid){
    $o = $this->db->get_where("orders",array("order_id"=>$oid))->row();
    $ords = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->result_array();
          $i = 0;
          $myarray = [];
    	  $cdate = date("H");
    		if($cdate >= 16){
    			$date = date("d-m-Y", strtotime("+ 1 day"));
    		}else{
    			$date = date("d-m-Y");
    		}
         foreach ($ords as $u) { 
											   
            $ddate = date("d-m-Y",strtotime($u['delivery_date']));	
              if($o->order_status == "Cancelled"){
												  
					  $canDate = strtotime($o->cancelledDate);
					  											  
					  if($canDate <= strtotime($ddate)){
						  
						  $u['deliver_status'] = 'Cancelled';
					  }else{
						  
						  if($u['deliver_status'] == "Success"){

								$u['deliver_status'] = 'Success';
							}elseif($u['deliver_status'] == "Pending"){

								$u['deliver_status'] ='Pending';
							}else{
								$u['deliver_status'] = $u['deliver_status'];
							}
					  }
					  
				  }else{ 
				   
						if($u['deliver_status'] == "Success"){
    						$u['deliver_status'] = 'Success';
						}elseif($u['deliver_status'] == "Pending"){
							$u['deliver_status'] = 'Pending';
						}else{
							$u['deliver_status'] = $u['deliver_status'];
						}
				  }
                $myarray[$i] = $u;
                $i++;
         }
      return array("status"=>true,"dates"=>$myarray);  
}

public function agent_profile($id){
    $data = $this->db->where(array("id"=>$id,"status"=>"Active"))->get("fdm_va_auths")->row_array();
    if(count($data)>0){
        return array("status"=>true,"agentdata"=>$data);
    }else{
        return array("status"=>false,"message"=>"Agent not found");
    }
}

public function agent_profile_update(){
    $userid = $this->input->post('userid');
    $email = $this->input->post('email');
    $query = $this->db->where(array("id"=>$userid,"status"=>"Active"))->update("fdm_va_auths",array("email"=>$email));
    if($query){
        return array("status"=>true, "message"=>"Successfully Updated");
    }else{
        return array("status"=>false,"message"=>"Error, please try again");
    }
}

public function agent_password_update(){
     $userid = $this->input->post('userid');
      $password = $this->secure->encrypt($this->input->post('password'));
       $oldpass = $this->input->post('oldpassword');
       $data = $this->db->where(array("id"=>$userid,"status"=>"Active"))->get("fdm_va_auths")->row_array();
       $old = $this->secure->decrypt($data['password']);
      // return $data;
      if($oldpass == $old){
             $query = $this->db->where(array("id"=>$userid,"status"=>"Active"))->update("fdm_va_auths",array("password"=>$password));
            if($query){
                return array("status"=>true, "message"=>"Successfully Updated");
            }else{
                return array("status"=>false,"message"=>"Error, Old password not marching");
            }
    
      }else{
        return array("status"=>false,"message"=>"Error, data incorrect");
      }
}
 
public function sstatus_update(){
    $uid = $this->input->post("userid");
	$oid = $this->input->post("orderid");
	$id = $this->input->post("id");
	$status = $this->input->post("status",true);
	
	$tbldata = $this->db->where(array("id"=>$id,"order_id"=>$oid))->get("tbl_subscribed_deliveries")->row();
	$dbdate =strtotime($tbldata->delivery_date);
	$cdate = strtotime(date("d-m-Y"));
    $hour = strtotime(date('H'));
    if($dbdate == $cdate){
            $this->db->where(array("id"=>$id,"order_id"=>$oid))->update("tbl_subscribed_deliveries",array("deliver_status"=>$status));
            return array("status"=>true,"message"=>"Order status updated successfully");
    }else{
        return array("status"=>true,"message"=>"Could not update status on this date");
    }
}

public function pausesubscribtion(){

	$uid = $this->input->post("userid");
	$oid = $this->input->post("orderid");
	$id = $this->input->post("id");
	$status = $this->input->post("status",true);
	
	$tbldata = $this->db->where(array("id"=>$id,"order_id"=>$oid))->get("tbl_subscribed_deliveries")->row();
	$dbdate =strtotime($tbldata->delivery_date);
	$tdate = date("d-m-Y", strtotime("+ 1 day"));
	$cdate = strtotime(date("d-m-Y"));
    $hour = strtotime(date('H'));
    
     $odata = $this->db->get_where("orders",array("order_id"=>$oid))->row();
    
       if($dbdate >= $cdate){
           
           if($dbdate == $cdate){
               
               
               $pTime = date("d-m-H");
											
				if($odata->deliveryShift == "evening"){

					if($pTime < date("d-m-")."12"){

				// 		$disable = "false";

					}else{

				    	return array("status"=>false, "message"=>'Could not pause order');

					}
				}else{

			    	return array("status"=>false, "message"=>'Could not pause order');

				}
           }
				
				if(strtotime($tdate) == $dbdate){
				    

					$pTime = date("d-m-H");
					
					if($odata->deliveryShift == "morning"){
					   
						if($pTime < date("d-m-")."16"){

				// 			$disable = "false";

						}else{

							return array("status"=>false, "message"=>'Could not pause order');

						}
					}


				}
				
				if(strtotime($odata->sub_start_date) == $dbdate){

					return array("status"=>false, "message"=>'Could not pause order');

				}
            
          
        			$date = date("d-m-Y");
        			$data=array('pause_status'=>$status);
		
            		$this->db->set($data);
            		$this->db->where("id",$id);
            		$d=$this->db->update("tbl_subscribed_deliveries");
        		
       }else{
          	return array("status"=>false, "message"=>'Could not pause on this date'); 
       }
		
		if($d){
			
			if($status=="Active"){
				
				$ords = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->result();
				
				$edate = end($ords)->delivery_date;
				$edate = strtotime($edate);
				$date = strtotime("+1 day", $edate);
				
				$endDate = date('Y-m-d', $date);

				$data = array("delivery_date"=>$endDate,"order_id"=>$oid,"user_id"=>$uid);

				$d = $this->db->insert("tbl_subscribed_deliveries",$data);
				
				$returndata = array("status"=>true, "message"=>'Order Paused');
				
			}else{
				
				$odate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"))->result();
				
				$edate = end($odate)->delivery_date;
//				echo $edate;
				$d = $this->db->delete("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"delivery_date"=>$edate));
				
				$returndata = array("status"=>true, "message"=>'Order Un-Paused');
				
			}
			
			$uorders = $this->db->order_by("id","desc")->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"));

			if($uorders->num_rows() != 30){

				if($uorders->num_rows() > 30){

					$count = ($uorders->num_rows() - 30);

					$this->db->order_by("id","desc")->limit($count)->delete("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"));

				}else{

					$count = (30 - $uorders->num_rows());

					for($i=1; $i<=$count; $i++){

						$edate = end($uorders->row()->delivery_date);
						$edate = strtotime($edate);
						$date = strtotime("+1 day", $edate);

						$endDate = date('Y-m-d', $date);

						$data = array("delivery_date"=>$endDate,"order_id"=>$oid,"user_id"=>$uid);

						$d = $this->db->insert("tbl_subscribed_deliveries",$data);

					}

				}

			}

// delete last inactive orders			
			
			$linords = $this->db->order_by("id","desc")->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->result();	

			$upid = 0;	
			foreach($linords as $lin){

				if(($lin->pause_status == "Active") && ($upid==0)){

					$this->db->delete("tbl_subscribed_deliveries",array("id"=>$lin->id));

				}

				++$upid;

			}
			
// update last date
			
			$updatedenddate = $this->db->order_by("id","desc")->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->row()->delivery_date;

			$data = array("sub_end_date"=>$updatedenddate,"edate"=>date("Y-m-d",strtotime($updatedenddate)));

			$this->db->set($data);
			$this->db->where("order_id",$oid);
			$this->db->update("orders");	
			
			return $returndata;

		}else{
			if($status=="Active"){
				echo $this->alert->pnotify("Error","Error Occured While Enabling Navbar Menu","error");
			}else{
				echo $this->alert->pnotify("Error","Error Occured While Disabling Navbar Menu","error");
			}	
		}
	
	
}

public function my_offers(){
	
	$uid = $this->input->post("userid");
	
	$udata = $this->db->get_where("shreeja_users",["userid"=>$uid])->row();
	
	$order_type = $this->input->post("order_type");
    $data = [];
    $i = 0;
    $query = $this->db->get_where("tbl_offer_management",["city"=>$udata->user_location])->result_array();
    foreach($query as $row){
        $row['city'] = $this->db->where("id",$row['city'])->get("tbl_locations")->row()->location;
        $row['product_details'] = $this->productbyid($row['product_id']);
		
		$cchk = $this->db->get_where("tbl_cart",["product_id"=>$row['product_id'],"product_cat"=>$row['qty'],"userid"=>$uid])->num_rows();
		if(($cchk > 0) && ($row['order_type'] == $order_type)){
			$row["is_offer"] = "Active";
		}else{
			$row["is_offer"] = "Inactive";
		}
		
        $data[$i] = $row;
        $i++;
    }
    	if(count($query) > 0){
    	    return array("status"=>true, "offers"=>$data);
    	}else{
    	   return array("status"=>false, "message"=>"Offers not found");
    	}
    
}	

public function checkPromo($data){
	
	$pdate = date("d-m-Y");
	
	$oType = $this->input->post("ordertype");
	$promocode = $this->input->post("promocode");
	$exsAmount = $this->input->post("amount");
    
	
	$pcChk = $this->db->get_where("tbl_offer_management",array("order_type"=>$oType,"promocode"=>$promocode))->num_rows();
	
	if($pcChk == 1){
		
		$uid = $this->input->post('userid');
		
		$cartItems = $this->db->where("userid",$uid)->get("tbl_cart")->result_array();
		
		$pc = $this->db->get_where("tbl_offer_management",array("order_type"=>$oType,"promocode"=>$promocode))->row();
		
		$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();
	
		if ((strtotime($pdate) >= strtotime($pc->startDate)) && (strtotime($pdate) <= strtotime($pc->endDate))){

		
		}else{
			
			return array("status"=>false,"message"=>"Coupon Expired");
			
		}
		
		if($pc->city != $udata->user_city){
			
			return array("status"=>false,"message"=>"Coupon not applicable for this location");
			
		}
		
		
	    $gst = $this->get_gst2($uid);
			
			
		foreach($cartItems as $c){
				
			if($oType == "subscribe"){
					
				if($c["product_id"] == $pc->product_id && $c["product_cat"] == $pc->qty){
                        
                         $pinfo = $this->db->get_where("tbl_products",array("id"=>$c["product_id"],"assigned_to"=>'consumers'))->row();
								
								if($pinfo->gst_charges_status == "Active"){
								
									$gstPrice = $row["price"] * $row["qty"];
									$gstCharge = $pinfo->gst_charges;
									
								//	$nGst[] = $gstPrice * ($gstCharge)/100;
									
									$new["gst"] = $gstPrice * ($gstCharge)/100;
									$new["deliveryFee"] = 0;
								}else{
								    $new["gst"] = 0;
									$new["deliveryFee"] = 0;
								}
								
					$disPrice = $pc->price * 30 * $c["qty"];

					$offAmount = $exsAmount - $disPrice;
                     if($disPrice >= $exsAmount){
                       return array("status"=>false,"message"=>"Mininum amount not reached to apply this coupon");
                    }
                   $dfee = $this->get_dfee($uid,$exsAmount);
					return array("status"=>true,"message"=>"Coupon Successfully Applied","disPrice"=>number_format($disPrice,2),"totalAmount"=>number_format($offAmount,2),"gst"=>number_format(($gst*30),2),"deliveryFee"=>number_format($dfee,2));

				}else{
				    //return array("status"=>fasle,"message"=>"Coupon not applicable for this product");
				}
					
				
			}elseif($oType == "deliveryonce"){
				//return array("dkd"=>$pc->product_id);

				if($c["product_id"] == $pc->product_id && $c["product_cat"] == $pc->qty){
                     $pinfo = $this->db->get_where("tbl_products",array("id"=>$c["product_id"],"assigned_to"=>'consumers'))->row();
								
								if($pinfo->gst_charges_status == "Active"){
								
									$gstPrice = $row["price"] * $row["qty"];
									$gstCharge = $pinfo->gst_charges;
									
								//	$nGst[] = $gstPrice * ($gstCharge)/100;
									
									$new["gst"] = $gstPrice * ($gstCharge)/100;
									$new["deliveryFee"] = 0;
								}else{
								    $new["gst"] = 0;
									$new["deliveryFee"] = 0;
								}
					$disPrice = $pc->price * $c["qty"];

					$offAmount = $exsAmount - $disPrice;
					$dfee = $this->get_dfee($uid,$exsAmount);
                    if($disPrice >= $exsAmount){
                        return array("status"=>false,"message"=>"Coupan code could not apply");
                    }
                    
                    
					return array("status"=>true,"message"=>"Coupon Successfully Applied","disPrice"=>number_format($disPrice,2),"totalAmount"=>number_format($offAmount,2),"gst"=>number_format($gst,2),"deliveryFee"=>number_format($dfee,2));

				}else{
				    
				    return array("status"=>false,"message"=>"Coupon not applicable for this product");

				}
					
				
			}
			
		}
		
	}else{
		
		return array("status"=>false,"message"=>"Coupon Not Valid");
		
	}
	
}	


public function delivery_fee($uid, $total){
    $udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();
    $dcheck = $this->db->where(array("id"=>$udata->user_location))->get("tbl_locations")->row();
                    $dfee = $dcheck->deliveryCharges;
                    $cutoff = $dcheck->cutoffCharges;
                    if($exsAmount >= $cutoff){
                        $dfees = $dfee;
                    }else{
                        $dfees = 0;
                    }
    return $dfees;
}
public function viewagent_order()
	{
	   $orderid = $this->input->post('orderid');
		$aid = $this->input->post("userid");
		$data= $this->db->query("select * from orders where payment_status='Success' and assigned_to=$aid and order_id = '$orderid' order by id desc")->row_array();
		   $or = [];
		   $i=0;
		$full =  $this->db->get_where("order_products",array("order_id"=>$orderid))->result_array(); 
	
		            foreach($full as $row){
		                    
            		      	$new = $this->productbyid($row['product_id']);
            		      	$new['category'] = $row['category'];
            		      	$new['qty'] = $row['qty'];
            		      	$new['price'] = $row['price'];
            		      	$or[$i] = $new;
            		      	$i++;  
		            }
		           
		   $data['product_details'] = $or;
	    return array("status"=>true,"details"=>$data);
	}
	
public function viewagent_freesample()
	{
	   $orderid = $this->input->post('orderid');
		$aid = $this->input->post("userid");
		$data= $this->db->query("select * from tbl_free_sample_orders where order_status='Success' and assigned_to=$aid and order_id = '$orderid' order by id desc")->row_array();
		   $or = [];
		   $i=0;
	/*	$full =  $this->db->get_where("order_products",array("order_id"=>$orderid))->result_array(); 
	
		            foreach($full as $row){
		                    
            		      	$new = $this->productbyid($row['product_id']);
            		      	$new['category'] = $row['category'];
            		      	$new['qty'] = $row['qty'];
            		      	$new['price'] = $row['price'];
            		      	$or[$i] = $new;
            		      	$i++;  
		            }*/
		            
		      $or[$i] = $this->productbyid($data['product_id']);
		   $data['product_details'] = $or;
	    return array("status"=>true,"details"=>$data);
	}
	
public function deliveryonce_orders()
	{
		$aid = $this->input->post("userid");
		$orders = $this->db->query("select * from orders where payment_status='Success' and order_type='deliveryonce' and assigned_to=$aid order by id desc")->result_array();
	   /* return array("status"=>true, "orders"=>$data);*/
	     $i = 0;
    $data = [];
    $or = [];
    $j=0;
    	if(count($orders) > 0){
    	    
		    foreach($orders as $o){
		        $udata = $this->db->where("userid",$o['user_id'])->get("shreeja_users")->row_array();
		        $o['user_name'] = $udata['user_name'];
		        $o['user_mobile'] = $udata['user_mobile'];
		            $order['orderData'] = $o;
		            
		         /*  $full =  $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result_array();  
		            foreach($full as $row){
		                    
            		      	$new = $this->productbyid($row['product_id']);
            		      	$new['category'] = $row['category'];
            		      	$new['qty'] = $row['qty'];
            		      		$new['price'] = $row['price'];
            		      	$data[$i] = $new;
            		      	$i++;  
		            }*/
		            $order['productDetailsList'] =$this->productsbyorderid($o['order_id']);// $data;
		       $or[$j]= $order;
		       $j++;
		      
		    }
    	}else{
    	    return array("status"=>false, 'message'=>'No order data');
    	}
    	//$my = array("orderData"=>$order,"productDetailsList"=>$data);
    	return array("status"=>true, "ordersList"=>$or);
    	
	}
public function freesample_orders()
	{
    	$aid = $this->input->post("userid");
		$orders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success' and assigned_to=$aid order by id desc")->result_array();
	       /* return array("status"=>true, "orders"=>$data);*/
	         $i = 0;
    $data = [];
    $or = [];
    $j=0;
    	if(count($orders) > 0){
    	    
		    foreach($orders as $o){
		         $udata = $this->db->where("userid",$o['user_id'])->get("shreeja_users")->row_array();
		        $o['user_name'] = $udata['user_name'];
		        $o['user_mobile'] = $udata['user_mobile'];
		            $order['orderData'] = $o;
		            
		           $full =  $this->db->get_where("order_products",array("order_id"=>$o['order_id']))->result_array();  
		            foreach($full as $row){
		                    
            		      	$new = $this->productbyid($row['product_id']);
            		      	$new['category'] = $row['category'];
            		      	$new['qty'] = $row['qty'];
            		      		$new['price'] = $row['price'];
            		      	$data[$i] = $new;
            		      	$i++;  
		            }
		            $order['productDetailsList'] =  $this->productsbyorderid($o['order_id']);//$data;
		       $or[$j]= $order;
		       $j++;
		      
		    }
    	}else{
    	    return array("status"=>false, 'message'=>'No order data');
    	}
    	//$my = array("orderData"=>$order,"productDetailsList"=>$data);
    	return array("status"=>true, "ordersList"=>$or);
    	
	}


public function agent_subscribed_orders()
	{
			$aid = $this->input->post("userid");
		
		/*$data = $this->db->query("select * from orders where payment_status='Success' and order_type='subscribe' and assigned_to=$aid order by id desc")->result();
		 return array("status"=>true, "orders"=>$data);*/
		 
		 $orders = $this->db->query("select * from orders where payment_status='Success' and order_type='subscribe' and assigned_to=$aid order by id desc")->result_array();
    $i = 0;
    $data = [];
    $or = [];
    $j=0;
    	if(count($orders) > 0){
    	    
		    foreach($orders as $o){
		        	$udata = $this->db->where("userid",$o['user_id'])->get("shreeja_users")->row_array();
		            $o['user_name'] = $udata['user_name'];
		            $o['user_mobile'] = $udata['user_mobile'];
		            $order['orderData'] = $o;
		            
		           /*$full =  $this->db->get_where("order_products",array("order_id"=>$o['order_id']))->result_array();  
		            foreach($full as $row){
		                    
            		      	$new = $this->productbyid($row['product_id']);
            		      	$new['category'] = $row['category'];
            		      	$new['qty'] = $row['qty'];
            		      		$new['price'] = $row['price'];
            		      	$data[$i] = $new;
            		      	$i++;  
		            }*/
		            $order['productDetailsList'] = $this->productsbyorderid($o['order_id']);//$data;
		       $or[$j]= $order;
		       $j++;
		      
		    }
    	}else{
    	    return array("status"=>false, 'message'=>'No order data');
    	}
    	//$my = array("orderData"=>$order,"productDetailsList"=>$data);
    	return array("status"=>true, "ordersList"=>$or);
    	
	}	
	
	
public function updateDeliverystatus(){

	$aid = $this->input->post("userid");
	$oid = $this->input->post("orderid");	
	$dstatus = $this->input->post("deliverystatus");
//	$ostatus = $this->input->post("ostatus");
	$oType = $this->input->post("ordertype");
//	$sordid = $this->input->post("sordid");
		$date = date("d-m-Y");
	

	$data = array("delivery_status"=>$dstatus);
	
	if($oType == "deliveryonce"){

		$this->db->set($data);
		$this->db->where("order_id",$oid);
		$u = $this->db->update("orders");
	
	}elseif($oType == "freesample"){
		
		$this->db->set($data);
		$this->db->where("order_id",$oid);
		$u = $this->db->update("tbl_free_sample_orders");
		
	}elseif($oType == "subscribe"){
	    $date = date("Y-m-d");
		$sordid = $this->db->where(array("order_id"=>$oid,"delivery_date"=>$date))->get("tbl_subscribed_deliveries")->row()->id;
	$sdata = array("deliver_status"=>$dstatus,"delivered_by"=>$aid);
		
		$this->db->set($sdata);
		$this->db->where("id",$sordid);
		$u = $this->db->update("tbl_subscribed_deliveries");
		
	}

	
	
	if($u){

		return array("status"=>true,"message"=>"Order status updated successfully");
	}else{
         return array("status"=>false,"message"=>"Error, Please try again");
	}
	
}	


public function cancle_order($data){
    $userid = $this->input->post("userid");
    $orderid = $this->input->post("orderid");
    $check = $this->db->where(array("order_id"=>$orderid,"user_id"=>$userid,"payment_status"=>"Success"))->get("orders");
    if($check->num_rows() > 0){
        $this->db->where(array("order_id"=>$orderid,"user_id"=>$userid,"payment_status"=>"Success"))->update("orders",array("order_status"=>"Cancelled"));
        return array("status"=>true,"message"=>"Order Cancelled Successfully");   
    }else{
        return array("status"=>false,"message"=>"Something went wrong please try again");   
    }
    
}


public function allProductquantity($uid){
	
/*
	$orders = $this->db->query("select order_id,order_type,date_of_order,id,deliveryonce_date as deliverydate from orders where payment_status='Success' and order_status='Success' and assigned_to='$uid'  order by id desc")->result();
		
	$fsorders = $this->db->query("select order_id,product_id,qty,id,order_type,delivery_date as deliverydate,order_date as date_of_order from tbl_free_sample_orders where order_status='Success' and assigned_to='$uid' order by id desc")->result();
		
	$data = array_merge($orders,$fsorders);	
*/
	
	$jsonData = array();
	
    $ddate = date("Y-m-d");
	$data = $this->getOrders($uid,$ddate);	
	
	$id = 1;
	
	foreach($data as $u){
		
	   $orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
		
//	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	
		
	   if($u->order_type == "subscribe"){
		
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date = '$ddate'")->result();
		   
		 foreach($sdata as $sd){
			 

		   foreach($orderproducts as $op1){
			   
			    $str = $op1->category;
							
				$qtyMea = preg_replace('!\d+!', '', $str);

				$qM = str_replace(" ","",$qtyMea);


				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


				$lMint = $int * $op1->qty;

		   
			  $pdata1 = $this->db->get_where("tbl_products",array("id"=>$op1->product_id,"assigned_to"=>"consumers"))->row(); 
			   
		   		$nData1 = array();
				$nData1["sno"] = $id;
				$nData1["product_id"] = $op1->product_id;
				$nData1["Item_Code"] = $pdata1->product_id;
				$nData1["Item_name"] = $pdata1->product_name;
				$nData1["Quantity"] = $lMint;
				$nData1["qm"] = $qM;
//				$nData1["UOM"] =  $tQty;
				$nData1["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
				
				$jsonData[] = $nData1;
			   
			  $id++; 
		   }
		 }
	   }elseif($u->order_type == "deliveryonce"){
		   
		  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) == strtotime($ddate)){ 
		   
		   foreach($orderproducts as $op){
			   
			  $str = $op->category;
							
				$qtyMea = preg_replace('!\d+!', '', $str);

				$qM = str_replace(" ","",$qtyMea);


				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


				$lMint = $int * $op->qty;

			  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"assigned_to"=>"consumers"))->row(); 
			   
		   		$nData = array();
				$nData["sno"] = $id;
				$nData["product_id"] = $op->product_id;
				$nData["Item_Code"] = $pdata->product_id;
				$nData["Item_name"] = $pdata->product_name;
				$nData["Quantity"] = $lMint;
				$nData["qm"] = $qM;
//				$nData["UOM"] =  $tQty;
				$nData["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
				$jsonData[] = $nData;
			   
			   $id++;
		   }
			   
		  }
	}else{
		   
	  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) == strtotime($ddate)){ 
   
		  		$str = $u->qty;
							
				$qtyMea = preg_replace('!\d+!', '', $str);

				$qM = str_replace(" ","",$qtyMea);


				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


				$lMint = $int * 1;

		  
		  $pdata = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row(); 
			   
		   		$nData2 = array();
				$nData2["sno"] = $id;
				$nData2["product_id"] = $pdata->id;
				$nData2["Item_Code"] = $pdata->product_id;
				$nData2["Item_name"] = $pdata->product_name;
				$nData2["Quantity"] = $lMint;
				$nData2["qm"] = $qM;
				$nData2["UOM"] =  "EA";
				$nData2["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
				
				$jsonData[] = $nData2; 
		   $id++;
		   
	   }
	   }
	
	
	
	}
	
	
	$oresult = array();
	foreach($jsonData as $k => $v) {
		$id = $v['product_id'];
		$oresult[$id][] = $v['Quantity'];
	}
	
	$result = array();
	foreach($jsonData as $k => $v) {
		$id = $v['product_id'];
		$qmid = "qm".$v['product_id'];
		$result[$qmid][] = $v['qm'];
		$result[$id][] = $v['Quantity'];
	}
	
	
//	echo '<pre>';
//	print_r($jsonData);
//	exit();

	$new = array();
	
	$id1 = 1;
	
	foreach($oresult as $key => $value) {
		
	  $pdata2 = $this->db->get_where("tbl_products",array("id"=>$key,"assigned_to"=>"consumers"))->row(); 

		
		$fqty = number_format(array_sum($value));

		$tQty = round(str_replace(",",".",$fqty),2);
		
		
		if($result["qm".$key][0] == "ML"){
			
			if(array_sum($value) >= 1000){
				
				$quantity = $tQty." L";
				
			}else{
				
				$quantity = $tQty." ML";
				
			}
			
		}else{
			
			if(array_sum($value) >= 1000){
				
				$quantity = $tQty." KG";
				
			}else{
				
				$quantity = $tQty." gm";
				
			}
			
		}
		
		
		$new[] = array(
				'sno' => $id1,
				'Item_Code' => $pdata2->product_id, 
				'Item_name' => $pdata2->product_name,
				'Quantity' => $quantity,
				'UOM' => 'EA',
		);
		$id1++;
		
	}
	
		
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $new ];
	//echo json_encode($results);	
	return array("status"=>true, "data"=>$new);
}	

public function filterProductquantity(){
	
	$uid = $this->input->post("userid");
	$sdate = $this->input->post("sdate");
	$edate = $this->input->post("edate");
	$shift = $this->input->post("shift");
	
//	$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,date_of_order,assigned_to,id,invoice_number,deliveryonce_date as deliverydate from orders where payment_status='Success' and order_status='Success' order by id desc")->result();
		
	$this->db->select('order_id,order_type,deliveryShift,deliveryonce_date as deliverydate,date_of_order');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$uid);
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$resutset = $this->db->get();
	
	$orders = $resutset->result();		
	$fsorders = $this->db->query("select order_id,product_id,qty,id,order_type,delivery_date as deliverydate,order_date as date_of_order from tbl_free_sample_orders where order_status='Success' and assigned_to='$uid' order by id desc")->result();
		
	$data = array_merge($orders,$fsorders);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
	   $orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
		
//	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	
		
	   if($u->order_type == "subscribe"){
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		 $endate = date("Y-m-d",strtotime($edate));
		   
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date between '$stdate' and '$endate'")->result();
		   
		 foreach($sdata as $sd){
			 

		   foreach($orderproducts as $op1){
			   
			    $str = $op1->category;
							
				$qtyMea = preg_replace('!\d+!', '', $str);

				$qM = str_replace(" ","",$qtyMea);


				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


				$lMint = $int * $op1->qty;

		   
			  $pdata1 = $this->db->get_where("tbl_products",array("id"=>$op1->product_id))->row(); 
			   
		   		$nData1 = array();
				$nData1["sno"] = $id;
				$nData1["product_id"] = $op1->product_id;
				$nData1["Item_Code"] = $pdata1->product_id;
				$nData1["Item_name"] = $pdata1->product_name;
				$nData1["Quantity"] = $lMint;
				$nData1["qm"] = $qM;
//				$nData1["UOM"] =  $tQty;
				$nData1["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
				
				$jsonData[] = $nData1;
			   
			  $id++; 
		   }
		 }
	   }elseif($u->order_type == "deliveryonce"){
		   
		  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) >= strtotime($sdate) && (strtotime(date("Y-m-d",strtotime($u->deliverydate))) <= strtotime($edate))){ 
		   
		   foreach($orderproducts as $op){
			   
$str = $op->category;
							
				$qtyMea = preg_replace('!\d+!', '', $str);

				$qM = str_replace(" ","",$qtyMea);


				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


				$lMint = $int * $op->qty;

			  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row(); 
			   
		   		$nData = array();
				$nData["sno"] = $id;
				$nData["product_id"] = $op->product_id;
				$nData["Item_Code"] = $pdata->product_id;
				$nData["Item_name"] = $pdata->product_name;
				$nData["Quantity"] = $lMint;
				$nData["qm"] = $qM;
//				$nData["UOM"] =  $tQty;
				$nData["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
				$jsonData[] = $nData;
			   
			   $id++;
		   }
		  }
			
	}else{
		   
		  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) >= strtotime($sdate) && (strtotime(date("Y-m-d",strtotime($u->deliverydate))) <= strtotime($edate))){ 
		   
		  		$str = $u->qty;
							
				$qtyMea = preg_replace('!\d+!', '', $str);

				$qM = str_replace(" ","",$qtyMea);


				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


				$lMint = $int * 1;

		  
		  $pdata = $this->db->get_where("tbl_products",array("id"=>$u->product_id))->row(); 
			   
		   		$nData2 = array();
				$nData2["sno"] = $id;
				$nData2["product_id"] = $pdata->id;
				$nData2["Item_Code"] = $pdata->product_id;
				$nData2["Item_name"] = $pdata->product_name;
				$nData2["Quantity"] = $lMint;
				$nData2["qm"] = $qM;
				$nData2["UOM"] =  "EA";
				$nData2["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
				
				$jsonData[] = $nData2; 
		   $id++;
		   
	   }
	   
	}
	
	
	}
	
	$oresult = array();
	foreach($jsonData as $k => $v) {
		$id = $v['product_id'];
		$oresult[$id][] = $v['Quantity'];
	}
	
	$result = array();
	foreach($jsonData as $k => $v) {
		$id = $v['product_id'];
		$qmid = "qm".$v['product_id'];
		$result[$qmid][] = $v['qm'];
		$result[$id][] = $v['Quantity'];
	}
	
//	echo '<pre>';
//	print_r($result);
//	exit();
	

	$new = array();
	
	$id1 = 1;
	
	foreach($oresult as $key => $value) {
		
	  $pdata2 = $this->db->get_where("tbl_products",array("id"=>$key))->row(); 

		
		$fqty = number_format(array_sum($value));

		$tQty = round(str_replace(",",".",$fqty),2);
		
		
		if($result["qm".$key][0] == "ML"){
			
			if(array_sum($value) >= 1000){
				
				$quantity = $tQty." L";
				
			}else{
				
				$quantity = $tQty." ML";
				
			}
			
		}else{
			
			if(array_sum($value) >= 1000){
				
				$quantity = $tQty." KG";
				
			}else{
				
				$quantity = $tQty." gm";
				
			}
			
		}
		
		if($pdata2->product_id != ""){
		
			$new[] = array(
					'sno' => $id1,
					'Item_Code' => $pdata2->product_id, 
					'Item_name' => $pdata2->product_name,
					'Quantity' => $quantity,
					'UOM' => 'EA',
			);
		}
		
		$id1++;
		
	}
	
	
	
//	echo '<pre>';
//	
//	print_r($new);
//	
//	echo '</pre>';
//	
//	exit();
	
$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $new ];
	//echo json_encode($results);	
	return array("status"=>true, "data"=>$new);
}	


public function consolidation_data($aid,$date,$shift){

 $products = $this->db->where_in("assigned_to",array("consumers","freeProduct"))->get("tbl_products")->result_array();
 $i = 0;
 $data = [];
 foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
	    	$new['product_id'] = $row1['id'];
	    	$new['pname'] = $row1['product_name'];
			$new['quantity'] = $value;
			$new['sap_code'] = $sap[$key];
			$new['packets'] = $this->get_success_orders($date,$new['product_id'],$new['quantity'],$aid,$shift);
			$data[$i] = $new;
	       	$i++;
    	}

			
	       	
	   }
	   //return $data;
 $data_final = $this->final_consolidate($data);

return array("status"=>true,"data"=>$data_final);
}	

public function getDQOrders($sdate,$shift,$aid){
	
	
	// delivery once orders
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,user_data,order_type,deliveryShift,assigned_to,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","deliveryonce");
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
	$this->db->where('deliveryonce_date', date("d-m-Y",strtotime($sdate)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$dorders = $this->db->get()->result();

// subscription orders
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,order_type,user_data,deliveryShift,assigned_to,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","subscribe");
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
	$this->db->where("sdate <='".date("Y-m-d",strtotime($sdate))."' AND edate >= '".date("Y-m-d",strtotime($sdate))."'");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$sorders = $this->db->get()->result();
	
	$data = array_merge($dorders,$sorders);
	
	return $data;	
}	
	
public function get_success_orders($date,$pid,$cat,$aid,$shift){
	
	$orders = $this->getDQOrders($date,$shift,$aid);
	
	$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success' AND assigned_to='$aid' and product_id='$pid' AND qty='$cat' AND deliveryShift='$shift'")->result();
	
	$pqty = [];
	foreach($fsorders as $fo){
	    if(strtotime($date) == strtotime($fo->delivery_date)){
	        $pqty[] = 1;
	    }
	    
	}
	foreach($orders as $o){
			
			if($o->order_type == "deliveryonce"){
				if(strtotime($date) == strtotime($o->deliveryonce_date)){
					$opdata = $this->db->where(array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->get("order_products")->result();
				    $pqty[] = $opdata;
					foreach($opdata as $op){
			          
						$pqty[] = $op->qty;
						
					}
                    
				}
				
			}elseif($o->order_type == "subscribe"){
				$sdata = $this->db->select("delivery_date")->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive","delivery_date"=>date("Y-m-d",strtotime($date))))->result();
		
		         $oop = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat,"orderRef"=>"offer"))->row();
					
				if(strtotime($date) == strtotime($o->sub_start_date)){
					$pqty[] = $oop->qty;
				}
		
				foreach($sdata as $sd){
					
					if(strtotime($date) == strtotime($sd->delivery_date)){
						
						$opdata1 = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->result();
					    
						foreach($opdata1 as $op1){
							
							if($op1->orderRef != "offer"){ 
							
								$pqty[] = $op1->qty;
								
							}
							
						}
						
					}
					
				}
				//$pqty[] = $o;
				
			}
			
		}
		return array_sum($pqty);
}

public function final_consolidate($data){
	$i = 0;
	$array = [];
	foreach ($data as $row) {
		if($row['packets']>0){
			$array[]=$row;
		}else{

		}
		//$i++;
	}
	return $array;
}
	

	



}
