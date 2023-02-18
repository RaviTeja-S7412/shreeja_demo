<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agentorders extends CI_Controller {
	
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
	
}
	
public function getOrders($sdate="",$edate="",$shift="",$city=""){
	
	$role = $this->admin->get_admin("role");
	$aagt = json_decode($this->admin->get_admin("assigned_agents"));
	
	if($role == 7){
		
		if($shift != ""){
			
			$this->db->where("order_delivery_time",$shift);
			
		}
		if($city != ""){
			
			$this->db->where("city",$city);
			
		}
		if($sdate != ""){
			
			$this->db->where("delivery_date between '$sdate' and '$edate'");
			
		}
		
		$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",$aagt->agents)->get_where("agent_orders")->result();
		
	}elseif($role == 12){
		
		$bdas = $this->db->select("assigned_agents")->where_in("id",$aagt->salesemployees)->get_where("fdm_va_auths",array("deleted"=>0))->result();
		
		$agents = array();
		
		foreach($bdas as $bd){
			
			$adata = json_decode($bd->assigned_agents,TRUE);
			
			$agt = array();
			foreach($adata["agents"] as $i => $ag){
				
				$agt[] = $ag;
				
//				$arr = array_merge($adata["agents"],$adata["agents"][$i]);
				
			}
			
			
			$agents[] = $agt;
			
		}
		
		if(count($agents) > 1){
			$arr = [];
			for($i = 0; $i < count($agents); $i++){

				$arr = array_merge($arr,$agents[$i]);

			}
		}else{
			
			$arr = $agents[0];
			
		}
		
		if($shift != ""){
			
			$this->db->where("order_delivery_time",$shift);
			
		}
		if($city != ""){
			
			$this->db->where("city",$city);
			
		}
		if($sdate != ""){
			
			$this->db->where("delivery_date between '$sdate' and '$edate'");
			
		}
		$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",array_unique($arr))->get_where("agent_orders")->result();
		
	}elseif($role == 11){
				
		$bdas = $this->db->select("assigned_agents")->where_in("id",$aagt->salesemployees)->get_where("fdm_va_auths",array("deleted"=>0))->result();
		
		$agents = array();
		
		foreach($bdas as $bd){
			
			$adata = json_decode($bd->assigned_agents,TRUE);
			
			$agt = array();
			foreach($adata["agents"] as $i => $ag){
				
				$agt[] = $ag;
				
//				$arr = array_merge($adata["agents"],$adata["agents"][$i]);
				
			}
			
			
			$agents[] = $agt;
			
		}
		
		
		if(count($agents) > 1){
			$arr = [];
			for($i = 0; $i < count($agents); $i++){
			    

				$arr = array_merge($arr,$agents[$i]);

			}
		}else{
			
			$arr = $agents[0];
			
		}
		
		if($shift != ""){
			
			$this->db->where("order_delivery_time",$shift);
			
		}
		if($city != ""){
			
			$this->db->where("city",$city);
			
		}
		if($sdate != ""){
			
			$this->db->where("delivery_date between '$sdate' and '$edate'");
			
		}
		$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",array_unique($arr))->get_where("agent_orders")->result();
		
		
	}else{
		
		if($sdate != ""){
			
			$squery = "and delivery_date between '$sdate' and '$edate'";
			
		}else{
			
			$squery = "";
			
		}
		
		if($shift != ""){
			
			$shdata = "and order_delivery_time='$shift'";
			
		}else{
			
			$shdata = "";
			
		}
		if($city != ""){
			
			$ccity = "and city='$city'";
			
		}else{
			
			$ccity = "";
			
		}
		
		$data["orders"] = $this->db->query("select * from agent_orders where deleted=0 $squery $shdata $ccity order by id desc")->result();
		
	}
	
	return $data["orders"];
	
}	

public function myOrders(){
	
	$sdate = date("Y-m-d");
	
	$data["orders"] = $this->agentorders_model->getReporttbody($this->getOrders($sdate,$sdate));
	
	$this->load->view("orders/agentOrders/myOrders",$data);

}

public function depositOrders(){

	$data["orders"] = $this->getOrders();

	$this->load->view("orders/agentOrders/depositOrders",$data);

}	
	
public function deletedOrders(){


	$aid = $this->session->userdata("admin_id");
	$data["orders"] = $this->db->query("select * from agent_orders where deleted=1 order by id desc")->result();
	$this->load->view("orders/agentOrders/deletedOrders",$data);

}	

public function updateHistory(){


	$aid = $this->session->userdata("admin_id");
	$data["orders"] = $this->db->query("select * from agent_order_update_history order by id desc")->result();
	$this->load->view("orders/agentOrders/updateHistory",$data);

}	
	
public function index(){

	$data["u"] = "";
	$this->load->view("orders/agentOrders/products");
}

public function updateOrder($oid){
	
	$data["u"] = $this->db->get_where("agent_orders",array("order_id"=>$oid))->row();
	$this->load->view("orders/agentOrders/products",$data);
}

public function filterOrders(){
	
	$sdate = date("Y-m-d",strtotime($this->input->post_get("sdate")));
	$edate = date("Y-m-d",strtotime($this->input->post_get("edate")));
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");
	
	$data = $this->getOrders($sdate,$edate,$shift,$city);
	
	$fdata = $this->agentorders_model->getReporttbody($data);
	$trdata = $this->agentorders_model->getReportstr();
	
	
	$jsonData = array();

	foreach($fdata as $key => $tdata){

		$nData = array();
	
		foreach($tdata as $kk => $td){
			$nData[$trdata[$kk]] = $td;
		}

		$jsonData[] = $nData;
	
	}
	
	
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);
	
}	
	
public function filterdepositOrders(){
	
	$sdate = $this->input->post("sdate");
	$edate = $this->input->post("edate");
	
	$data = $this->getOrders();

	$jsonData = array();
	
	$id = 1;
	
	foreach($data as $u){
		
	if(strtotime($u->delivery_date) >= strtotime($sdate) && (strtotime($u->delivery_date) <= strtotime($edate))){	
		
		$products = json_decode($u->product_id);	    	
		$aData = $this->db->get_where("fdm_va_auths",array("id"=>$u->agent_id))->row();
		
		$image = ($u->transaction_document != "") ? '<a target="_blank" href="'.base_url('orders/depositOrders/transactiondocuments/').$u->order_id.'" class="btn btn-info waves-effect waves-light">View</a>' : "";
		
		$nData = array();
		$nData["sno"] = $id;
		$nData["city"] = $this->db->get_where("tbl_locations",["id"=>$u->city])->row()->location;
		$nData["mobile_number"] = $aData->agent_id;
		$nData["name"] = $aData->name;
		$nData["transaction_date"] = ($u->transaction_date != "") ? date("d.m.Y",strtotime($u->transaction_date)) : "";
		$nData["bank_name"] = $u->bank_name;
		$nData["transaction_number"] = $u->transaction_number;
		$nData["amount"] = $u->amount;
		$nData["image"] = $image;
		$jsonData[] = $nData;
		
		$id++;
	}
	}
	
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);
	
}	
	
	
	
public function insertOrder(){
    
	$uid = $this->session->userdata("admin_id");
	$aid = $this->input->post("aid");
	$pid = $this->input->post("product_id",true);
	$oid = $this->admin->generateagentOrderId();
//	$price = $this->input->post("price",true);
	$category = $this->input->post("category",true);
	$deliveryDate = $this->input->post("deliveryDate",true);
	$deliveryTime = $this->input->post("deliveryTime",true);
	$txnAmount = $this->input->post("txnAmount",true);
	$txnID = $this->input->post("txnID",true);
	$txnDate = $this->input->post("txnDate",true);
	$bankname = $this->input->post("bank_name",true);
	$qty = $this->input->post("quantity",true);
	$qtyType = $this->input->post("qtyType",true);
	
	
	$tincharge = $this->input->post("tincharge",true);
	$salesemployees = $this->input->post("salesemployees",true);
	
	
	if($tincharge){

	  $assigned_from = array("ti"=>$tincharge,"bda"=>$salesemployees);

	}elseif($salesemployees){

	  $assigned_from = array("bda"=>$salesemployees);

	}else{

	  $assigned_from = [];

	}
	
	if(array_sum($qty) == 0){
		
		$this->alert->pnotify("error","Please enter quantity","error");
		redirect("orders/agent-order");
		
	}
	
	$paySlip = [];
	
	if($_FILES["files"]["name"] != '')
  {
   $output = '';
   $config["upload_path"] = 'uploads/agentPayments/';
   $config["allowed_types"] = '*';	  
   //$config["encrypt_name"] = TRUE;   
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   for($count = 0; $count<count($_FILES["files"]["name"]); $count++)
   {
    $_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
    $_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
    $_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
    $_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
    $_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
    if($this->upload->do_upload('file'))
    {
     $data = $this->upload->data();

	 	$paySlip[] = 'uploads/agentPayments/'.$data["file_name"];

    }
   }
  }
	
	$data2 = array();
	
	for($i=0;$i<sizeof($pid);$i++) {
		
		
		if($qty[$i] != 0){
		
			$data2[] = array ('productId' => $pid[$i], 'category' => $category[$i], 'productQty' =>$qty[$i], 'qtyType' => $qtyType[$i]);
			
		}
	}
	
	$udata = $this->db->get_where("fdm_va_auths",["id"=>$aid])->row();
	
	$data = array(

			"order_id" => $oid,	
			"product_id" => json_encode($data2),
//			"category" => json_encode($cat),
			"city" => $udata->city,
			"bank_name" => $bankname,
			"delivery_date" => $deliveryDate,
			"agent_id" => $aid,
			"order_delivery_time" => $deliveryTime,
			"amount" => $txnAmount,
			"transaction_number" => $txnID,
			"transaction_document" => implode(",",$paySlip),
			"transaction_date" => $txnDate,
			"assigned_from" => json_encode($assigned_from),
			"created_by" => $uid

		);


	$u = $this->db->insert("agent_orders",$data);

	if($u){

		$this->alert->pnotify("success","Order Successfully Placed","success");
		redirect("orders/agent-order");

	}else{

		$this->alert->pnotify("error","Error Occured While placing order","error");
		redirect("orders/agent-order");
	}
}

public function editOrder(){

	$aid = $this->input->post("aid");
	$uid = $this->session->userdata("admin_id");
	$pid = $this->input->post("product_id",true);
	$oid = $this->input->post("order_id",true);
//	$price = $this->input->post("price",true);
	$deliveryDate = $this->input->post("deliveryDate",true);
	$deliveryTime = $this->input->post("deliveryTime",true);
	$txnAmount = $this->input->post("txnAmount",true);
	$txnID = $this->input->post("txnID",true);
	$bankname = $this->input->post("bank_name",true);
	$txnDate = $this->input->post("txnDate",true);
	$category = $this->input->post("category",true);
	$qty = $this->input->post("qty",true);
	$qtyType = $this->input->post("qtyType",true);
	
	
	$tincharge = $this->input->post("tincharge",true);
	$salesemployees = $this->input->post("salesemployees",true);
	
	
  if($tincharge){
	  
	  $assigned_from = array("ti"=>$tincharge,"bda"=>$salesemployees);
	  
  }elseif($salesemployees){
	  
	  $assigned_from = array("bda"=>$salesemployees);
	  
  }else{
	  
	  $assigned_from = [];
	  
  }
	
	
	$odata = $this->db->get_where("agent_orders",array("order_id"=>$oid,"deleted"=>0))->row();
	
	if($_FILES["files"]["name"] != '')
  {

   $ppaySlip = [];	  
     	  
   $output = '';
   $config["upload_path"] = 'uploads/agentPayments/';
   $config["allowed_types"] = '*';	  
   //$config["encrypt_name"] = TRUE;   
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   for($count = 0; $count<count($_FILES["files"]["name"]); $count++)
   {
    $_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
    $_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
    $_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
    $_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
    $_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
    if($this->upload->do_upload('file'))
    {
     $data = $this->upload->data();

	 	$ppaySlip[] = 'uploads/agentPayments/'.$data["file_name"];

    }
   }
	  
	 $expaySlip = explode(",",$odata->transaction_document); 
	  
	 $paySlip = implode(",",array_merge($expaySlip,$ppaySlip));  
	  
  }else{
	  
	 $paySlip = $odata->transaction_document;
		
  }
	
	$data2 = array();
	
	
	for($i=0;$i<sizeof($pid);$i++) {
		
		
		if($qty[$i] != 0){
		
			$data2[$i] = array ('productId' => $pid[$i], 'category' => $category[$i], 'productQty' =>$qty[$i], 'qtyType' => $qtyType[$i]);			
		}
	}
	
	$udata = $this->db->get_where("fdm_va_auths",["id"=>$aid])->row();	
	
	$data = array(

		"agent_id" => $aid,
		"product_id" => json_encode($data2),
//		"category" => $category,
		"city" => $udata->city,
		"bank_name" => $bankname,
		"delivery_date" => $deliveryDate,
		"order_delivery_time" => $deliveryTime,
		"amount" => $txnAmount,
		"transaction_number" => $txnID,
		"transaction_document" => $paySlip,
		"transaction_date" => $txnDate,
		"assigned_from" => json_encode($assigned_from),
		"updated_by" => $uid

	);
	
			$this->db->set($data);
			$this->db->where("order_id",$oid);
			$u = $this->db->update("agent_orders");

			if($u){
				
			    $this->updatehistory_model->agentorderupdateHistory($odata,$oid,$uid,$aid);
				
				$this->alert->pnotify("success","Order Successfully Updated","success");
				redirect("orders/agent-order");

			}else{
					
					$this->alert->pnotify("error","Error Occured While updating order","error");
					redirect("orders/agent-order/updateOrder/".$oid);
			}
	
}


public function user_access(){

	$this->load->view("users/useraccess");
}
	
public function delOrder($oid){
	
	$uid = $this->session->userdata("admin_id");
	
	$d = $this->db->where("order_id",$oid)->update("agent_orders",array("deleted"=>1,"order_status"=>"Cancelled"));
	
	if($d){
		
		$this->updatehistory_model->deletedHistory($oid,$uid);
		
		$this->alert->pnotify("success","Order Successfully deleted","success");
		redirect("orders/agent-orders");

	}else{

		$this->alert->pnotify("error","Error Occured While deleting order","error");
		redirect("orders/agent-orders");
	}
}	
	
	
public function getAreas(){
		
		$id=$this->input->get("id",true);
		
		$d=$this->products_model->getProduct($id);
	
		echo '<option value="">Select Quantity</option>';
	
		foreach($qty->quantity as $q){
			
			echo '<option value="'.$q.'">'.$q.'</option>';
		}
		
}
	
	
// Deliverable quantity
	
	
public function getDQOrders($sdate,$shift,$city){
	
	$aid = $this->session->userdata("admin_id");
	
	
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
	if($city != ""){
		
		$this->db->where("location",$city);
		
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
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$sorders = $this->db->get()->result();
	
	$data = array_merge($dorders,$sorders);
	
	return $data;	
}	
	
public function deliverableQuantity()
	{
//		$data["doo"] = $this->db->query("select * from orders where order_status='Cancelled'")->result();
		$this->load->view('orders/agent/deliverableQuantity');
	}	
	
public function allProductquantity(){
	
$aid = $this->session->userdata("admin_id");
$date = $this->input->post("sdate");
//$shift = $this->input->post("shift");

 $products = $this->db->where(array("assigned_to"=>"consumers"))->get("tbl_products")->result_array();
 $i = 0;
 $data = [];
 foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->get_success_orders($row1['id'],$value,$aid);
			
			if($packets != 0){
			
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets;
				$new['uom'] = "EA";
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

public function get_success_orders($pid,$cat,$aid){
	
	$date = date("d-m-Y");
	
	$orders = $this->getDQOrders($date,"","");

	
	$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success' and product_id='$pid' and qty='$cat' and assigned_to='$aid'")->result();
	
	
	$pqty = [];
	foreach($orders as $o){
		
//		echo $o->deliveryonce_date;
			
			if($o->order_type == "deliveryonce"){
				if(strtotime($date) == strtotime($o->deliveryonce_date)){
					$opdata = $this->db->where(array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->get("order_products")->result();
					foreach($opdata as $op){
			
						$pqty[] = $op->qty;
						
					}

				}
				
			}elseif($o->order_type == "subscribe"){
				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive"))->result();
				
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
	
		 foreach($fsorders as $fs){
			
			if(strtotime($date) == strtotime($fs->delivery_date)){
			
				  $pqty[] = 1;

			}
			
		}
	
		return array_sum($pqty);
}

public function filterProductquantity(){
	
$aid = $this->session->userdata("admin_id");
$date = $this->input->post("sdate");
$shift = $this->input->post("shift");
$city = $this->input->post("city");

 $products = $this->db->where_in("assigned_to",array("consumers","freeProduct"))->get("tbl_products")->result_array();
 $i = 0;
 $data = [];
    foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->getfiltered_success_orders($date,$shift,$row1['id'],$value,$aid,$city);
			
			if($packets["pqty"] != 0){
			
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets["pqty"];
				$new['uom'] = "EA";
				$data[$i] = $new;
				$i++;
			}
    	}

	}
	
	$new['sno'] = $i+1;
	$new['product_id'] = '<p class="category"></p>';
	$new['pname'] = '<strong style="font-weight: 600;font-size: 16px;">FreeProducts</strong>';
	$new['sap_code'] = '<p class="category"></p>';
	$new['packets'] = '<p class="category"></p>';
	$new['uom'] = '<p class="category"></p>';
	$data[$i] = $new;
	$i++;
	
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

public function getfiltered_success_orders($date,$shift,$pid,$cat,$aid,$city){
	
	
	$orders = $orders = $this->getDQOrders($date,$shift,$city);	
	
	$this->db->select('*');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	$this->db->where("product_id",$pid);
	$this->db->where("qty",$cat);
	$this->db->where("assigned_to",$aid);
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("location",$city);
		
	}
	
	$resutset1 = $this->db->get();
	
	$fsorders = $resutset1->result();
	
	
//	$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success'")->result();
	$pqty = [];
	$freepqty = [];
	
	foreach($orders as $o){
		
//		echo $o->deliveryonce_date;
			
			if($o->order_type == "deliveryonce"){
				if(strtotime($date) == strtotime($o->deliveryonce_date)){
					$opdata = $this->db->where(array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->get("order_products")->result();
					foreach($opdata as $op){
			
						if($op->orderRef == "offer"){
                            $freepqty[] = $op->qty;
                        }else{
						    $pqty[] = $op->qty;
                        }
						
					}

				}
				
			}elseif($o->order_type == "subscribe"){
				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive"))->result();
				
				$oop = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat,"orderRef"=>"offer"))->row();
					
				if(strtotime($date) == strtotime($o->sub_start_date)){
					$freepqty[] = $oop->qty;
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
		
		 foreach($fsorders as $fs){
			
			if(strtotime($date) == strtotime($fs->delivery_date)){
			
				  $pqty[] = 1;

			}
			
		}
		
		return ["pqty"=>array_sum($pqty),"freepqty"=>array_sum($freepqty)];
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
	
}