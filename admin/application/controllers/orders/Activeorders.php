<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activeorders extends CI_Controller {

public function __construct(){
			
	parent::__construct();
	
    date_default_timezone_set('Asia/Kolkata');
 		
	$this->secure->loginCheck();
}
	
public function index()
	{
		$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,deliveryShift,assigned_to,user_data,deliveryonce_date as deliverydate from orders where payment_status='Success' and order_status='Success'")->result();
		
		$fsorders = $this->db->query("select order_id,user_id,user_data,shipping_address,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift from tbl_free_sample_orders where order_status='Success'")->result();
		
		
		$data["doo"] = array_merge($orders,$fsorders);
		$this->load->view('orders/admin/allActiveorders',$data);
	}
	
public function assignedOrders()
	{
		$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,deliveryShift,user_data,assigned_to,deliveryonce_date as deliverydate from orders where payment_status='Success' and order_status='Success'")->result();
		
		$fsorders = $this->db->query("select order_id,user_id,user_data,shipping_address,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift from tbl_free_sample_orders where order_status='Success'")->result();
		
		
		$data["doo"] = array_merge($orders,$fsorders);
		$this->load->view('orders/admin/assignedorders',$data);
	}	

public function cancelledOrders()
	{
		$orders = $this->db->query("select * from orders where order_status='Cancelled' order by id desc")->result();
		$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Cancelled' order by id desc")->result();
		
		$data["doo"] = array_merge($orders,$fsorders);
		$this->load->view('orders/admin/cancelledOrders',$data);
	}
	
public function filterallAssignedorders(){
	
	$sdate = $this->input->post("sdate");
	$edate = $this->input->post("edate");
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");
	
	
//	$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,deliveryShift,assigned_to,deliveryonce_date as deliverydate from orders where payment_status='Success' and order_status='Success'")->result();
		
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,user_data,order_type,deliveryShift,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_status","Success");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$resutset = $this->db->get();
	
	$orders = $resutset->result();
	
//	$fsorders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift from tbl_free_sample_orders where order_status='Success'")->result();
		
	$this->db->select('order_id,user_id,shipping_address,user_data,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$resutset1 = $this->db->get();
	
	$fsorders = $resutset1->result();	
	
		
	$data = array_merge($orders,$fsorders);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
	if($u->assigned_to != ""){	
		
	$orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
//	$udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();
//		
//	$ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
//	$uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;
//
//	$area = isset($uarea) ? $uarea : $udata->areanotlisted;

		
if(json_decode($u->user_data)){
											   
	   $udata = json_decode($u->user_data);

   }else{

	  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   

   }		

		
	if($u->order_type == "deliveryonce"){	
	
	   $fDelivery = strtotime($u->deliverydate) >= strtotime($sdate) && (strtotime($u->deliverydate) <= strtotime($edate));
		
	   if($fDelivery){
		   
		   if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData1 = array();
			$nData1["check"] = '<input class="checkbox selectbtn" type="checkbox" order_id="'.$u->order_id.'" style="zoom: 1.3">';
			$nData1["sno"] = $id;
			$nData1["Order_ID"] =  $u->order_id;
			$nData1["Name"] = $udata->user_name;
			$nData1["Mobile"] = $udata->user_mobile;
			$nData1["Address"] = nl2br($u->shipping_address);
			$nData1["cAddress"] = $udata->user_current_address;
			$nData1["orderType"] =  $u->order_type;
			$nData1["shift"] =$u->deliveryShift;
			$nData1["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData1["Status"] =$status;
		   
		   if($u->assigned_to != ""){
		   
			$nData1["Assigned_To"] = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name;
			   
		   }else{
			   
			$nData1["Assigned_To"] ='Not Assigned';
			   
		   }
			$jsonData[] = $nData1;

		  $id++; 
	   }
	 }elseif($u->order_type == "subscribe"){
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		 $endate = date("Y-m-d",strtotime($edate));
		
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date between '$stdate' and '$endate'")->result();
		   
		foreach($sdata as $sd){
			
		   $sstatus = isset($sd->deliver_status) ? $sd->deliver_status : ""; 
			if($sstatus == "Success"){

				$substatus = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($sstatus == "Pending"){

				$substatus = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$substatus = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}	
			
		
		   $nData = array();
			$nData["check"] = '<input class="checkbox selectbtn" type="checkbox" order_id="'.$u->order_id.'" style="zoom: 1.3">';
			$nData["sno"] = $id;
			$nData["Order_ID"] =  $u->order_id;
			$nData["Name"] = $udata->user_name;
			$nData["Mobile"] = $udata->user_mobile;
			$nData["Address"] = nl2br($u->shipping_address);
			$nData["cAddress"] = $udata->user_current_address;
			$nData["orderType"] =  $u->order_type;
			$nData["shift"] =$u->deliveryShift;
			$nData["Delivery_Date"] = date("Y-m-d",strtotime($sd->delivery_date));
			$nData["Status"] =$substatus;
		   
		   if($u->assigned_to != ""){
		   
			$nData["Assigned_To"] = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name;
			   
		   }else{
			   
			$nData["Assigned_To"] ='Not Assigned';
			   
		   }
			$jsonData[] = $nData;

		  $id++;
			   
		}
	}else{
		   
	   $fsDelivery = (strtotime($u->deliverydate) >= strtotime($sdate)) && (strtotime($u->deliverydate) <= strtotime($edate));
		
	   if($fsDelivery){
		
		    if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData2 = array();
			$nData2["check"] = '<input class="checkbox selectbtn" type="checkbox" order_id="'.$u->order_id.'" style="zoom: 1.3">';
			$nData2["sno"] = $id;
			$nData2["Order_ID"] =  $u->order_id;
			$nData2["Name"] = $udata->user_name;
			$nData2["Mobile"] = $udata->user_mobile;
			$nData2["Address"] = nl2br($u->shipping_address);
			$nData2["cAddress"] = $udata->user_current_address;
			$nData2["orderType"] =  $u->order_type;
			$nData2["shift"] =$u->deliveryShift;
			$nData2["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData2["Status"] =$status;
		   
		   if($u->assigned_to != ""){
		   
			$nData2["Assigned_To"] = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name;
			   
		   }else{
			   
			$nData2["Assigned_To"] ='Not Assigned';
			   
		   }
			$jsonData[] = $nData2;

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
	
public function filterallActiveorders(){
	
	$sdate = $this->input->post("sdate");
	$edate = $this->input->post("edate");
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,order_type,user_data,deliveryShift,location,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_status","Success");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$resutset = $this->db->get();
	
	$orders = $resutset->result();
	
//	$fsorders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift from tbl_free_sample_orders where order_status='Success'")->result();
		
		
	$this->db->select('order_id,user_id,shipping_address,user_data,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$resutset1 = $this->db->get();
	
	$fsorders = $resutset1->result();	

	
	$data = array_merge($orders,$fsorders);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
	if($u->assigned_to == ""){	
		
	$orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	
//	$udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();
		
	if(json_decode($u->user_data)){
											   
	   $udata = json_decode($u->user_data);

   }else{

	  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   

   }	
		
//	$ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
//	$uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;
//
//	$area = isset($uarea) ? $uarea : $udata->areanotlisted;
		
		
	if($u->order_type == "deliveryonce"){	
	
	   $fDelivery = strtotime($u->deliverydate) >= strtotime($sdate) && (strtotime($u->deliverydate) <= strtotime($edate));
		
	   if($fDelivery || ($city != "")){
		   
		   if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData1 = array();
			$nData1["check"] = '<input class="checkbox selectbtn" type="checkbox" order_id="'.$u->order_id.'" style="zoom: 1.3">';
			$nData1["sno"] = $id;
			$nData1["Order_ID"] =  $u->order_id;
			$nData1["Name"] = $udata->user_name;
			$nData1["Mobile"] = $udata->user_mobile;
			$nData1["Address"] = nl2br($u->shipping_address);
			$nData1["cAddress"] = $udata->user_current_address;
			$nData1["orderType"] =  $u->order_type;
			$nData1["shift"] =$u->deliveryShift;
			$nData1["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData1["Status"] =$status;
		   
		   if($u->assigned_to != ""){
		   
			$nData1["Assigned_To"] = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name;
			   
		   }else{
			   
			$nData1["Assigned_To"] ='Not Assigned';
			   
		   }
			$jsonData[] = $nData1;

		  $id++; 
	   }
	 }elseif($u->order_type == "subscribe"){
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		 $endate = date("Y-m-d",strtotime($edate));
		
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date between '$stdate' and '$endate'")->result();
		   
		foreach($sdata as $sd){
			
		   $sstatus = isset($sd->deliver_status) ? $sd->deliver_status : ""; 
			if($sstatus == "Success"){

				$substatus = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($sstatus == "Pending"){

				$substatus = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$substatus = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}	
			
		
		   $nData = array();
			$nData["check"] = '<input class="checkbox selectbtn" type="checkbox" order_id="'.$u->order_id.'" style="zoom: 1.3">';
			$nData["sno"] = $id;
			$nData["Order_ID"] =  $u->order_id;
			$nData["Name"] = $udata->user_name;
			$nData["Mobile"] = $udata->user_mobile;
			$nData["Address"] = nl2br($u->shipping_address);
			$nData["cAddress"] = $udata->user_current_address;
			$nData["orderType"] =  $u->order_type;
			$nData["shift"] =$u->deliveryShift;
			$nData["Delivery_Date"] = date("Y-m-d",strtotime($sd->delivery_date));
			$nData["Status"] =$substatus;
		   
		   if($u->assigned_to != ""){
		   
			$nData["Assigned_To"] = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name;
			   
		   }else{
			   
			$nData["Assigned_To"] ='Not Assigned';
			   
		   }
			$jsonData[] = $nData;

		  $id++;
			   
		}
	}else{
		   
	   $fsDelivery = (strtotime($u->deliverydate) >= strtotime($sdate)) && (strtotime($u->deliverydate) <= strtotime($edate));
		
	   if($fsDelivery){
		
		    if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData2 = array();
			$nData2["check"] = '<input class="checkbox selectbtn" type="checkbox" order_id="'.$u->order_id.'" style="zoom: 1.3">';
			$nData2["sno"] = $id;
			$nData2["Order_ID"] =  $u->order_id;
			$nData2["Name"] = $udata->user_name;
			$nData2["Mobile"] = $udata->user_mobile;
			$nData2["Address"] = nl2br($u->shipping_address);
			$nData2["cAddress"] = $udata->user_current_address;
			$nData2["orderType"] =  $u->order_type;
			$nData2["shift"] =$u->deliveryShift;
			$nData2["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData2["Status"] =$status;
		   
		   if($u->assigned_to != ""){
		   
			$nData2["Assigned_To"] = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name;
			   
		   }else{
			   
			$nData2["Assigned_To"] ='Not Assigned';
			   
		   }
			$jsonData[] = $nData2;

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
	
public function deliverableQuantity()
	{
//		$data["doo"] = $this->db->query("select * from orders where order_status='Cancelled'")->result();
		$this->load->view('orders/deliverableQuantity');
	}	
	
public function getQuantities()
	{
		$date = $this->input->post("date");
		
		$pname = array();
		$pqty = array();
		
		$orders = $this->db->query("select * from orders where payment_status='Success' and order_status='Success'")->result();

		$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success'")->result();
		
		
		foreach($orders as $o){
			
			if($o->order_type == "deliveryonce"){
				
				
				if(strtotime($date) == strtotime($o->deliveryonce_date)){
				
					$opdata = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result();
					
					
					foreach($opdata as $op){
						
						
						$str1 = $op->category;
						$qty = (int) filter_var($str1, FILTER_SANITIZE_NUMBER_INT);

						
						$pname[] = $op->product_id;	
						$pqty[] = $qty;
						
					}
					
				}
			
			}elseif($o->order_type == "subscribe"){
				
				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive"))->result();
				
				foreach($sdata as $sd){
					
					if(strtotime($date) == strtotime($sd->delivery_date)){
						
						$opdata1 = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result();
					
					
						foreach($opdata1 as $op1){
							
							
							$str = $op1->category;
							$qty1 = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
						
							$pname[] = $op1->product_id;	
							$pqty[] = $qty1;
							
						}
						
					}
					
				}
				
			}
			
			
			
		}
		
		
		foreach($fsorders as $fs){
					
			if(strtotime($date) == strtotime($fs->delivery_date)){
				
				$str2 = $fs->qty;
				$qty = (int) filter_var($str2, FILTER_SANITIZE_NUMBER_INT);

			
				$pname[] = $fs->product_id;	
				$pqty[] = $qty;
				
			}
			
		}
		
		$data = array("pid"=>$pname,"qty"=>$pqty);
		
//		$d = (array_search("2",$pname));
//		
//		print_r($d);
		
//		$qTotal = 0;
		
//		foreach($data["pid"] as $key => $val){
//			
//			if($value = $val){
//				
//				$qTotal = $qTotal + $data["qty"][$key];
//		
//				echo $qTotal."<br>";
//			}
//			
//		}
		
		
		$quantity = array();
		
		foreach($pname as $key => $val){
			
			$quantity[$val] = $pqty[$key];
			
		}
		
		
		print_r($quantity);
				
		exit();
//		$data["qty"] = 
		
		$this->load->view('orders/deliverableQuantity');
	}
	
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

		$orders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,deliveryShift,sub_start_date,user_data,order_type,deliveryonce_date as deliverydate from orders where assigned_to='$aid' and payment_status='Success' and order_status='Success' and delivery_status='Pending'")->result();
		
		$fsorders = $this->db->query("select order_id,user_id,shipping_address,delivery_status,order_type,product_id,qty,delivery_date as deliverydate,deliveryShift from tbl_free_sample_orders where assigned_to='$aid' and order_status='Success' and delivery_status='Pending'")->result();
		
		
		$data["doo"] = array_merge($orders,$fsorders);
		
		$this->load->view('orders/agent/allActiveorders',$data);
	}
	
public function agentDeliveredOrders()
	{
		$aid = $this->session->userdata("admin_id");

		$orders = $this->db->query("select order_id,user_id,shipping_address,sub_start_date,delivery_status,order_type,user_data,deliveryShift,deliveryonce_date as deliverydate from orders where assigned_to='$aid' and payment_status='Success' and order_status='Success'")->result();
		
		$fsorders = $this->db->query("select order_id,user_id,shipping_address,user_data,product_data,delivery_status,order_type,product_id,qty,delivery_date as deliverydate,deliveryShift from tbl_free_sample_orders where assigned_to='$aid' and order_status='Success' and delivery_status='Success'")->result();
		
		
		$data["doo"] = array_merge($orders,$fsorders);
		
		$this->load->view('orders/agent/allDeliveredorders',$data);
	}	
	
	
	
public function filterallDeliveredorders(){
	
	$aid = $this->session->userdata("admin_id");
	$sdate = $this->input->post("sdate");
//	$edate = $this->input->post("edate");
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");
	
	$data = $this->getOrders($sdate,$shift,$city);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
		
	$orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();
	$oop = $this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();
		
	$pname = array();	
	$pqty = array();	
		
	foreach($orderproducts as $op){
		
		if($op->orderRef != "offer"){ 
			
			if(json_decode($op->product_data)){
				   
				$pdata = json_decode($op->product_data);

			}else{

				$pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"assigned_to"=>"consumers"))->row();

			}

			$pname[] = $pdata->product_name." ".$op->category;

			$pqty[] = $op->qty;
			
		}
		
	}	
		
	if($oop->orderRef == "offer"){	

		if(json_decode($oop->product_data)){
				   
			$pdata1 = json_decode($oop->product_data);

		}else{

			$pdata1 = $this->db->get_where("tbl_products",array("id"=>$oop->product_id,"assigned_to"=>"consumers"))->row();

		}
		
		if(strtotime($sdate) == strtotime($u->sub_start_date) || $u->order_type == "deliveryonce"){

			$pname[] = $pdata1->product_name." ".$oop->category." (Free)";

			$pqty[] = $oop->qty;
		}
	}
		
	if(json_decode($u->user_data)){
											   
 	    $udata = json_decode($u->user_data);

    }else{

	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id))->row();	   

    }	
		
		
	if($u->order_type == "deliveryonce"){	
	
	   $fDelivery = ((strtotime($u->deliverydate) == strtotime($sdate)) && ($u->delivery_status=="Success"));
		
	   if($fDelivery){
		   
		   if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["Order_ID"] =  $u->order_id;
			$nData1["Name"] = $udata->user_name;
			$nData1["Mobile"] = $udata->user_mobile;
			$nData1["itemName"] = implode("<br>",$pname);
			$nData1["qty"] = implode("<br>",$pqty);
			$nData1["Address"] = nl2br($u->shipping_address);
			$nData1["cAddress"] = $udata->user_current_address;
			$nData1["orderType"] =  $u->order_type;
			$nData1["shift"] =$u->deliveryShift;
			$nData1["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData1["Status"] =$status;
		   
			$jsonData[] = $nData1;

		  $id++; 
	   }
	 }elseif($u->order_type == "subscribe"){
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date = '$stdate' and deliver_status='Success'")->result();
		   
		foreach($sdata as $sd){
			
		   $sstatus = isset($sd->deliver_status) ? $sd->deliver_status : ""; 
			if($sstatus == "Success"){

				$substatus = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($sstatus == "Pending"){

				$substatus = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$substatus = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}	
			
		
		   $nData = array();
			$nData["sno"] = $id;
			$nData["Order_ID"] =  $u->order_id;
			$nData["Name"] = $udata->user_name;
			$nData["Mobile"] = $udata->user_mobile;
			$nData["itemName"] = implode("<br>",$pname);
			$nData["qty"] = implode("<br>",$pqty);
			$nData["Address"] = nl2br($u->shipping_address);
			$nData["cAddress"] = $udata->user_current_address;
			$nData["orderType"] =  $u->order_type;
			$nData["shift"] =$u->deliveryShift;
			$nData["Delivery_Date"] = date("Y-m-d",strtotime($sd->delivery_date));
			$nData["Status"] =$substatus;
		   
			$jsonData[] = $nData;

		  $id++;
			   
		}
	}else{
		   
//		echo strtotime($u->deliverydate).",";
//		echo strtotime($sdate).",";
//		echo $u->delivery_status;
		
	   $fDelivery1 = ((strtotime($u->deliverydate) == strtotime($sdate)));
		
	   if((strtotime($u->deliverydate) == strtotime($sdate)) && ($u->delivery_status=="Success")){
		   
		    if(json_decode($u->product_data)){
				   
				$pd = json_decode($u->product_data);

			}else{

				$pd = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row();

			}
		   
		    if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData2 = array();
			$nData2["sno"] = $id;
			$nData2["Order_ID"] =  $u->order_id;
			$nData2["Name"] = $udata->user_name;
			$nData2["Mobile"] = $udata->user_mobile;
			$nData2["itemName"] = $pd->product_name;
			$nData2["qty"] = 1;
			$nData2["Address"] = nl2br($u->shipping_address);
			$nData2["cAddress"] = $udata->user_current_address;
			$nData2["orderType"] =  $u->order_type;
			$nData2["shift"] =$u->deliveryShift;
			$nData2["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData2["Status"] =$status;
		   
			$jsonData[] = $nData2;

		  $id++;  
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
	
	
public function getOrders($sdate,$shift,$city){
	
	$aid = $this->session->userdata("admin_id");
	
	
	// delivery once orders
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,user_data,order_type,deliveryShift,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","deliveryonce");
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
	$this->db->where('deliveryonce_date', date("d-m-Y",strtotime($sdate)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$dorders = $this->db->get()->result();

// subscription orders
	
	$this->db->select('order_id,user_id,shipping_address,delivery_status,order_type,user_data,deliveryShift,assigned_to,deliveryonce_date as deliverydate');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","subscribe");
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
	$this->db->where("sdate <='".date("Y-m-d",strtotime($sdate))."' AND edate >= '".date("Y-m-d",strtotime($sdate))."'");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$sorders = $this->db->get()->result();
	
	
	
// free sample orders 
	
	$this->db->select('order_id,user_id,shipping_address,user_data,product_data,product_id,delivery_status,order_type,assigned_to,delivery_date as deliverydate,deliveryShift,order_status');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	$this->db->where("assigned_to",$aid);
	
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
	
	
public function filterallagentActiveorders(){
	
	$aid = $this->session->userdata("admin_id");
	$sdate = $this->input->post("sdate");
//	$edate = $this->input->post("edate");
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");
		
	$data = $this->getOrders($sdate,$shift,$city);	
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
		
	$pname = array();	
	$pqty = array();	
		
	$orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();
	$oop = $this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();
		
		
	foreach($orderproducts as $op){
		
		if($op->orderRef != "offer"){
		
			if(json_decode($op->product_data)){
				   
				$pdata = json_decode($op->product_data);

			}else{

				$pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"assigned_to"=>"consumers"))->row();

			}
			
			$pname[] = $pdata->product_name." ".$op->category;

			$pqty[] = $op->qty;
			
		}
		
	}
	
	if($oop->orderRef == "offer"){	
		
		if(json_decode($oop->product_data)){
				   
			$pdata1 = json_decode($oop->product_data);

		}else{

			$pdata1 = $this->db->get_where("tbl_products",array("id"=>$oop->product_id,"assigned_to"=>"consumers"))->row();

		}
		
		if(strtotime($sdate) == strtotime($u->sub_start_date) || $u->order_type == "deliveryonce"){

			$pname[] = $pdata1->product_name." ".$oop->category." (Free)";

			$pqty[] = $oop->qty;
		}
	}
		
	if(json_decode($u->user_data)){
											   
 	    $udata = json_decode($u->user_data);

    }else{

	   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id))->row();	   

    }	
		
	if($u->order_type == "deliveryonce"){	
		
	
	   $fDelivery = ((strtotime($u->deliverydate) == strtotime($sdate)) && ($u->delivery_status=="Pending"));
		
//	   if($fDelivery){
		   
		   if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["Order_ID"] =  $u->order_id;
			$nData1["Name"] = $udata->user_name;
			$nData1["Mobile"] = $udata->user_mobile;
			$nData1["itemName"] = implode("<br>",$pname);
			$nData1["qty"] = implode("<br>",$pqty);
			$nData1["Address"] = nl2br($u->shipping_address);
			$nData1["cAddress"] = $udata->user_current_address;
			$nData1["orderType"] =  $u->order_type;
			$nData1["shift"] =$u->deliveryShift;
			$nData1["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData1["Status"] =$status;
			$nData1["action"] ='<a href="javascrip:void(0)" class="text-inverse p-r-10 getOid" orderType="'.$u->order_type.'" soid="" id="'.$u->order_id.'"><i class="fas fa-edit"></i></a>';
		   
			$jsonData[] = $nData1;

		  $id++; 
//	   }
	 }elseif($u->order_type == "subscribe"){
		   
		 $stdate = date("Y-m-d",strtotime($sdate));
		
		 $sdata = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$u->order_id' and pause_status='Inactive' and delivery_date = '$stdate' and deliver_status='Pending'")->result();
		   
		foreach($sdata as $sd){
			
		   $sstatus = isset($sd->deliver_status) ? $sd->deliver_status : ""; 
			if($sstatus == "Success"){

				$substatus = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($sstatus == "Pending"){

				$substatus = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$substatus = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}	
			
			$sid = isset($sd->id) ? $sd->id : '';
			
		
		   $nData = array();
			$nData["sno"] = $id;
			$nData["Order_ID"] =  $u->order_id;
			$nData["Name"] = $udata->user_name;
			$nData["Mobile"] = $udata->user_mobile;
			$nData["itemName"] = implode("<br>",$pname);
			$nData["qty"] = implode("<br>",$pqty);
			$nData["Address"] = nl2br($u->shipping_address);
			$nData["cAddress"] = $udata->user_current_address;
			$nData["orderType"] =  $u->order_type;
			$nData["shift"] =$u->deliveryShift;
			$nData["Delivery_Date"] = date("Y-m-d",strtotime($sd->delivery_date));
			$nData["Status"] =$substatus;
			$nData["action"] ='<a href="javascrip:void(0)" class="text-inverse p-r-10 getOid" orderType="'.$u->order_type.'" soid="'.$sid.'" id="'.$u->order_id.'"><i class="fas fa-edit"></i></a>';
			$jsonData[] = $nData;

		  $id++;
			   
		}
	}elseif($u->order_type == "freesample"){
		   
//		echo strtotime($u->deliverydate).",";
//		echo strtotime($sdate).",";
//		echo $u->delivery_status.",";
//		
//		echo $sdate;
		
		
		
	   if((strtotime($u->deliverydate) == strtotime($sdate)) && ($u->delivery_status=="Pending")){
		   
		    if(json_decode($u->product_data)){
				   
				$pd = json_decode($u->product_data);

			}else{

				$pd = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row();

			}
		   
		    if($u->delivery_status == "Success"){
														
				$status = '<span class="badge badge-success" style="color:white">Success</span>';
			}elseif($u->delivery_status == "Pending"){

				$status = '<span class="badge badge-warning" style="color:white">Pending</span>';
			}else{
				$status = '<span class="badge badge-danger" style="color:white">Failed</span>';
			}
	     
			$nData2 = array();
			$nData2["sno"] = $id;
			$nData2["Order_ID"] =  $u->order_id;
			$nData2["Name"] = $udata->user_name;
			$nData2["Mobile"] = $udata->user_mobile;
			$nData2["itemName"] = $pd->product_name;
			$nData2["qty"] = 1;
			$nData2["Address"] = nl2br($u->shipping_address);
			$nData2["cAddress"] = $udata->house_no."<br>".$udata->landmark."<br>".$udata->user_current_address."<br>".$area."<br>".$ucity;
			$nData2["orderType"] =  $u->order_type;
			$nData2["shift"] =$u->deliveryShift;
			$nData2["Delivery_Date"] = date("Y-m-d",strtotime($u->deliverydate));
			$nData2["Status"] =$status;
			$nData2["action"] ='<a href="javascrip:void(0)" class="text-inverse p-r-10 getOid" orderType="'.$u->order_type.'" soid="'.isset($sdate->id) ? $sdate->id : "".'" id="'.$u->order_id.'"><i class="fas fa-edit"></i></a>';
			$jsonData[] = $nData2;

		  $id++;  
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
	
	
	
}