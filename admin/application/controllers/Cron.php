<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct(){
    			
    	parent::__construct();
    	$this->load->model('user_model');
    	
    }
    
    public function updateOrderstatus(){
        
        require_once('assets/ccavenue/Crypto.php');
	    $workingKey='3827A52CEA61B0DDC2C73E46C5EC1C20';		//Working Key should be provided here.
	    $access_code = 'AVBI09IE19BN38IBNB';
	    
	    $prdata = $this->db->get_where("orders",["order_status"=>"Processing"])->result();
		
		foreach($prdata as $pr){
		    
            $corder_id = $pr->order_id;
    	    $encrypted_data=encrypt(json_encode(["order_no"=>$corder_id]),$workingKey);
        	$command="orderStatusTracker";
        	$final_data ="request_type=JSON&access_code=".$access_code."&command=".$command."&response_type=JSON&version=1.1&enc_request=".$encrypted_data;
        
        	$ch = curl_init();
        	curl_setopt($ch, CURLOPT_URL,"https://api.ccavenue.com/apis/servlet/DoWebTrans");
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        	curl_setopt($ch, CURLOPT_VERBOSE, 1);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        	curl_setopt($ch, CURLOPT_POST, 1);
        	curl_setopt($ch, CURLOPT_POSTFIELDS,$final_data);
        
        	$result = curl_exec ($ch);
        	curl_close ($ch);
        	
        	$information1=explode('&',$result);
        	
        	$dataSize1=sizeof($information1);
        	$status1=explode('=',$information1[0]);
        	$status2=explode('=',$information1[1]);
        	
    	    $status2[1] = strlen($status2[1]) > 2144 ? substr($status2[1],0,strlen($status2[1])-2): $status2[1];
    	    
    		$status=decrypt($status2[1],$workingKey);
    		
    		log_message('error', $corder_id." ".$status);
    		$fdata = json_decode($status);
    		
    		
    		if($fdata->order_status==="Success" || $fdata->order_status === "Shipped"){
    			$order_status = "100";
    		}else{
    		    if($fdata->order_status == "Aborted"){	
    			    $order_status = "101";
    		    }else{
    		        $order_status = "102";
    		    }
    		}
    		
    		$this->user_model->order_status($corder_id, $fdata->tracking_id, $order_status);
    		
		}
        
    }
	
}