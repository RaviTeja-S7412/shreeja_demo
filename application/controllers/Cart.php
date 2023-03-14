<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

public function __construct(){
			
	parent::__construct();
	
	date_default_timezone_set("Asia/Kolkata");
	
 }

public function index(){
	
	$this->load->view("cart");

}
	
	
	
public function addProduct(){
	
	$pid = $this->input->post("pid");
	$price = $this->input->post("price");
	$category = $this->input->post("category");
	$qty = $this->input->post("qty");
	
	$cartid = str_replace(' ', '', $pid.$category);
	
	
//	$this->cart->destroy();
//	
//	exit();
	
	
	$extCart = $this->cart->contents();
	
	foreach($extCart as $c){
		
		if($c["name"] == $category && $c["product_id"] == $pid){
			
//			echo "exist";
			echo json_encode(array("status"=>"exist"));
			
			exit();
		}
		
		
	}
	
	
	$data = array(
	
		"id" => $cartid,
		"price" => $price,
		"name" => $category,
		"qty" => $qty,
		"product_id" =>$pid
	
	);
	
	
	
	$ci = $this->cart->insert($data);
	
	if($ci){
		
			echo json_encode(array("status"=>"1","cartCount"=>count($this->cart->contents())));
	}else{
		
			echo json_encode(array("status"=>"0"));
	}
	
	
}
	
public function getDeliverycharges(){
	
	$total = $this->input->post("total");
	
	
	$uid = $this->session->userdata("user_id");

	$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();

	$dCharges = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location))->row();

    $cutOffcharges = $dCharges->cutoffCharges;
    $deliveryCharges = $dCharges->deliveryCharges;
	
	
	
	if($total < $cutOffcharges){
								
		$delCharges = $deliveryCharges;
		$totCharges = $total + $delCharges;
	
		echo json_encode(array("delCharges"=>$delCharges,"total"=>$totCharges));
		
	}else{
		
		$delCharges = "Free";
		$totCharges = $total;
		echo json_encode(array("delCharges"=>$delCharges,"total"=>$totCharges));
		
		
	}
	
	
	
}	
	
function remove($rowid) {

	$data = array();
	foreach($this->cart->contents() as $items){
		if($items['rowid'] == $rowid){

			$data[] =  array(
			'rowid'   => $rowid,
			'price'   => '',
			'amount' =>  '',
			'qty'     => 0


			);
		}
	}

	$this->cart->update($data);
	redirect(base_url().'cart');    
}	
	
	
public function insertOrder(){	

	$uid = $this->session->userdata("user_id");
	$oid = $this->admin->generateOrderId();
	$payment_type = $this->input->post("payment_type",true);
	$shipping_address = $this->input->post("shipping_address",true);
	$location = $this->input->post("location",true);
	$order_type = $this->input->post("order_type",true);
	$sub_start_date = $this->input->post("sub_start_date",true);
	$sub_end_date = $this->input->post("sub_end_date",true);
	$deliveryonce_date = $this->input->post("delivery_date",true);
	$date_of_order = date("Y-m-d H:i:s");
	$order_status = "pending";
	$payment_status = "pending";
	$quantity = $this->input->post("quantity");
	$cartid = $this->input->post("cartid");
	
	$delShift = $this->input->post("delshift");
	$subShift = $this->input->post("subshift");
	
	
	$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();
	
	if($udata->area_delivery_status == "Inactive"){
		
		$msg = '<div class="alert alert-danger">We are unable to serve this location now. Will contact you soon to serve the order.</div>';
		
		$this->session->set_flashdata("err",$msg);
		
		redirect("cart");
		
	}
	
	
	$cadata = $this->cart->contents();
// 	print_r($cadata);
// 	exit;
	if(strtotime($sub_end_date) < strtotime($sub_start_date)){
		
		$msg = '<div class="alert alert-danger">End date should be greater than start date.</div>';
		
		$this->session->set_flashdata("err",$msg);
		
		redirect("cart");
	}
	
	
	$cdate = date("H");

	if($cdate >= 18){

		$date = date("Y-m-d", strtotime("+ 2 day"));
		
	}else{
		
		$date = date("Y-m-d", strtotime("+ 1 day"));

	}
	
	if($sub_start_date != ""){
		
		$startDate = $sub_start_date;
		$deliveryDate = date("Y-m-d", strtotime("+ 5 day"));
		
	}else{
		
		$startDate = date("Y-m-d", strtotime("+ 5 day"));
		$deliveryDate = $deliveryonce_date;
		
	}
	
	
	
//	if(strtotime($startDate) < strtotime($date) || strtotime($deliveryDate) < strtotime($date)){
//		
//		$msg = '<div class="alert alert-danger">Please Select Valid Date</div>';
//		
//		$this->session->set_flashdata("err",$msg);
//		
//		redirect("cart");
//	}	
	
	
	
//	$gst = $this->admin->get_option("gst_charges");
//	
	$gst_charges = $this->input->post("gstCharges");
	

	
//	
//	if($gst_charges != 0){
//		
//		$total_amount = $this->cart->total()+$gst_charges;
//	
//	}else{
//		
//		$total_amount = $this->cart->total();
//		
//	}
	
	
	
	
//	if($sub_start_date != "" && $sub_end_date != ""){
//		
//		$total_amount = $total_amount * 30;
//		
//	}else{
//		
//		$total_amount = $total_amount;
//	}
	
	
//	if($order_type == "subscribe"){
//				 
//			 $begin = new DateTime( $sub_start_date );
//			 $end   = new DateTime( $sub_end_date );
//		
//			$id = 1;
//		
//				for($i = $begin; $i <= $end; $i->modify('+1 day')){
//
//					$ddate = $i->format("Y-m-d");
//					
//					echo($ddate)."<br>"."+";
//
//					echo($id++)."+";
////					$data = array("delivery_date"=>$ddate,"order_id"=>$oid,"user_id"=>$uid);
////
////					$this->db->insert("tbl_subscribed_deliveries",$data);
//
//				}
//
//		 }
	
	
	if($subShift != ""){
		
		$shift = $subShift;
		
	}else{
		
		$shift = $delShift;
		
	}
	
	$promoStatus = $this->input->post("promoStatus");
	$promoDisamount = $this->input->post("promoDisamount");
	$deliveryCharges = $this->input->post("deliveryCharges");
	
	$pStatus = ($promoStatus == "Active") ? $promoStatus : "Inactive";
	$pdisamount = ($promoDisamount != "") ? $promoDisamount : 0;
	
	$total_amount = $this->input->post("total_amount");
	$total_order_amount = $total_amount + $gst_charges + $deliveryCharges + $pdisamount;
	
	
	$minAmt = $this->db->get_where("tbl_charges",array("chargeType"=>"minOrder","status"=>"Active","deliveryType"=>$order_type))->row();

	$this->db->where("sdate >='".date("Y-m-d")."' AND sdate <= '".date("Y-m-d")."'");
	$this->db->or_where("edate >='".date("Y-m-d")."' AND edate <= '".date("Y-m-d")."'");
	$subChk = $this->db->get_where("orders",array("payment_status"=>"Success","order_type"=>"subscribe","user_id"=>$uid))->num_rows();
	
	if($minAmt){
		
		if($total_order_amount < $minAmt->minimumCharges && $subChk == 0){
			
			$msg = '<div class="alert alert-danger">Cart value should be greater than &#8377; '.$minAmt->minimumCharges.'.</div>';
		
			$this->session->set_flashdata("err",$msg);
			
			redirect("cart");

		}
		
	}
	
	
	$cadata1 = $this->cart->contents();
	$hasOffer = "";
		
		foreach($cadata1 as $cc){
			
			if($cc["ref"] == "offer"){
				
				$hasOffer = "Active";
				
			}
			
		}
	
// 	   $userdata = ["user_name"=>$udata->user_name,"user_email"=>$udata->user_email,"user_mobile"=>$udata->user_mobile,"user_current_address"=>$udata->user_current_address];	

	
		$odata = array(

			"order_id" => $oid,
			"payment_type" => $payment_type,
			"total_amount" => $total_amount,
			"total_order_amount" => $total_order_amount,
			"discount_amount" => $pdisamount,
			"promocode_status" => $pStatus,
			"gst_charges" => $gst_charges,
			"shipping_address" => $shipping_address,
			"location" => $location,
			"user_id" => $uid,
			"user_data" => json_encode($udata),
			"order_type" => $order_type,
			"sub_start_date" => $sub_start_date,
			"sub_end_date" => $sub_end_date,
			"sdate" =>  date("Y-m-d",strtotime($sub_start_date)),
			"edate" =>  date("Y-m-d",strtotime($sub_end_date)),
			"deliveryonce_date" => $deliveryonce_date,
			"date_of_order" => date("Y-m-d H:i:s"),
			"deliveryCharges" => $deliveryCharges,
			"deliveryShift" => $shift,
			"hasOffer" => $hasOffer
	   );
	

	$oinsert = $this->db->insert("orders",$odata);

	if($oinsert){
		
		$cadata = $this->cart->contents();
		
		foreach($cadata as $cc){
			
			$ngst = $this->db->get_where("tbl_products",array("id"=>$cc["product_id"],"gst_charges_status"=>"Active"))->row()->gst_charges;	
			$pdata = $this->db->get_where("tbl_products",array("id"=>$cc["product_id"]))->row();	

			$gst = isset($ngst) ? $ngst : 0;	

			 $cidata = array(

				"order_id" => $oid,
				"product_id" => $cc["product_id"],
				"product_data" => json_encode($pdata),
				"category" => $cc["name"],
				"price" => $cc["price"],
				"qty" => $cc["qty"],
				"gst" => $gst,
				"delivery_date" => date("Y-m-d H:i:s"),
				"orderRef" => $cc["ref"]
			 );

			 $op = $this->db->insert("order_products",$cidata);	

		 }
		 if($op){
			 
			 if($payment_type == "mobikwik"){
			     
			    redirect("mobikwik/index/".$oid);
			 
			 }else{
			     
			    redirect("payment/paytm_pay/".$oid);
			 
			 }
		 }else{
			 
			$msg = '<div class="alert alert-danger">Error Occured Please Try Again.</div>';
		
			$this->session->set_flashdata("err",$msg);

//			redirect("cart");
			 
		 }	
			
	}else{
			 
		$msg = '<div class="alert alert-danger">Error Occured Please Try Again.</div>';
		
		$this->session->set_flashdata("err",$msg);

//		redirect("cart");
			 
	}
	
  }
	
  	
  public function sampleOrder($id){
	
	$oid = $this->admin->generatefsOrderId();
	$uid = $this->session->userdata("user_id");
	$ordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid))->num_rows();
	  
	 $result = $this->db->query('SELECT MAX(id) as Invoice from tbl_free_sample_orders')->row(); 
		
		if(isset($result->Invoice)){
			
			$invoice = "INFS1990000".$result->Invoice;
			
		}else{
			
			$invoice = "INFS19900000";
			
		}
	  
	  
	$sp = $this->db->get_where("tbl_sample_products",array("id"=>$id))->row();

	$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();	  
	$userdata = ["user_name"=>$udata->user_name,"user_email"=>$udata->user_email,"user_mobile"=>$udata->user_mobile,"user_current_address"=>$udata->user_current_address];	
	  
    $pdata = $this->db->get_where("tbl_products",array("id"=>$sp->product_id))->row();	
  
	  
	$data = array(
	
		"invoice_number" => $invoice,  
		"order_id" => $oid,
		"product_id" => $sp->product_id,
		"product_data"=>json_encode($pdata),
		"qty" => $sp->qty,
		"user_id" => $uid,
		"user_data" => json_encode($userdata),
		"location" => $udata->user_location
	);  
	  
	if($ordChk == 1){
		
		$this->db->set($data);
		$this->db->where("user_id",$uid);
		$op = $this->db->update("tbl_free_sample_orders");
		
	}else{
		
		$op = $this->db->insert("tbl_free_sample_orders",$data);
		
	}  
	  
	if($op){
		
		redirect("cart/orders");
		
	}else{
		
		$this->session->set_flashdata("cerr",'<div class="alert alert-danger">Error occured please try again</div>');
		redirect("products/sampleOrder");
	}  
	  
  }
	
  public function orders(){

	  $uid = $this->session->userdata("user_id");
	  $data["ord"] = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid))->row();
	  
	  $this->load->view("sampleordercart",$data);
	  
	  
  }	
	
 public function insertSampleOrder(){
	 
	  $uid = $this->session->userdata("user_id");
	  $ddate = $this->input->post("delivery_date");
	  $address = $this->input->post("shipping_address"); 
	  $delshift = $this->input->post("delshift"); 
	 
	  $data = array(
	 	"shipping_address" => $address,
		"delivery_date" => $ddate,
		"order_status" => "Success",
		"deliveryShift" => $delshift
		  
	  );
	 
	 
	 $this->db->set($data);
	 $this->db->where("user_id",$uid);
	 $co = $this->db->update("tbl_free_sample_orders");
	
	 if($co){
		
		$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid))->row();
		 
		$msg = 'your free sample will be delivered shortly.'; 
		 
		$this->sms->send_sms($udata->user_mobile,$msg); 
		 
		$this->session->set_flashdata("cierr",'<div class="alert alert-success">Order placed successfully</div>');
		redirect("cart/orders");

	 }else{
		 
 		$this->session->set_flashdata("cierr",'<div class="alert alert-danger">Error occured please try again</div>');
		redirect("cart/orders");

	 }
 }	
	
	
public function cancelOrder($id){
	
	$data = array("order_status"=>"Cancelled","cancelledDate"=>date("d-m-Y H:i:s"));
	
	$this->db->set($data);
	$this->db->where("order_id",$id);
	$c = $this->db->update("orders");
	
	if($c){
		
		echo 1;
	}else{
		
		echo 0;
	}
	
	
	
}
	
	
public function checkPromo(){
	
	$pdate = date("d-m-Y");
	
	$oType = $this->input->post("oType");
	$promocode = $this->input->post("promocode");
	$exsAmount = $this->input->post("exsAmount");
	
	$pcChk = $this->db->get_where("tbl_offer_management",array("order_type"=>$oType,"promocode"=>$promocode))->num_rows();
	
	if($pcChk == 1){
		
		$uid = $this->session->userdata("user_id");
		
		$cartItems = $this->cart->contents();
		
		$pc = $this->db->get_where("tbl_offer_management",array("order_type"=>$oType,"promocode"=>$promocode))->row();
		
		$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();
		
		if ((strtotime($pdate) >= strtotime($pc->startDate)) && (strtotime($pdate) <= strtotime($pc->endDate))){

		
		}else{
			
			echo json_encode(array("status"=>"error","msg"=>"Coupon Expired"));
			exit();
			
		}
		
		if($pc->city != $udata->user_location){
			
			echo json_encode(array("status"=>"error","msg"=>"Coupon aot applicable for this location"));
			exit();
			
		}
		
		foreach($cartItems as $c){
			
			if($oType == "subscribe"){
					
				if($c["product_id"] == $pc->product_id && $c["name"] == $pc->qty){


					$disPrice = $pc->price * 30 * $c["qty"];

					$offAmount = $exsAmount - $disPrice;
					
					if($disPrice < $exsAmount){

						echo json_encode(array("status"=>"success","msg"=>"Coupon Successfully Applied","disPrice"=>$disPrice,"totalAmount"=>$offAmount));
						exit;
					
					}

				}else{
								
					echo json_encode(array("status"=>"error","msg"=>"Coupon Not Valid"));
					exit;

				}
					
				
			}elseif($oType == "deliveryonce"){
				

				if($c["product_id"] == $pc->product_id && $c["name"] == $pc->qty){

					$disPrice = $pc->price * $c["qty"];

					$offAmount = $exsAmount - $disPrice;

					if($disPrice < $exsAmount){
						
						echo json_encode(array("status"=>"success","msg"=>"Coupon Successfully Applied","disPrice"=>$disPrice,"totalAmount"=>$offAmount));
						exit;
						
					}else{
								
						echo json_encode(array("status"=>"error","msg"=>"Coupon Not Valid"));
						exit;

					}
				}
					
				
			}
			
		}
		
	}else{
		
		echo json_encode(array("status"=>"error","msg"=>"Coupon Not Valid"));
		exit;
		
	}
	
}	

	
// cross product offer
	
	
	
public function check_value_offer_on_this_day(){
    
        foreach($this->cart->contents() as $key => $items){
			if($items['ref'] == "offer"){

				$rowid = $items['rowid']; 

				$data[] =  array(
				'rowid'   => $rowid,
				'price'   => '',
				'amount' =>  '',
				'qty'     => 0,
				"ref" => ""	


				);
			}
		}

		$this->cart->update($data);
		
		$total = $this->input->post("total");
	    $date = date("m/d/Y", strtotime("now"));
		$orderType = $this->input->post("orderType");
	
	    $chkOffext = $this->db->get_where("orders",array("user_id"=>$this->session->userdata("user_id"),"hasOffer"=>"Active","payment_status"=>"Success"))->num_rows();
	
	    $uid = $this->session->userdata("user_id");
		$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid))->row();
	
	    $query = $this->db->query("SELECT * FROM tbl_product_offers WHERE offerType='Amount' AND orderType='$orderType' and status='Active' and city='$udata->user_location' order by cartValue DESC");
	    
	    $sOffer = $this->db->query("SELECT * FROM tbl_product_offers WHERE offerType='sameProduct' AND orderType='$orderType' and status='Active' and city='$udata->user_location'");
	    
	    
	    $cOffer = $this->db->query("SELECT * FROM tbl_product_offers WHERE offerType='crossProduct' AND orderType='$orderType' and status='Active' and city='$udata->user_location'");
		   
		if($query->num_rows() > 0 ){
		   
            if($chkOffext == 0){
                
			    $data = array();
				foreach($this->cart->contents() as $key => $items){
					if($items['ref'] == "offer"){

						$rowid = $items['rowid']; 

						$data[] =  array(
						'rowid'   => $rowid,
						'price'   => '',
						'amount' =>  '',
						'qty'     => 0,
						"ref" => ""	


						);
					}
				}

				$this->cart->update($data);


				 $row  = $query->row_array();
				 $value =  $row['cartValue'];

				 if($total >=$value){


						if ((strtotime($date) >= strtotime($row["from_date"])) && (strtotime($date) <= strtotime($row["to_date"]))){


							if($total >=$value){

										$productid = $row['outputProduct'];

										$pdata = $this->get_product($productid);

										$cat = json_decode($pdata["product_quantity"]);


										$pid = $productid;
										$price = 0;
										$category = $cat->quantity[0];
										$qty = $row['outputQty'];

										$cartid = str_replace(' ', '', $pid.$price);


										$extCart = $this->cart->contents();

										foreach($extCart as $c){


											if($c["product_id"] == $pid || $c["ref"] == "offer"){

												exit();
											}


										}

										$data = array(

											"id" => $cartid,
											"price" => $price,
											"name" => $category,
											"qty" => $qty,
											"product_id" =>$pid,
											"ref" => "offer"

										);

										$ci = $this->cart->insert($data);

										echo "success";

										exit();

							}else{

								$data = array();
								foreach($this->cart->contents() as $key => $items){
									if($items['ref'] == "offer"){

										$rowid = $items['rowid']; 

										$data[] =  array(
										'rowid'   => $rowid,
										'price'   => '',
										'amount' =>  '',
										'qty'     => 0,
										"ref" => ""	


										);
									}
								}

								$d = $this->cart->update($data);

								if($d){
									echo "fail";
								}


							}
						}
				 }else{

						 foreach($query->result_array() as $row2){

							if ((strtotime($date) >= strtotime($row2["from_date"])) && (strtotime($date) <= strtotime($row2["to_date"]))){

							if($total >= $row2['cartValue']){

									$productid = $row2['outputProduct'];

									$pdata = $this->get_product($productid);
									$cat = json_decode($pdata["product_quantity"]);


									$pid = $productid;
									$price = 0;
									$category = $cat->quantity[0];
									$qty = $row2['outputQty'];

									$cartid = str_replace(' ', '', $pid.$price);


									$extCart = $this->cart->contents();


									foreach($extCart as $c){

										if($c["product_id"] == $pid || $c["ref"] == "offer"){
											exit();
										}


									}
									$data = array(

										"id" => $cartid,
										"price" => $price,
										"name" => $category,
										"qty" => $qty,
										"product_id" =>$pid,
										"ref" => "offer"

									);

									$ci = $this->cart->insert($data);

									echo "success";

									exit();

							}else{

								$data = array();
								foreach($this->cart->contents() as $key => $items){
									if($items['ref'] == "offer"){

										$rowid = $items['rowid']; 

										$data[] =  array(
										'rowid'   => $rowid,
										'price'   => '',
										'amount' =>  '',
										'qty'     => 0,
										"ref" => ""	


										);
									}
								}

								$d = $this->cart->update($data);

								if($d){
									echo "fail";
								}
	//							exit();
							}

						 }
					}
				 }
			}
			
		    
		}
		
		if($sOffer->num_rows() > 0 ){
			   
                $cContents = $this->cart->contents();
				$sameProducts  = $sOffer->result_array();
				
				foreach($sameProducts as $row){
				
    				$pid =  $row['inputProduct'];
    				$qty =  $row['inputQty'];
    
    				$sStatus = "";
    				$getQty = "";
    
    				foreach($cContents as $c){
    					
    					if($c["product_id"] == $pid && $c["qty"] >= $qty){
    
    						$sStatus = true;
                            $getQty = $c["qty"];
    
    					}
    
    				}
    
    				 if($sStatus){
    
    					 if ((strtotime($date) >= strtotime($row["from_date"])) && (strtotime($date) <= strtotime($row["to_date"]))){
    
    
    							$productid = $row['inputProduct'];
    							$pdata = $this->get_product($productid);
    							$cat = json_decode($pdata["product_quantity"]);
    
    							$pid = $productid;
    							$price = 0;
    							$category = $cat->quantity[0];
    							$qty = $row['outputQty'];
    
    							$cartid = str_replace(' ', '', $pid.$price);
    
    
    							$extCart = $this->cart->contents();
    
    							foreach($extCart as $c){
    
    								if($c["product_id"] == $pid && $c["ref"] == "offer"){
    								// 	exit();
    								}
    
    							}
    
    
    							$data = array(
    
    								"id" => $cartid,
    								"price" => $price,
    								"name" => $category,
    								"qty" => ($qty*$getQty),
    								"product_id" =>$pid,
    								"ref" => "offer"
    
    							);
    
    							$ci = $this->cart->insert($data);
    							echo "success";
    
    						}
    
    				 }
                }   
                
		   }
		   
		   if($cOffer->num_rows() > 0 ){

				$cContents = $this->cart->contents();
			    $crossProducts  = $cOffer->result_array();
			    
			    foreach($crossProducts as $row){
			    
    				 $pid =  $row['inputProduct'];
    				 $qty =  $row['inputQty'];
    
    
    				 $sStatus = "";
    				 $getQty = "";
    
    				 foreach($cContents as $c){
    					
    					if($c["product_id"] == $pid && $c["qty"] >= $qty){
    
    						$sStatus = true;
                            $getQty = $c["qty"];
    
    					}
    
    				 }
    
    
    				 if($sStatus){
    
    					 if ((strtotime($date) >= strtotime($row["from_date"])) && (strtotime($date) <= strtotime($row["to_date"]))){
    
    
    							$productid = $row['outputProduct'];
    
    							$pdata = $this->get_product($productid);
    
    							$cat = json_decode($pdata["product_quantity"]);
    
    
    							$pid = $productid;
    							$price = 0;
    							$category = $cat->quantity[0];
    							$qty = $row['outputQty'];
    
    							$cartid = str_replace(' ', '', $pid.$price);
    
    
    							$extCart = $this->cart->contents();
    
    							foreach($extCart as $c){
    
    								if($c["product_id"] == $pid && $c["ref"] == "offer"){
    								// 	exit();
    								}
    
    							}
    
    
    							$data = array(
    
    								"id" => $cartid,
    								"price" => $price,
    								"name" => $category,
    								"qty" => ($qty*$getQty),
    								"product_id" =>$pid,
    								"ref" => "offer"
    
    							);
    
    							$ci = $this->cart->insert($data);
    							echo "success";
    
    						}
    
    				 }
    				 
			    }

		   }

	}
	
	
	public function cartProducts(){
		
		$this->load->view("cartProducts");
		
	}
	
	public function get_product($pid){
	    
		$query = $this->db->where(array("id"=>$pid))->get("tbl_products")->row_array();
//		$data['product_name'] = $query['product_name'];
//		$data['description'] = $query['description'];
//		$data['product_image'] = $query['product_image'];
//		$data['product_banner'] = $query['product_banner_image'];
		return $query;
	}
	
	
	
}