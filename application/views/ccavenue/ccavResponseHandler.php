<?php 
	include('Crypto.php');
	//error_reporting(0);.

//date_default_timezone_set('Asia/Kolkata');


	$workingKey='3827A52CEA61B0DDC2C73E46C5EC1C20';		//Working Key should be provided here.
	$access_code = 'AVBI09IE19BN38IBNB';
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		
	
//	$order_status="Success";
//	$tracking_id = "IRO4719298";
//	$bank_ref_no = "62174436804";
//	$order_id = "ORD7614832";
//	$payment_mode = "online";


	$order_status="";
	$tracking_id = "";
	$bank_ref_no = "";
	$order_id = "";
	$payment_mode = "";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0) $order_id = $information[1];
		if($i==1) $tracking_id = $information[1];
		if($i==2) $bank_ref_no = $information[1];
		if($i==3) $order_status = $information[1];
		if($i==5) $payment_mode = $information[1];
	}

	if(isset($rcvdString) || $rcvdString != null && $rcvdString != ''){
    
        $this->user_model->order_status($order_id, $order_status, $tracking_id, $bank_ref_no);
        redirect("cart");
    	
	}else{
        sleep(30);

	    $corder_id = $this->session->userdata("corder_id");
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
		
		$fdata = json_decode($status);
		$this->user_model->order_status($corder_id, $fdata->order_status, $fdata->order_bank_ref_no, $fdata->reference_no);
        redirect("cart");

     }
	
	
	
	
	
//	echo "<br><br>";
//
//	echo "<table cellspacing=4 cellpadding=4>";
//	for($i = 0; $i < $dataSize; $i++) 
//	{
//		$information=explode('=',$decryptValues[$i]);
//	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
//	}
//
//	echo "</table><br>";
//	echo "</center>";
?>

