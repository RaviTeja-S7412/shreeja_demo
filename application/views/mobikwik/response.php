<?php
/*
Template Name: Zaakpay Response Page
*/
// error_reporting(E_ALL); 

?>
<?php include('checksum.php'); ?>
<?php
	// Please insert your own secret key here
	/*$secret = '0678056d96914a8583fb518caf42828a';*/
	$payment_gateway_credentials = json_decode($this->admin->get_option("payment_gateway"));
	$secret = $payment_gateway_credentials->secret_key;

	$recd_checksum = $_POST['checksum'];
	$all = Checksum::getAllResponseParams();
	error_log("AllParams:".$all);
	error_log("Secret Key : ".$secret);
	$checksum_check = Checksum::verifyChecksum($recd_checksum, $all, $secret);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zaakpay</title>
</head>
<body>

<center>
<table width="500px;">
	<?php 
	//$check = Checksum::outputResponse($checksum_check);
	
	//print_r($_POST);
	
// 	echo $_POST["responseCode"];


$order_id = $_POST["orderId"];
$responseCode = $_POST["responseCode"];
$tracking_id = $_POST["pgTransId"];
$bank_ref_no = "";


$odata = $this->db->get_where("orders",array("order_id"=>$order_id))->row();
$uid = $odata->user_id;

if($responseCode == 100){
    
         $result = $this->db->query('SELECT MAX(id) as Invoice from orders')->row(); 
		
		if(isset($result->Invoice)){
			
			$invoice = "IN1990000".$result->Invoice;
			
		}else{
			
			$invoice = "IN19900000";
			
		}    
    
		$this->session->set_flashdata(array("payment_status"=>'<div class="alert alert-success alert-dismissible">Your Order ID of '.$odata->order_id.' Payment Has Been Successfully Done.</div>'));
		
		$data = array("txn_id"=>$tracking_id,"bank_ref_no"=>$bank_ref_no,"payment_status"=>"Success","date_of_payment"=>date("Y-m-d H:i:s"),"order_status"=>"Success","invoice_number"=>$invoice);
		
		$this->db->set($data);
		$this->db->where("order_id",$odata->order_id);
		$this->db->update("orders");
		
		
		
		if($odata->order_type == "subscribe"){
		    
		  	 $begin = new DateTime( $odata->sub_start_date );
			 $end   = new DateTime( $odata->sub_end_date );
			
				for($i = $begin; $i <= $end; $i->modify('+1 day')){
					
					$ddate = $i->format("Y-m-d");

					$data = array("delivery_date"=>$ddate,"order_id"=>$odata->order_id,"user_id"=>$uid);

					$this->db->insert("tbl_subscribed_deliveries",$data);

				}

		 }
		
		$this->cart->destroy();
		
		$this->session->set_userdata(array("order_id"=>$odata->order_id));

		
		redirect("cart");
		
		
		
	}
	else {
		
		$this->session->set_flashdata(array("payment_status"=>'<div class="alert alert-danger alert-dismissible" style="margin-top:15%">Payment Failed</div>'));
		
		$data = array("payment_status"=>"Failed","order_status"=>"Cancelled");
		
		$this->db->set($data);
		$this->db->where("order_id",$odata->order_id);
		$this->db->update("orders");
		
		redirect("cart");
		
	}

	?>
</table>


</center>



</body>
</html>
