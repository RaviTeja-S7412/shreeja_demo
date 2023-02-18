<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agentproducts extends CI_Controller {
	
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
	
}

public function myOrders(){


	$aid = $this->session->userdata("admin_id");
	$data["orders"] = $this->db->query("select * from agent_orders where agent_id='$aid' and deleted=0 order by id desc")->result();
	$this->load->view("agentOrders/myOrders",$data);

}
	
public function filterOrders(){
	
	$aid = $this->session->userdata("admin_id");
	$sdate = date("Y-m-d",strtotime($this->input->post_get("sdate")));
	$edate = date("Y-m-d",strtotime($this->input->post_get("edate")));
	$shift = $this->input->post("shift");

	
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

	$orders = $this->db->query("select * from agent_orders where deleted=0 and agent_id='$aid' $squery $shdata order by id desc")->result();

	$jsonData = array();
	$id = 1;
	
	foreach($orders as $u){
		
	    $products = json_decode($u->product_id);	    	
	    $cdata = $this->db->get_where("fdm_va_auths",array("id"=>$u->created_by))->row();
		
		$pid = [];
		$pname = [];
		$pqty = [];
		$pqtype = [];
		
		foreach($products as $p){

			$pid[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_id; 
			$pname[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_name." ".$p->category; 
			$pqty[] = $qty->productQty;
			$pqtype[] = $qty->qtyType;
			
		}
		
		$nData = array();
		$nData["sno"] = $id;
		$nData["product_id"] = implode(", <br>",$pid);
		$nData["product_name"] = implode(", <br>",$pname);
		$nData["delivery_date"] = date("d.m.Y",strtotime($u->delivery_date));
		$nData["order_delivery_time"] = $u->order_delivery_time;
		$nData["productQty"] = $u->productQty;
		$nData["qtyType"] = $u->qtyType;
		$nData["cby"] = $cdata->name ." (".$this->db->get_where("fdm_va_roles",array("id"=>$cdata->role))->row()->role_name.")";
		$nData["action"] = '<a href="'.base_url().'agent-products/updateOrder/'.$u->order_id.'" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a>';
		$jsonData[] = $nData;
		
		$id++;
	}
	
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);

	
	
}	

public function filterdepositorders(){
	
	$aid = $this->session->userdata("admin_id");
	$sdate = date("Y-m-d",strtotime($this->input->post_get("sdate")));
	$edate = date("Y-m-d",strtotime($this->input->post_get("edate")));
	$shift = $this->input->post("shift");

	
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

	$orders = $this->db->query("select * from agent_orders where deleted=0 and agent_id='$aid' $squery $shdata order by id desc")->result();

	$jsonData = array();
	$id = 1;
	
	foreach($orders as $u){
		
		
	    $image = ($u->transaction_document != "") ? '<a target="_blank" href="'.base_url('agent-products/transactiondocuments/').$u->order_id.'" class="btn btn-info waves-effect waves-light">View</a>' : "";
		
		$nData = array();
		$aData = $this->db->get_where("fdm_va_auths",array("id"=>$u->agent_id))->row();
		
		
		$nData = array();
		$nData["sno"] = $id;
		$nData["transaction_date"] = ($u->transaction_date != "") ? date("d.m.Y",strtotime($u->transaction_date)) : "";
		$nData["bank_name"] = $u->bank_name;
		$nData["transaction_number"] = $u->transaction_number;
		$nData["amount"] = $u->amount;
		$nData["image"] = $image;
		$jsonData[] = $nData;
		
		$id++;
	}
	
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);

	
	
}	
	
	
public function depositOrders(){


	$aid = $this->session->userdata("admin_id");
	$data["orders"] = $this->db->query("select * from agent_orders where agent_id='$aid' and deleted=0 order by id desc")->result();
	$this->load->view("agentOrders/depositOrders",$data);

}	

public function index(){
	$data["u"] = "";
	$this->load->view("agentOrders/products",$data);
}

public function updateOrder($oid){
	
	$data["u"] = $this->db->get_where("agent_orders",array("order_id"=>$oid))->row();
	$this->load->view("agentOrders/products",$data);
}
	
	
public function insertOrder(){

	$aid = $this->session->userdata("admin_id");
//	$role = $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id")))->row()->id;
	$pid = $this->input->post("product_id",true);
	$oid = $this->admin->generateagentOrderId();
	$bankname = $this->input->post("bank_name",true);
	$category = $this->input->post("category",true);
	$qty = $this->input->post("quantity",true);
	$deliveryDate = $this->input->post("deliveryDate",true);
	$deliveryTime = $this->input->post("deliveryTime",true);
	$txnAmount = $this->input->post("txnAmount",true);
	$txnID = $this->input->post("txnID",true);
	$txnDate = $this->input->post("txnDate",true);
	$qtyType = $this->input->post("qtyType",true);
	
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
		
			$data2[$i] = array ('productId' => $pid[$i], 'category' => $category[$i], 'productQty' =>$qty[$i], 'qtyType' => $qtyType[$i]);			
			
		}
	}
	
	$udata = $this->db->get_where("fdm_va_auths",["id"=>$aid])->row();
				
	$data = array(

			"order_id" => $oid,	
			"product_id" => json_encode($data2),
//			"category" => json_encode($cat),
//			"price" => $price,
			"bank_name" => $bankname,
			"delivery_date" => $deliveryDate,
			"agent_id" => $aid,
			"order_delivery_time" => $deliveryTime,
			"amount" => $txnAmount,
			"transaction_number" => $txnID,
			"transaction_document" => implode(",",$paySlip),
			"transaction_date" => $txnDate,
			"created_by" => $aid,
			"city" => $udata->city

		);


	$u = $this->db->insert("agent_orders",$data);

	if($u){

		$this->alert->pnotify("success","Order Successfully Placed","success");
		redirect("agent-products");

	}else{

			$this->alert->pnotify("error","Error Occured While placing order","error");
			redirect("agent-products");
	}
	
}

public function editOrder(){

	$aid = $this->session->userdata("admin_id");
//	$role = $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id")))->row()->role;
	$pid = $this->input->post("product_id",true);
	$oid = $this->input->post("order_id",true);
	$bankname = $this->input->post("bank_name",true);
	$category = $this->input->post("category",true);
	$qty = $this->input->post("qty",true);
	$deliveryDate = $this->input->post("deliveryDate",true);
	$deliveryTime = $this->input->post("deliveryTime",true);
	$txnAmount = $this->input->post("txnAmount",true);
	$txnID = $this->input->post("txnID",true);
	$txnDate = $this->input->post("txnDate",true);
	$qtyType = $this->input->post("qtyType",true);
	
	$odata = $this->db->get_where("agent_orders",array("order_id"=>$oid,"deleted"=>0))->row();
	
// 	if(array_sum($qty) == 0){
		
// 		$this->alert->pnotify("error","Please enter quantity","error");
// 		redirect("agent-products");
		
// 	}
	
	
	
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
			
	$data = array(

			"order_id" => $oid,	
			"product_id" => json_encode($data2),
//			"category" => json_encode($cat),
//			"price" => $price,
			"bank_name" => $bankname,
			"delivery_date" => $deliveryDate,
			"agent_id" => $aid,
			"order_delivery_time" => $deliveryTime,
			"amount" => $txnAmount,
			"transaction_number" => $txnID,
			"transaction_document" => $paySlip,
			"transaction_date" => $txnDate,
			"updated_by" => $aid

		);
	$this->db->set($data);
	$this->db->where("order_id",$oid);
	$u = $this->db->update("agent_orders");

	if($u){
	    
	    $this->updatehistory_model->agentorderupdateHistory($odata,$oid,$aid,$aid);
		
		$this->alert->pnotify("success","Order Successfully Updated","success");
		redirect("agent-products/myorders");

	}else{

		$this->alert->pnotify("error","Error Occured While Updating order","error");
		redirect("agent-products/myorders");
		
	}
	
}


public function user_access(){

	$this->load->view("users/useraccess");
}
	
public function delOrder($oid){
	
	$d = $this->db->where("order_id",$oid)->update("agent_orders",array("deleted"=>1));
	
	if($d){
		
		$this->alert->pnotify("success","Order Successfully deleted","success");
		redirect("agent-products/myorders");

	}else{

		$this->alert->pnotify("error","Error Occured While deleting order","error");
		redirect("agent-products/myorders");
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
	
public function transactiondocuments($oid){
	
	$odata = $this->db->get_where("agent_orders",array("order_id"=>$oid))->row();
	$data["images"] = explode(",",$odata->transaction_document);
	
	$this->load->view("agentOrders/transactiondocuments",$data);
	
}	

}