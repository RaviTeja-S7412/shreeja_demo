<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribed extends CI_Controller {

public function __construct(){
			
	parent::__construct();
		
	$this->secure->loginCheck();
}
	
	
public function index()
	{
		$data["doo"] = $this->db->query("select * from orders where payment_status='Success' and order_type='subscribe' order by id desc")->result();
		$this->load->view('orders/admin/allSubscribedorders',$data);
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
		$data["doo"] = $this->db->query("select * from orders where payment_status='Success' and order_type='subscribe' and assigned_to=$aid order by id desc")->result();
		$this->load->view('orders/agent/allSubscribedorders',$data);
	}	
	
public function viewdoOrder($id)
	{
		$aid = $this->session->userdata("admin_id");
		$data["doo"] = $this->db->query("select * from orders where payment_status='Success' and order_type='subscribe' and assigned_to=$aid and order_id = '$id' order by id desc")->row();
		$data["soo"] = $this->db->query("select * from tbl_subscribed_deliveries where order_id='$id' order by delivery_date asc")->result();
		$this->load->view('orders/agent/viewSubscribedorders',$data);
	}
	
public function updateDeliverystatus(){
	
	$oid = $this->input->post("oid");
	$sordid = $this->input->post("sordid");	
	$dstatus = $this->input->post("deliveryStatus");
	$ostatus = $this->input->post("ostatus");
	$aid = $this->session->userdata("admin_id");
	
	$pChk = $this->db->get_where("tbl_subscribed_deliveries",array("id"=>$sordid,"pause_status"=>"Active"))->num_rows();
	
	if($pChk == 1){
		
		$this->alert->pnotify("error","Order is in paused state.","error");
		redirect("agent-orders/view-subscribed-order/".$oid);

	}
	
	
	if($dstatus == "other"){
		
		$status = $this->input->post("ostatus");
		
	}else{
		
		$status = $this->input->post("deliveryStatus");
		
	}
	
	$data = array("deliver_status"=>$status,"delivered_by"=>$aid);
	
	$this->db->set($data);
	$this->db->where("id",$sordid);
	$u = $this->db->update("tbl_subscribed_deliveries");
	
	if($u){
		
//		$oChk = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"deliver_status"=>"Pending","pause_status"=>"Inactive"))->num_rows();
//
//		if($oChk == 0){
//
//			echo "yes";
//
//		}

			$this->alert->pnotify("success","Delivery status updated successfully.","success");
			redirect("agent-orders/view-subscribed-order/".$oid);
	}else{

			$this->alert->pnotify("error","Error Occured please try again.","error");
			redirect("agent-orders/view-subscribed-order/".$oid);
	}
	
}	
	
	
	
}