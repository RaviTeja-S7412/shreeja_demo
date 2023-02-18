<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeliveryOnce extends CI_Controller {

public function __construct(){
			
	parent::__construct();
		
	$this->secure->loginCheck();
}
	
	
public function index()
	{
		$data["doo"] = $this->db->query("select * from orders where payment_status='Success' and order_type='deliveryonce' order by id desc")->result();
		$this->load->view('orders/admin/allDeliveryonceorders',$data);
	}

	
public function assignOrders(){
	
	$agent = $this->input->post("agent");
	$orderids = $this->input->post("orderids");
	
	foreach(json_decode($orderids) as $oid){
		
		$data = array("assigned_to"=>$agent);
		
		$this->db->set($data);
		$this->db->where("order_id",$oid->order_id);
		$qi = $this->db->update("orders");

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
		$data["doo"] = $this->db->query("select * from orders where payment_status='Success' and order_type='deliveryonce' and assigned_to=$aid order by id desc")->result();
		$this->load->view('orders/agent/allDeliveryonceorders',$data);
	}	
	
public function viewdoOrder($id)
	{
		$aid = $this->session->userdata("admin_id");
		$data["doo"] = $this->db->query("select * from orders where payment_status='Success' and order_type='deliveryonce' and assigned_to=$aid and order_id = '$id' order by id desc")->row();
		$this->load->view('orders/agent/viewDeliveryonceorders',$data);
	}
	
public function updateDeliverystatus(){

	$oid = $this->input->post("order_id");	
	$dstatus = $this->input->post("deliveryStatus");
	$ostatus = $this->input->post("ostatus");
	
	if($dstatus == "other"){
		
		$status = $this->input->post("ostatus");
		
	}else{
		
		$status = $this->input->post("deliveryStatus");
		
	}
	
	$data = array("delivery_status"=>$status);
	
	$this->db->set($data);
	$this->db->where("order_id",$oid);
	$u = $this->db->update("orders");
	
	if($u){

			$this->alert->pnotify("success","Delivery status updated successfully.","success");
			redirect("agent-orders/view-order/".$oid);
	}else{

			$this->alert->pnotify("error","Error Occured please try again.","error");
			redirect("agent-orders/view-order/".$oid);
	}
	
}	
	
	
	
}