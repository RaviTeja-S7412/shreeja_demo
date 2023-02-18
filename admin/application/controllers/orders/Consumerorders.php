<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumerorders extends CI_Controller {

public function __construct(){
			
	parent::__construct();
	
    date_default_timezone_set('Asia/Kolkata');
 		
//	$this->secure->loginCheck();
}
	
	
public function index()
	{
		
		$this->load->view('orders/admin/allOrders');
	}
	
public function conOrders()
	{
		
		$this->load->view('orders/admin/conOrders');
	}
	
public function getOrders($sdate,$edate,$shift,$city){
	
	// delivery once orders
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,user_data,order_type,order_status,date_of_order,sub_start_date,invoice_number,deliveryShift,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","deliveryonce");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
	$this->db->where('deliveryonce_date >=', date("d-m-Y",strtotime($sdate)));
	$this->db->where('deliveryonce_date <=', date("d-m-Y",strtotime($edate)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$dorders = $this->db->get()->result();

// subscription orders
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,user_data,order_type,order_status,date_of_order,sub_start_date,invoice_number,deliveryShift,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","subscribe");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
// 	$this->db->where("sdate <='".date("Y-m-d",strtotime($sdate))."' AND edate >= '".date("Y-m-d",strtotime($edate))."'");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$sorders = $this->db->get()->result();
	
	
	
// free sample orders 
	
	$this->db->select('order_id,user_id,product_id,qty,shipping_address,user_data,order_status,invoice_number,product_data,delivery_status,id,order_type,assigned_to,delivery_date as deliverydate,order_date as date_of_order,deliveryShift');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	
//	$this->db->where('delivery_date >=', date("d-m-Y",strtotime($sdate)));
//	$this->db->where('delivery_date <=', date("d-m-Y",strtotime($edate)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$resutset1 = $this->db->get();
	
	$fsorders = $resutset1->result();
	
		
	$data = array_merge($dorders,$sorders,$fsorders);
	
	return $data;	
}	
	
public function generateInvoice($oid){
		
$odata = $this->db->get_where("orders",array("order_id"=>$oid,"payment_status"=>"Success"))->row();
		
		if($odata){
			
			$data["o"] = $odata;
			
		}else{
			
			$data["o"] = $this->db->get_where("tbl_free_sample_orders",array("order_id"=>$oid,"order_status"=>"Success"))->row();
			
		}
	
		$this->load->view('orders/invoice',$data);		
		
	}	
	
public function consumersOrders(){
	
	$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,date_of_order,order_status,assigned_to,deliveryShift,sub_start_date,id,invoice_number,deliveryonce_date as deliverydate from orders where payment_status='Success' order by id desc")->result();
		
	$fsorders = $this->db->query("select order_id,user_id,product_id,qty,shipping_address,delivery_status,id,order_type,order_status,invoice_number,assigned_to,delivery_date as deliverydate,order_date as date_of_order,deliveryShift from tbl_free_sample_orders where order_status='Success' order by id desc")->result();
		
	$data = array_merge($orders,$fsorders);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
	   $orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
	   $oop = $this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();	
		
	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	
		
		
	   if($u->order_type == "subscribe"){
		   
		   if($oop){
		 
			  $pdata1 = $this->db->get_where("tbl_products",array("id"=>$oop->product_id))->row(); 
			   
			  $pqty = json_decode($pdata1->product_quantity); 
			   
			  foreach($pqty->quantity as $key => $qqty){
				 
				  if($oop->category == $qqty){
				  
				  	$sap = $pqty->sap[$key];
					  
				  }
				  
			  }  
			   
			  			   
					$nData1 = array();
					$nData1["sno"] = $id;
					$nData1["Invoice"] = $u->invoice_number;
					$nData1["Item_Code"] = $sap;
					$nData1["Item_name"] = $pdata1->product_name." ".$oop->category;
					$nData1["Quantity"] = $oop->qty;
					$nData1["UOM"] =  "EA";
					$nData1["orderDate"] = date("Y-m-d",strtotime($u->sub_start_date));
					$nData1["Name"] = $udata->user_name;
					$nData1["Number"] = $udata->user_mobile;
					$nData1["Orderid"] =  $u->order_id;
					$nData1["ordertype"] =  $u->order_type;
					$nData1["shift"] =  $u->deliveryShift;
					$nData1["Amount"] =  0;
					$nData1["SGST"] = 0;
					$nData1["CGST"] = 0;
					$nData1["SGST_amount"] = $gstAmount1 / 2;
					$nData1["CGST_amount"] = $gstAmount1 / 2;
					$nData1["TotalAmount"] = $nAmt1 + $gstAmount1;
					$jsonData[] = $nData1;

				  $id++; 
			
		   }
		   
		 $sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u->order_id,"pause_status"=>"Inactive","deliver_status !="=>"Cancelled"))->result();
		   
		 foreach($sdata as $sd){
			 

		   foreach($orderproducts as $op1){
			 
			  $gst1 = $op1->gst/2; 
			  $gstAmount1 = $this->admin->gst_total(($op1->price * $op1->qty),$op1->gst);
		      $nAmt1 = ($op1->price * $op1->qty) - $gstAmount1; 
			  
		   
			  $pdata1 = $this->db->get_where("tbl_products",array("id"=>$op1->product_id,"assigned_to"=>"consumers"))->row(); 
			   
			  $pqty = json_decode($pdata1->product_quantity); 
			   
			  foreach($pqty->quantity as $key => $qqty){
				 
				  if($op1->category == $qqty){
				  
				  	$sap = $pqty->sap[$key];
					  
				  }
				  
			  }  
			   
			   
			  if($op1->orderRef != "offer"){ 		   
			   
					$nData1 = array();
					$nData1["sno"] = $id;
					$nData1["Invoice"] = $u->invoice_number;
					$nData1["Item_Code"] = $sap;
					$nData1["Item_name"] = $pdata1->product_name." ".$op1->category;
					$nData1["Quantity"] = $op1->qty;
					$nData1["UOM"] =  "EA";
					$nData1["orderDate"] = date("Y-m-d",strtotime($sd->delivery_date));
					$nData1["Name"] = $udata->user_name;
					$nData1["Number"] = $udata->user_mobile;
					$nData1["Orderid"] =  $u->order_id;
					$nData1["ordertype"] =  $u->order_type;
					$nData1["shift"] =  $u->deliveryShift;
					$nData1["Amount"] =  $nAmt1;
					$nData1["SGST"] = $gst1;
					$nData1["CGST"] = $gst1;
					$nData1["SGST_amount"] = $gstAmount1 / 2;
					$nData1["CGST_amount"] = $gstAmount1 / 2;
					$nData1["TotalAmount"] = $nAmt1 + $gstAmount1;
					$jsonData[] = $nData1;

				  $id++; 
			 
			  }
		   }
			 
		 }
		   
		   
	   }elseif($u->order_type == "deliveryonce"){
		   
		   if($u->order_status == "Success"){
		   
			   foreach($orderproducts as $op){

				  $gst = $op->gst/2; 
				  
				  $gstAmount = $this->admin->gst_total(($op->price * $op->qty),$op->gst);
                  $nAmt = ($op->price * $op->qty) -$gstAmount; 
            
				  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row(); 

				  $pqty = json_decode($pdata->product_quantity); 

				  foreach($pqty->quantity as $key => $qqty){

					  if($op->category == $qqty){

						$sap = $pqty->sap[$key];

					  }

				  } 

					$nData = array();
					$nData["sno"] = $id;
					$nData["Invoice"] = $u->invoice_number;
					$nData["Item_Code"] = $sap;
					$nData["Item_name"] = $pdata->product_name." ".$op->category;
					$nData["Quantity"] = $op->qty;
					$nData["UOM"] =  "EA";
					$nData["orderDate"] = date("Y-m-d",strtotime($u->deliverydate));
					$nData["Name"] = $udata->user_name;
					$nData["Number"] = $udata->user_mobile;
					$nData["Orderid"] =  $u->order_id;
					$nData["ordertype"] =  $u->order_type;
					$nData["shift"] =  $u->deliveryShift;
					$nData["Amount"] =  $nAmt;
					$nData["SGST"] = $gst;
					$nData["CGST"] = $gst;
					$nData["SGST_amount"] = $gstAmount / 2;
					$nData["CGST_amount"] = $gstAmount / 2;
					$nData["TotalAmount"] = $nAmt + $gstAmount;
					$jsonData[] = $nData;

				   $id++;
			   }
		   }
			   
			
	}else{
		  
//  		  if($u->order_status == "Success"){
  
			  $pdata = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row(); 

			  $pqty = json_decode($pdata->product_quantity); 

				  foreach($pqty->quantity as $key => $qqty){

					  if($u->qty == $qqty){

						$sap = $pqty->sap[$key];

					  }

				  } 

					$nData2 = array();
					$nData2["sno"] = $id;
					$nData2["Invoice"] = $u->invoice_number;
					$nData2["Item_Code"] = $sap;
					$nData2["Item_name"] = $pdata->product_name." ".$u->qty;
					$nData2["Quantity"] = 1;
					$nData2["UOM"] =  "EA";
					$nData2["orderDate"] = date("Y-m-d",strtotime($u->deliverydate));
					$nData2["Name"] = $udata->user_name;
					$nData2["Number"] = $udata->user_mobile;
					$nData2["Orderid"] =  $u->order_id;
					$nData2["ordertype"] =  $u->order_type;
					$nData2["shift"] =  $u->deliveryShift;
					$nData2["Amount"] =  0;
					$nData2["SGST"] = 0;
					$nData2["CGST"] = 0;
					$nData2["SGST_amount"] = 0;
					$nData2["CGST_amount"] = 0;
					$nData2["TotalAmount"] = 0;
					$jsonData[] = $nData2; 
			   $id++;
			  
//		  }
		   
	   }
	
	
	
	}
	
	
//	echo '<pre>';
//	
//	print_r($jsonData);
//	
//	echo '</pre>';
		
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);
	
}	

public function filterconsumersOrders(){
	
	$sdate = $this->input->post("sdate");
	$edate = $this->input->post("edate");
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");
	
	$data = $this->getOrders($sdate,$edate,$shift,$city);
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
	   $orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
	   $oop = $this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();	
		
//	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	
		
	   if(json_decode($u->user_data)){

		   $udata = json_decode($u->user_data);

	   }else{

		  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   

	   }				
		
	   if($u->order_type == "subscribe"){
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		 $endate = date("Y-m-d",strtotime($edate));
		   
		   if(strtotime($sdate) == strtotime($u->sub_start_date) && $oop){
			   
			   if(json_decode($oop->product_data)){
				   
				   $pdata1 = json_decode($oop->product_data);
				   
			   }else{
				
				   $pdata1 = $this->db->get_where("tbl_products",array("id"=>$oop->product_id))->row();
				   
			   }
			   
			  $pqty = json_decode($pdata1->product_quantity); 
			   
			  foreach($pqty->quantity as $key => $qqty){
				 
				  if($oop->category == $qqty){
				  
				  	$sap = $pqty->sap[$key];
					  
				  }
				  
			  }  
			   
			  			   
					$nData1 = array();
					$nData1["sno"] = $id;
					$nData1["Invoice"] = $u->invoice_number;
					$nData1["Item_Code"] = $sap;
					$nData1["Item_name"] = $pdata1->product_name." ".$oop->category." (Free)";
					$nData1["Quantity"] = $oop->qty;
					$nData1["UOM"] =  "EA";
					$nData1["orderDate"] = date("Y-m-d",strtotime($u->sub_start_date));
					$nData1["Name"] = $udata->user_name;
					$nData1["Number"] = $udata->user_mobile;
					$nData1["Orderid"] =  $u->order_id;
					$nData1["ordertype"] =  $u->order_type;
					$nData1["shift"] =  $u->deliveryShift;
					$nData1["Amount"] =  0;
					$nData1["SGST"] = 0;
					$nData1["CGST"] = 0;
					$nData1["SGST_amount"] = $gstAmount1 / 2;
					$nData1["CGST_amount"] = $gstAmount1 / 2;
					$nData1["TotalAmount"] = $nAmt1 + $gstAmount1;
					$jsonData[] = $nData1;

				  $id++; 
			   
			   
			   
		   }
		   
		   		   
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and deliver_status!='Cancelled' and delivery_date between '$stdate' and '$endate'")->result();
		   
		   
		 foreach($sdata as $sd){

		   foreach($orderproducts as $op1){
			   
			  if($op1->orderRef != "offer"){ 		   
			   
					  $gst1 = $op1->gst/2; 
					  
                      $gstAmount1 = $this->admin->gst_total(($op1->price * $op1->qty),$op1->gst);
                      $nAmt1 = ($op1->price * $op1->qty) -$gstAmount1; 
				  
				  	  if(json_decode($op1->product_data)){
				   
						   $pdata1 = json_decode($op1->product_data);

					   }else{

						   $pdata1 = $this->db->get_where("tbl_products",array("id"=>$op1->product_id))->row();

					   }	
					  
						$pqty = json_decode($pdata1->product_quantity); 

						  foreach($pqty->quantity as $key => $qqty){

							  if($op1->category == $qqty){

								$sap = $pqty->sap[$key];

							  }

						  } 


						$nData1 = array();
						$nData1["sno"] = $id;
						$nData1["Invoice"] = $u->invoice_number;
						$nData1["Item_Code"] = $sap;
						$nData1["Item_name"] = $pdata1->product_name." ".$op1->category;
						$nData1["Quantity"] = $op1->qty;
						$nData1["UOM"] =  "EA";
						$nData1["orderDate"] = date("Y-m-d",strtotime($sd->delivery_date));
						$nData1["Name"] = $udata->user_name;
						$nData1["Number"] = $udata->user_mobile;
						$nData1["Orderid"] =  $u->order_id;
						$nData1["ordertype"] =  $u->order_type;
						$nData1["shift"] =  $u->deliveryShift;
						$nData1["Amount"] =  $nAmt1;
						$nData1["SGST"] = $gst1;
						$nData1["CGST"] = $gst1;
						$nData1["SGST_amount"] = $gstAmount1 / 2;
						$nData1["CGST_amount"] = $gstAmount1 / 2;
						$nData1["TotalAmount"] = $nAmt1 + $gstAmount1;
						$jsonData[] = $nData1;

					  $id++;
				  
			  }
		   }
		 }
	   }elseif($u->order_type == "deliveryonce"){
	
		   if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) >= strtotime($sdate) && (strtotime(date("Y-m-d",strtotime($u->deliverydate))) <= strtotime($edate))){
			   
  		   if($u->order_status == "Success"){
		   
			   foreach($orderproducts as $op){

				  $gst = ($op->orderRef == "offer") ? 0 : $op->gst/2;
				  $oref = ($op->orderRef == "offer") ? ' (Free)' : '';
				  
				  $gstAmount = ($op->orderRef == "offer") ? 0 : $this->admin->gst_total(($op->price * $op->qty),$op->gst);
                  $nAmt = ($op->price * $op->qty) -$gstAmount; 
				   
				  if(json_decode($op->product_data)){
				   
					   $pdata = json_decode($op->product_data);

				   }else{

					  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row(); 

				   } 


				 $pqty = json_decode($pdata->product_quantity); 

				  foreach($pqty->quantity as $key => $qqty){

					  if($op->category == $qqty){

						$sap = $pqty->sap[$key];

					  }

				  } 

					$nData = array();
					$nData["sno"] = $id;
					$nData["Invoice"] = $u->invoice_number;
					$nData["Item_Code"] = $sap;
					$nData["Item_name"] = $pdata->product_name." ".$op->category.$oref;
					$nData["Quantity"] = $op->qty;
					$nData["UOM"] =  "EA";
					$nData["orderDate"] = date("Y-m-d",strtotime($u->deliverydate));
					$nData["Name"] = $udata->user_name;
					$nData["Number"] = $udata->user_mobile;
					$nData["Orderid"] =  $u->order_id;
					$nData["ordertype"] =  $u->order_type;
					$nData["shift"] =  $u->deliveryShift;
					$nData["Amount"] =  $nAmt;
					$nData["SGST"] = $gst;
					$nData["CGST"] = $gst;
					$nData["SGST_amount"] = $gstAmount / 2;
					$nData["CGST_amount"] = $gstAmount / 2;
					$nData["TotalAmount"] = $nAmt + $gstAmount;
					$jsonData[] = $nData;

				   $id++;
			   }
		   }
			   
		}
	}else{
		   
	  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) >= strtotime($sdate) && (strtotime(date("Y-m-d",strtotime($u->deliverydate))) <= strtotime($edate))){			
	 	   
//  		 if($u->order_status == "Success"){
			 
		   if(json_decode($u->product_data)){
				   
			   $pdata = json_decode($u->product_data);

		   }else{

			  $pdata = $this->db->get_where("tbl_products",array("id"=>$u->product_id))->row(); 

		   } 
		  
		   $pqty = json_decode($pdata->product_quantity); 
			   
			  foreach($pqty->quantity as $key => $qqty){
				 
				  if($u->qty == $qqty){
				  
				  	$sap = $pqty->sap[$key];
					  
				  }
				  
			  } 
		   
		   		$nData2 = array();
				$nData2["sno"] = $id;
				$nData2["Invoice"] = $u->invoice_number;
				$nData2["Item_Code"] = $sap;
		  		$nData2["Item_name"] = $pdata->product_name." ".$u->qty;
				$nData2["Quantity"] = 1;
				$nData2["UOM"] =  "EA";
				$nData2["orderDate"] = date("Y-m-d",strtotime($u->deliverydate));
				$nData2["Name"] = $udata->user_name;
				$nData2["Number"] = $udata->user_mobile;
				$nData2["Orderid"] =  $u->order_id;
				$nData2["ordertype"] =  $u->order_type;
				$nData2["shift"] =  $u->deliveryShift;
				$nData2["Amount"] =  0;
				$nData2["SGST"] = 0;
				$nData2["CGST"] = 0;
				$nData2["SGST_amount"] = 0;
				$nData2["CGST_amount"] = 0;
				$nData2["TotalAmount"] = 0;
				$jsonData[] = $nData2; 
		   $id++;
		 }
	   }
	
//	}
	
	}
	
	
//	echo '<pre>';
//	
//	print_r($jsonData);
//	
//	echo '</pre>';
		
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);
	
}	
	
public function allOrders(){
	
	$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,date_of_order,deliveryShift,assigned_to,id,deliveryonce_date as deliverydate from orders where payment_status='Success' and order_status='Success' order by id desc")->result();
		
	$fsorders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,id,order_type,assigned_to,delivery_date as deliverydate,order_date as date_of_order,deliveryShift from tbl_free_sample_orders where order_status='Success' order by id desc")->result();
		
	$data = array_merge($orders,$fsorders);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();
		
	   $ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
	   $uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;

	   $area = isset($uarea) ? $uarea : $udata->areanotlisted;
				
		
	   if($u->assigned_to != ""){

			$aname = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name; 

		}else{

			$aname = "Not Assigned";
		}	
		
		
	   if($u->order_type == "subscribe"){
		   
		 $sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u->order_id,"pause_status"=>"Inactive"))->result();
		   
		 foreach($sdata as $sd){
			 

			 
			 	if($sd->delivered_by != 0 && $sd->deliver_status == "Success"){

					$dbname = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$sd->delivered_by))->row()->name; 

				}else{

					$dbname = "";
				}
			 

				if($sd->deliver_status == "Success"){

					$sstatus = '<span class="badge badge-success" style="color:white">Success</span>';
				}elseif($sd->deliver_status == "Pending"){

					$sstatus = '<span class="badge badge-warning" style="color:white">Pending</span>';
				}else{
					$sstatus = $sd->deliver_status;
				}

				$nData1 = array();
				$nData1["sno"] = $id;
				$nData1["Date"] = date("Y-m-d",strtotime($u->date_of_order));
				$nData1["Order_ID"] = $sd->order_id;
				$nData1["Name"] = $udata->user_name;
				$nData1["Mobile"] =  $udata->user_mobile;
				$nData1["Address"] = nl2br($u->shipping_address);
				$nData1["cAddress"] = $udata->house_no."<br>".$udata->landmark."<br>".$udata->user_current_address."<br>".$area."<br>".$ucity;
				$nData1["Delivery_Date"] = date("Y-m-d",strtotime($sd->delivery_date));
				$nData1["Type_of_Order"] =  $u->order_type;
				$nData1["shift"] =  $u->deliveryShift;
				$nData1["Assigned_To"] =  $aname;
				$nData1["deliveredBy"] =  $dbname;
				$nData1["Status"] = $sstatus;
				$jsonData[] = $nData1;

				$id++;
			 
			 
		 }  
		   
		   
	   }else{
		    
		
		    if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = $u->delivery_status;
			}
		   
		    if($u->assigned_to != 0 && $u->delivery_status == "Success"){

				$ddbname = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name; 

			}else{

				$ddbname = "";
			}
		    
		   
			$nData = array();
			$nData["sno"] = $id;
			$nData["Date"] = date("Y-m-d",strtotime($u->date_of_order));
			$nData["Order_ID"] = $u->order_id;
			$nData["Name"] = $udata->user_name;
			$nData["Mobile"] =  $udata->user_mobile;
			$nData["Address"] = nl2br($u->shipping_address);
			$nData["cAddress"] = $udata->house_no."<br>".$udata->landmark."<br>".$udata->user_current_address."<br>".$area."<br>".$ucity;
			$nData["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData["Type_of_Order"] =  $u->order_type;
			$nData["shift"] =  $u->deliveryShift;
			$nData["Assigned_To"] =  $aname;
			$nData["deliveredBy"] =  $ddbname;
			$nData["Status"] = $status;
			$jsonData[] = $nData;

			$id++;
	}}
	
	
//	echo '<pre>';
//	
//	print_r($jsonData);
//	
//	echo '</pre>';
		
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);
	
}	
	
public function filterallOrders(){
	
	$sdate = $this->input->post("sdate");
	$edate = $this->input->post("edate");
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");
	
	$data = $this->getOrders($sdate,$edate,$shift,$city);

	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
//		echo ($u->date_of_order).'<br>';
		
	if(json_decode($u->user_data)){
											   
	   $udata = json_decode($u->user_data);

   }else{

	  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   

   }		
//	   $ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
//	   $uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;
//
//	   $area = isset($uarea) ? $uarea : $udata->areanotlisted;
		
		
	   if($u->assigned_to != ""){

			$aname = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name; 

		}else{

			$aname = "Not Assigned";
		}	
		
		
	   if($u->order_type == "subscribe"){
		   
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		 $endate = date("Y-m-d",strtotime($edate));
		
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive'and deliver_status!='Cancelled' and delivery_date between '$stdate' and '$endate'")->result();
		   
		 foreach($sdata as $sd){
			 
			 	if($sd->delivered_by != 0 && $sd->deliver_status == "Success"){

					$dbname = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$sd->delivered_by))->row()->name; 

				}else{

					$dbname = "";
				}	

				if($sd->deliver_status == "Success"){

					$sstatus = '<span class="badge badge-success" style="color:white">Success</span>';
				}elseif($sd->deliver_status == "Pending"){

					$sstatus = '<span class="badge badge-warning" style="color:white">Pending</span>';
				}else{
					$sstatus = $sd->deliver_status;
				}

				$nData1 = array();
				$nData1["sno"] = $id;
				$nData1["Date"] = date("Y-m-d",strtotime($u->date_of_order));
				$nData1["Order_ID"] = $sd->order_id;
				$nData1["Name"] = $udata->user_name;
				$nData1["Mobile"] =  $udata->user_mobile;
				$nData1["Address"] = nl2br($u->shipping_address);
				$nData1["cAddress"] = $udata->user_current_address;
				$nData1["Delivery_Date"] = date("Y-m-d",strtotime($sd->delivery_date));
				$nData1["Type_of_Order"] =  $u->order_type;
				$nData1["shift"] =  $u->deliveryShift;
				$nData1["Assigned_To"] =  $aname;
				$nData1["deliveredBy"] =  $dbname;
				$nData1["Status"] = $sstatus;
				$jsonData[] = $nData1;

				$id++;
			 
			 
		 }  
		   
		   
	   }else{
		    
		   
		  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) >= strtotime($sdate) && (strtotime(date("Y-m-d",strtotime($u->deliverydate))) <= strtotime($edate))){ 
			  
  		   if($u->order_status == "Success"){
		
		    if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = $u->delivery_status;
			}
			  
			if($u->assigned_to != 0 && $u->delivery_status == "Success"){

				$ddbname = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name; 

			}else{

				$ddbname = "";
			}  
		   
			$nData = array();
			$nData["sno"] = $id;
			$nData["Date"] = date("Y-m-d",strtotime($u->date_of_order));
			$nData["Order_ID"] = $u->order_id;
			$nData["Name"] = $udata->user_name;
			$nData["Mobile"] =  $udata->user_mobile;
			$nData["Address"] = nl2br($u->shipping_address);
			$nData["cAddress"] = $udata->house_no."<br>".$udata->landmark."<br>".$udata->user_current_address."<br>".$area."<br>".$ucity;
			$nData["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData["Type_of_Order"] =  $u->order_type;
			$nData["shift"] =  $u->deliveryShift;
			$nData["Assigned_To"] =  $aname;
			$nData["deliveredBy"] =  $ddbname;
			$nData["Status"] = $status;
			$jsonData[] = $nData;

			$id++;
			   
		   }
	}
	}
	}
	
//	echo '<pre>';
//	
//	print_r($jsonData);
//	
//	echo '</pre>';
		
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);
	
}	

public function cancelledOrders()
	{
		
		$orders = $this->db->query("select * from orders where order_status='Cancelled'")->result();
		$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Cancelled'")->result();
		
		$data["doo"] = array_merge($orders,$fsorders);
		$this->load->view('orders/admin/cancelledOrders',$data);
	}
	
public function deliverableQuantity()
	{
//		$data["doo"] = $this->db->query("select * from orders where order_status='Cancelled'")->result();
		$this->load->view('orders/deliverableQuantity');
	}	
	
public function getQuantities(){
		
		$date = $this->input->post("date");
		
		
		$products = $this->db->get_where("tbl_products",array("assigned_to"=>"consumers"))->result();
	
//		foreach($products as $key => $pro){
			
		$orders = $this->db->query("SELECT * from orders join order_products on orders.order_id=order_products.order_id WHERE payment_status='Success' and order_status='Success'")->result();
	
//		echo '<pre>';
//	
//		print_r($orders);
//	
//		echo '</pre>';
	
		$dpdata = array();
		$dqty = array();
	
	
			foreach($orders as $o){

				if($o->order_type == "deliveryonce"){
				
					if(strtotime($date) == strtotime($o->deliveryonce_date)){
					
						$dpdata[] = $o->product_id;
						
//						foreach($dpdata as $ip){
//							
//							if($ip == $o->product_id){
//								
//								
//							}
//							
//						}
						
						
//						$opdata = $this->db->query("select * from order_products where order_id='$o->order_id' and product_id='$pro->id' order by delivery_date desc")->result();
						
//						
//							foreach($opdata as $oval){
//							
//								
//								$dpdata = $oval->product_id;
//								
//								$str1 = $oval->category;
//								$qty = (int) filter_var($str1, FILTER_SANITIZE_NUMBER_INT);
//								
//								if($qty != ""){
//									$dqty[] = $qty;
//								
//									echo $qty;
//								}
//								
//								
//							}
						
							
					}
				}
			}
	
	
	print_r($dpdata);
	
	foreach($orders as $op){
	
						if(strtotime($date) == strtotime($op->deliveryonce_date)){
	
		
		if(in_array($op->product_id,$dpdata)){
							
							
			echo $op->product_id;

		}
						}
	}
	
	
			
//		}
			
	
		
		
		
		
		
		
		
		
		
		
		
//		$pname = array();
//		$pqty = array();
//		
//		$orders = $this->db->query("select * from orders where payment_status='Success' and order_status='Success'")->result();
//
//		$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success'")->result();
//		
//		
//		foreach($orders as $o){
//			
//			if($o->order_type == "deliveryonce"){
//				
//				
//				if(strtotime($date) == strtotime($o->deliveryonce_date)){
//					
//					$opdata = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result();
//					
//					foreach($opdata as $op){
//						
//						$oppdata = $this->db->where("order_id",$o->order_id)->get("order_products")->result();
//						
//						
//						
//						echo json_encode($oppdata);
//						
//						exit();
//						
//						$dtotal = 0;
//						
//						$dId = 0;
//						
//						foreach($oppdata as $key => $od){
//							
//							$str1 = $op->category;
//							$qty = (int) filter_var($str1, FILTER_SANITIZE_NUMBER_INT);
//							
//							if($dId == $key){
//								
//								
//								$dtotal +=  $qty;
//								
////								echo $dtotal."<br>";
//							}
//							
//
//							break;
//							
//						}
//						echo $dtotal;
//						
//						
//						$str1 = $op->category;
//						$qty = (int) filter_var($str1, FILTER_SANITIZE_NUMBER_INT);
//						$pname[] = $op->product_id;	
//						$pqty[] = $qty;
//						
//					}
//					
//				}
//			
//			}
////			elseif($o->order_type == "subscribe"){
////				
////				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive"))->result();
////				
////				foreach($sdata as $sd){
////					
////					if(strtotime($date) == strtotime($sd->delivery_date)){
////						
////						$opdata1 = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result();
////					
////					
////						foreach($opdata1 as $op1){
////							
////						$oppdata1 = $this->db->group_by("$op1->product_id")->where("order_id",$o->order_id)->get("order_products")->result();
////						
////						$stotal = 0;
////							
////						foreach($oppdata1 as $os){
////							
////							$str = $os->category;
////							$qty1 = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
////
////							$stotal = $stotal + $qty1;
////							
////						}
////							$str = $op1->category;
////							$qty1 = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
////						
//////							$pname[] = $op1->product_id;	
//////							$pqty[] = $qty1;
////							
////						}
////						
////					}
////					
////				}
////				
////			}
//			
//			
//			
//		}
//		
//		
////		foreach($fsorders as $fs){
////					
////			if(strtotime($date) == strtotime($fs->delivery_date)){
////				
////				$fsdata1 = $this->db->group_by("$fs->product_id")->get("tbl_free_sample_orders")->result();
////						
////						$fstotal = 0;
////							
////						foreach($fsdata1 as $fss){
////							
////							$str2 = $fss->category;
////							$qty2 = (int) filter_var($str2, FILTER_SANITIZE_NUMBER_INT);
////
////							$fstotal = $fstotal + $qty2;
////							
////						}
////				
////				$str2 = $fs->qty;
////				$qty = (int) filter_var($str2, FILTER_SANITIZE_NUMBER_INT);
////
////			
//////				$pname[] = $fs->product_id;	
//////				$pqty[] = $qty;
////				
////			}
////			
////		}
////		
////		$data = array("pid"=>$pname,"qty"=>$pqty);
//		
////		$d = (array_search("2",$pname));
////		
////		print_r($d);
//		
////		$qTotal = 0;
//		
////		foreach($data["pid"] as $key => $val){
////			
////			if($value = $val){
////				
////				$qTotal = $qTotal + $data["qty"][$key];
////		
////				echo $qTotal."<br>";
////			}
////			
////		}
//		
//		
////	echo $dtotal." , ".$stotal." , ".$fstotal;
//		
//		
//echo $dtotal;		
//				
//		exit();
////		$data["qty"] = 
//		
//		$this->load->view('orders/deliverableQuantity');
	}
	
	
public function allProductquantity(){
	
//$aid = $this->session->userdata("admin_id");
$date = $this->input->post("sdate");
//$shift = $this->input->post("shift");

 $products = $this->db->where_in("assigned_to",["consumers","freeProduct"])->get("tbl_products")->result_array();
 $i = 0;
 $data = [];
    foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->get_success_orders($row1['id'],$value);
			
			if($packets["pqty"] != 0){
			
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets["pqty"];
				$new['uom'] = "EA";
				$new['productType'] = "Paid";
				$data[$i] = $new;
				$i++;
			}
    	}

	}
	
	foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->getfiltered_success_orders($date,$shift,$row1['id'],$value,$city,$agent_id);
			
			if($packets["offerpqty"] != 0){
				
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets["offerpqty"];
				$new['uom'] = "EA";
				$new['productType'] = "Offer";
				$data[$i] = $new;
				$i++;
			}
			
    	}

	}
	
	
	foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->getfiltered_success_orders($date,$shift,$row1['id'],$value,$city,$agent_id);
			
			if($packets["freepqty"] != 0){
				
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets["freepqty"];
				$new['uom'] = "EA";
				$new['productType'] = "Free";
				$data[$i] = $new;
				$i++;
			}
			
    	}

	}
	$data_final = $this->final_consolidate($data);
	
	
	$results = ["sEcho" => 1,"iTotalRecords" => count($data_final),"iTotalDisplayRecords" => count($data_final),"aaData" => $data_final ];
	echo json_encode($results);	

	

//return array("status"=>true,"data"=>$data_final);
}	

public function get_success_orders($pid,$cat){
	
	$date = date("d-m-Y");
	
	$this->db->select('order_id,order_type,order_status,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","deliveryonce");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
	$this->db->where('deliveryonce_date', date("d-m-Y",strtotime($date)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$dorders = $this->db->get()->result();

// subscription orders
	
	$this->db->select('order_id,order_type,sub_start_date,order_status,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","subscribe");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
	$this->db->where("sdate <='".date("Y-m-d",strtotime($date))."' AND edate >= '".date("Y-m-d",strtotime($date))."'");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$sorders = $this->db->get()->result();		
	
	$this->db->select('delivery_date');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	$this->db->where("product_id",$pid);
	$this->db->where("qty",$cat);
	
	if($shift != ""){
		$this->db->where("deliveryShift",$shift);
	}
	if($city != ""){
		$this->db->where("location",$city);
	}
	if($agent_id != ""){
	    $this->db->where_in("assigned_to",$agent_id);
	}
	
	$resutset1 = $this->db->get();
	
	$fsorders = $resutset1->result();		

	
	
//	$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success' and product_id='$pid' and qty='$cat'")->result();
	
	$orders = array_merge($dorders,$sorders);
	
	$pqty = [];
	$offerpqty= [];
	$freepqty= [];
	foreach($orders as $o){
		
//		echo $o->deliveryonce_date;
			
			if($o->order_type == "deliveryonce"){
				
				if($o->order_status == "Success"){
				
					if(strtotime($date) == strtotime($o->deliveryonce_date)){
						$opdata = $this->db->where(array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->get("order_products")->result();
						foreach($opdata as $op){

							if($op->orderRef == "offer"){
                                $offerpqty[] = $op->qty;
                            }else{
							    $pqty[] = $op->qty;
                            }

						}

					}
				}
				
			}elseif($o->order_type == "subscribe"){
				
				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive","deliver_status !="=>"Cancelled","delivery_date"=>date("Y-m-d",strtotime($date))))->row();
				
				$oop = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat,"orderRef"=>"offer"))->row();
					
				if(strtotime($date) == strtotime($o->sub_start_date) && $oop){
					$offerpqty[] = $oop->qty;
				}
				
				// foreach($sdata as $sd){
					
					if($sdata){
						
						$opdata1 = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->row();
					
					
//						foreach($opdata1 as $op1){
							
							if($opdata1->orderRef != "offer"){
							
								$pqty[] = $opdata1->qty;
							
//							}
						}
						
					}
				
			}
			
		}
	
	    foreach($fsorders as $fs){
			
			if(date("Y-m-d",strtotime($date)) == date("Y-m-d",strtotime($fs->delivery_date))){

				  $freepqty[] = 1;

			}

		}
	    
    return ["pqty"=>array_sum($pqty),"offerpqty"=>array_sum($offerpqty),"freepqty"=>array_sum($freepqty)];
    
}

public function filterProductquantity(){
	
$date = $this->input->post("sdate");
$shift = $this->input->post("shift");
$city = $this->input->post("city");
$agent_id = $this->input->post("agent_id");

 $products = $this->db->where_in("assigned_to",["consumers","freeProduct"])->get("tbl_products")->result_array();
 $i = 0;
 $data = [];
    foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->getfiltered_success_orders($date,$shift,$row1['id'],$value,$city,$agent_id);
			
			if($packets["pqty"] != 0){
				
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets["pqty"];
				$new['uom'] = "EA";
				$new['productType'] = "Paid";
				$data[$i] = $new;
				$i++;
			}
			
    	}

	}
	
	
	foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->getfiltered_success_orders($date,$shift,$row1['id'],$value,$city,$agent_id);
			
			if($packets["offerpqty"] != 0){
				
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets["offerpqty"];
				$new['uom'] = "EA";
				$new['productType'] = "Offer";
				$data[$i] = $new;
				$i++;
			}
			
    	}

	}	    
		
	foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->getfiltered_success_orders($date,$shift,$row1['id'],$value,$city,$agent_id);
			
			if($packets["freepqty"] != 0){
				
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets["freepqty"];
				$new['uom'] = "EA";
				$new['productType'] = "Free";
				$data[$i] = $new;
				$i++;
			}
			
    	}

	}        
        
	
	$data_final = $this->final_consolidate($data);
	
	
	$results = ["sEcho" => 1,"iTotalRecords" => count($data_final),"iTotalDisplayRecords" => count($data_final),"aaData" => $data_final ];
	echo json_encode($results);	

	

//return array("status"=>true,"data"=>$data_final);
}	

public function getfiltered_success_orders($date,$shift,$pid,$cat,$city,$agent_id=""){
	$this->db->select('order_id,order_type,order_status,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","deliveryonce");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
	$this->db->where('deliveryonce_date', date("d-m-Y",strtotime($date)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	if($agent_id != ""){
	    $this->db->where_in("assigned_to",$agent_id);
	}
	
	$dorders = $this->db->get()->result();

// subscription orders
	
	$this->db->select('order_id,order_type,sub_start_date,order_status,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","subscribe");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
	$this->db->where("sdate <='".date("Y-m-d",strtotime($date))."' AND edate >= '".date("Y-m-d",strtotime($date))."'");
	
	if($shift != ""){
		$this->db->where("deliveryShift",$shift);
	}
	if($city != ""){
		$this->db->where("location",$city);
	}
	if($agent_id != ""){
	    $this->db->where_in("assigned_to",$agent_id);
	}
	
	$sorders = $this->db->get()->result();		
	
	$this->db->select('delivery_date');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	$this->db->where("product_id",$pid);
	$this->db->where("qty",$cat);
	
	
	if($shift != ""){
		$this->db->where("deliveryShift",$shift);
	}
	if($agent_id != ""){
	    $this->db->where_in("assigned_to",$agent_id);
	}
	if($city != ""){
		$this->db->where("location",$city);
	}
	$resutset1 = $this->db->get();
	$fsorders = $resutset1->result();		

	$orders = array_merge($dorders,$sorders);
	
	$pqty = [];
	$offerpqty = [];
	$freepqty = [];
	foreach($orders as $o){
		
//		echo $o->deliveryonce_date;
			
			if($o->order_type == "deliveryonce"){
				
				if($o->order_status == "Success"){
					
					if(strtotime($date) == strtotime($o->deliveryonce_date)){
						$opdata = $this->db->where(array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->get("order_products")->result();
						foreach($opdata as $op){
                            
                            if($op->orderRef == "offer"){
                                $offerpqty[] = $op->qty;
                            }else{
							    $pqty[] = $op->qty;
                            }
                            
						}

					}
				}
				
			}elseif($o->order_type == "subscribe"){
				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive","deliver_status !="=>"Cancelled","delivery_date"=>date("Y-m-d",strtotime($date))))->row();
				
				$oop = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat,"orderRef"=>"offer"))->row();
					
				if(strtotime($date) == strtotime($o->sub_start_date) && $oop){
					$offerpqty[] = $oop->qty;
				}
				
				// foreach($sdata as $sd){
					
					if($sdata){
						
						$opdata1 = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->row();
					
					
//						foreach($opdata1 as $op1){
							
							if($opdata1->orderRef != "offer"){
							
								$pqty[] = $opdata1->qty;
							
//							}
						}
						
					}
					
				// }
				//$pqty[] = $o;
				
			}
			
		}
	   
	    foreach($fsorders as $fs){
			
			if(date("Y-m-d",strtotime($date)) == date("Y-m-d",strtotime($fs->delivery_date))){
				$freepqty[] = 1;
			}
				
		}
	    
		return ["pqty"=>array_sum($pqty),"offerpqty"=>array_sum($offerpqty),"freepqty"=>array_sum($freepqty)];
}
	
public function final_consolidate($data){
	$i = 0;
	$array = [];
	foreach ($data as $row) {
		if($row['sap_code']!=""){
			$array[]=$row;
		}else{

		}
		//$i++;
	}
	return $array;
}	
	
	
	
//
//public function filterProductquantity(){
//	
//	$sdate = $this->input->post("sdate");
//	$edate = $this->input->post("edate");
//	$shift = $this->input->post("shift");
//	
////	$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,date_of_order,assigned_to,id,invoice_number,deliveryonce_date as deliverydate from orders where payment_status='Success' and order_status='Success' order by id desc")->result();
//		
//	$this->db->select('order_id,user_id,shipping_address,delivery_status,order_type,deliveryShift,assigned_to,deliveryonce_date as deliverydate,date_of_order');
//	$this->db->from('orders');
//	$this->db->where("payment_status","Success");
//	$this->db->where("order_status","Success");
//	
//	if($shift != ""){
//		
//		$this->db->where("deliveryShift",$shift);
//		
//	}
//	
//	$resutset = $this->db->get();
//	
//	$orders = $resutset->result();		
//	$fsorders = $this->db->query("select order_id,user_id,product_id,qty,shipping_address,delivery_status,id,order_type,assigned_to,delivery_date as deliverydate,order_date as date_of_order from tbl_free_sample_orders where order_status='Success' order by id desc")->result();
//		
//	$data = array_merge($orders,$fsorders);	
//	
//	$jsonData = array();
//	
//	$id = 1;
//	
//	foreach($data as $u){
//		
//	   $orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
//		
//	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	
//		
//	   if($u->order_type == "subscribe"){
//		   
//		 $stdate = date("Y-m-d",strtotime($sdate));
//		 $endate = date("Y-m-d",strtotime($edate));
//		   
//		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date between '$stdate' and '$endate'")->result();
//		   
//		 foreach($sdata as $sd){
//			 
//
//		   foreach($orderproducts as $op1){
//			   
//			    $str = $op1->category;
//							
//				$qtyMea = preg_replace('!\d+!', '', $str);
//
//				$qM = str_replace(" ","",$qtyMea);
//
//
//				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
//
//
//				$lMint = $int * $op1->qty;
//
//		   
//			  $pdata1 = $this->db->get_where("tbl_products",array("id"=>$op1->product_id,"assigned_to"=>"consumers"))->row(); 
//			   
//		   		$nData1 = array();
//				$nData1["sno"] = $id;
//				$nData1["product_id"] = $op1->product_id;
//				$nData1["Item_Code"] = $pdata1->product_id;
//				$nData1["Item_name"] = $pdata1->product_name;
//				$nData1["Quantity"] = $lMint;
//				$nData1["qm"] = $qM;
////				$nData1["UOM"] =  $tQty;
//				$nData1["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
//				
//				$jsonData[] = $nData1;
//			   
//			  $id++; 
//		   }
//		 }
//	   }elseif($u->order_type == "deliveryonce"){
//		   
//		  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) >= strtotime($sdate) && (strtotime(date("Y-m-d",strtotime($u->deliverydate))) <= strtotime($edate))){ 
//		   
//		   foreach($orderproducts as $op){
//			   
//$str = $op->category;
//							
//				$qtyMea = preg_replace('!\d+!', '', $str);
//
//				$qM = str_replace(" ","",$qtyMea);
//
//
//				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
//
//
//				$lMint = $int * $op->qty;
//
//			  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"assigned_to"=>"consumers"))->row(); 
//			   
//		   		$nData = array();
//				$nData["sno"] = $id;
//				$nData["product_id"] = $op->product_id;
//				$nData["Item_Code"] = $pdata->product_id;
//				$nData["Item_name"] = $pdata->product_name;
//				$nData["Quantity"] = $lMint;
//				$nData["qm"] = $qM;
////				$nData["UOM"] =  $tQty;
//				$nData["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
//				$jsonData[] = $nData;
//			   
//			   $id++;
//		   }
//		  }
//			
//	}else{
//		   
//		  if(strtotime(date("Y-m-d",strtotime($u->deliverydate))) >= strtotime($sdate) && (strtotime(date("Y-m-d",strtotime($u->deliverydate))) <= strtotime($edate))){ 
//		   
//		  $str = $u->qty;
//							
//				$qtyMea = preg_replace('!\d+!', '', $str);
//
//				$qM = str_replace(" ","",$qtyMea);
//
//
//				$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
//
//
//				$lMint = $int * 1;
//
//		  
//		  $pdata = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row(); 
//			   
//		   		$nData2 = array();
//				$nData2["sno"] = $id;
//				$nData2["product_id"] = $pdata->id;
//				$nData2["Item_Code"] = $pdata->product_id;
//				$nData2["Item_name"] = $pdata->product_name;
//				$nData2["Quantity"] = $lMint;
//				$nData2["qm"] = $qM;
//				$nData2["UOM"] =  "EA";
//				$nData2["deliveryDate"] = date("Y-m-d",strtotime($u->date_of_order));
//				
//				$jsonData[] = $nData2; 
//		   $id++;
//		   
//	   }
//	   
//	}
//	
//	
//	}
//	
//	$oresult = array();
//	foreach($jsonData as $k => $v) {
//		$id = $v['product_id'];
//		$oresult[$id][] = $v['Quantity'];
//	}
//	
//	$result = array();
//	foreach($jsonData as $k => $v) {
//		$id = $v['product_id'];
//		$qmid = "qm".$v['product_id'];
//		$result[$qmid][] = $v['qm'];
//		$result[$id][] = $v['Quantity'];
//	}
//	
//	
//	
//
//	$new = array();
//	
//	$id1 = 1;
//	
//	foreach($oresult as $key => $value) {
//		
//	  $pdata2 = $this->db->get_where("tbl_products",array("id"=>$key,"assigned_to"=>"consumers"))->row(); 
//
//		
//		$fqty = number_format(array_sum($value));
//
//		$tQty = round(str_replace(",",".",$fqty),2);
//		
//		
//		if($result["qm".$key][0] == "ML"){
//			
//			if(array_sum($value) >= 1000){
//				
//				$quantity = $tQty." L";
//				
//			}else{
//				
//				$quantity = $tQty." ML";
//				
//			}
//			
//		}else{
//			
//			if(array_sum($value) >= 1000){
//				
//				$quantity = $tQty." KG";
//				
//			}else{
//				
//				$quantity = $tQty." gm";
//				
//			}
//			
//		}
//		
//		if($pdata2->product_id != ""){
//		
//			$new[] = array(
//					'sno' => $id1,
//					'Item_Code' => $pdata2->product_id, 
//					'Item_name' => $pdata2->product_name,
//					'Quantity' => $quantity,
//					'UOM' => 'EA',
//			);
//		}
//		
//		$id1++;
//		
//	}
//	
//	
//	
////	echo '<pre>';
////	
////	print_r($new);
////	
////	echo '</pre>';
////	
////	exit();
//	
//	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $new ];
//	echo json_encode($results);	
//}	
//	
	
public function assignOrders(){
	
	$agent = $this->input->post("agent");
	$orderids = $this->input->post("orderids");
	
	foreach(json_decode($orderids) as $oid){
		
		$oChk = $this->db->get_where("orders",array("order_id"=>$oid->order_id))->num_rows();
		
		if($oChk == 1){
			
			$data = array("assigned_to"=>$agent);
		
			$this->db->set($data);
			$this->db->where("order_id",$oid->order_id);
			$qi = $this->db->update("orders");
			
		}else{
			
			$data = array("assigned_to"=>$agent);
		
			$this->db->set($data);
			$this->db->where("order_id",$oid->order_id);
			$qi = $this->db->update("tbl_free_sample_orders");
			
		}


	}
	
	if($qi){
		
			echo 1;
			$this->alert->pnotify("success","Order assigned to agent successfully","success");
//			redirect("faqs");
	}else{
			echo 0;
			$this->alert->pnotify("error","Error Occured please try again","error");
//			redirect("faqs");
	}
	
}
	
	
	
//  Agent Orders
	
public function agentOrders()
	{
		$aid = $this->session->userdata("admin_id");

		$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,deliveryonce_date as deliverydate from orders where assigned_to='$aid' and payment_status='Success' and order_status='Success'")->result();
		
		$fsorders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,delivery_date as deliverydate from tbl_free_sample_orders where assigned_to='$aid' and order_status='Success'")->result();
		
		
		$data["doo"] = array_merge($orders,$fsorders);
		
		$this->load->view('orders/agent/allActiveorders',$data);
	}
	
public function orders(){
	
	$aid = $this->session->userdata("admin_id");

	$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,deliveryonce_date as deliverydate from orders where assigned_to='$aid' and payment_status='Success' and order_status='Success'")->result();

	$fsorders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,delivery_date as deliverydate from tbl_free_sample_orders where assigned_to='$aid' and order_status='Success'")->result();
	
	$data = array_merge($orders,$fsorders);
	
   $i = 1;
	
   $aOrders = array();	

   $date = date("Y-m-d",strtotime("+1 day"));

   foreach ($data as $u) {

	if($u->order_type == "deliveryonce"){

		$ddate = date("Y-m-d",strtotime($u->deliverydate));

	}elseif($u->order_type == "freesample"){

		$ddate = date("Y-m-d",strtotime($u->deliverydate));

	}elseif($u->order_type == "subscribe"){

		$sdate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u->order_id,"delivery_date"=>$date,"pause_status"=>"Inactive"))->row();

		$ddate = date("Y-m-d",strtotime($sdate->delivery_date));


	}


	if($ddate == $date){   

		$udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   

		$opdata = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
		
		foreach($opdata as $op){

											   
		   $aOrders["product_name"] = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row()->product_name;

		}
		
		foreach($opdata as $op){
											   
		   $aOrders["quantity"] = $op->category."<br>";

		}
		
		
		$aOrders["order_id"] = $u->order_id;
		$aOrders["user_name"] = $udata->user_name;
		$aOrders["user_mobile"] = $udata->user_mobile;
		$aOrders["address"] = $u->shipping_address;
		$aOrders["delivery_date"] = $ddate;
		$aOrders["delivery_status"] = $sdate->deliver_status;
		
		
		$i++;
	
	}}		
	
	print_r($aOrders);
	
	
}	
	
	
public function viewdoOrder($id)
	{
		$aid = $this->session->userdata("admin_id");
		$data["doo"] = $this->db->query("select * from orders where payment_status='Success' and order_type='deliveryonce' and assigned_to=$aid and order_id = '$id' order by id desc")->row();
		$this->load->view('orders/agent/viewDeliveryonceorders',$data);
	}
	
public function updateDeliverystatus(){

	$aid = $this->session->userdata("admin_id");
	$oid = $this->input->post("oid");	
	$dstatus = $this->input->post("deliveryStatus");
//	$ostatus = $this->input->post("ostatus");
	$oType = $this->input->post("orderType");
	$sordid = $this->input->post("sordid");
	
//	if($dstatus == "other"){
//		
//		$status = $this->input->post("ostatus");
//		
//	}else{
//		
//		$status = $this->input->post("deliveryStatus");
//		
//	}

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
		
	$sdata = array("deliver_status"=>$dstatus,"delivered_by"=>$aid);
		
		$this->db->set($sdata);
		$this->db->where("id",$sordid);
		$u = $this->db->update("tbl_subscribed_deliveries");
		
	}
	
	
	if($u){

			$this->alert->pnotify("success","Delivery status updated successfully.","success");
			redirect("agent-orders/active-orders");
	}else{

			$this->alert->pnotify("error","Error Occured please try again.","error");
			redirect("agent-orders/active-orders");
	}
	
}	
	
public function test(){
	
	$data = $this->db->get_where("orders")->result();
	
	foreach($data as $d){
		
		$sdate = isset($d->sub_start_date) ? date("Y-m-d",strtotime($d->sub_start_date)) : '';
		$edate = isset($d->sub_end_date) ? date("Y-m-d",strtotime($d->sub_end_date)) : '';
		
		$this->db->where("id",$d->id)->update("orders",array("sdate"=>$sdate,"edate"=>$edate));
		
	}
	
	
}	
	
	
}
