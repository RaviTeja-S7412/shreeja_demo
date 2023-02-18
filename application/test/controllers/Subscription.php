<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends CI_Controller {

public function __construct(){
			
	parent::__construct();
	
	$uid = $this->session->userdata("user_id");
	
	if(!$uid){
		
		redirect("login");
	}
 }

public function index($id){
	
	$uid = $this->session->userdata("user_id");
	$data["ord"] = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$id,"user_id"=>$uid))->result();
	$this->load->view("subscribedOrders",$data);

}
	
public function pauseSubscribtion(){
	
	$uid = $this->session->userdata("user_id");
	$oid = $this->input->post("oid");
	$id = $this->input->post("id");
	$status = $this->input->post("status",true);
	
	$data=array('pause_status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_subscribed_deliveries");
		
		if($d){
			
			$ords = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->result();
			
			if($status=="Active"){
				
				$edate = end($ords)->delivery_date;
				$edate = strtotime($edate);
				$date = strtotime("+1 day", $edate);
				
				$endDate = date('Y-m-d', $date);

				$data = array("delivery_date"=>$endDate,"order_id"=>$oid,"user_id"=>$uid);

				$d = $this->db->insert("tbl_subscribed_deliveries",$data);
				$lid = $this->db->insert_id();
					
				$oChk = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"))->num_rows();

				if($oChk != 30){

					$st = ($status=="Active") ? "Inactive" : "Active";
					$this->db->where("id",$id)->update("tbl_subscribed_deliveries",array("pause_status"=>$st));
					$this->db->where("id",$lid)->delete("tbl_subscribed_deliveries");	
					
					echo 'you cannot pause order on this date'.$oChk;
					exit();

				}	
				
				
				if($d){
					
					$data = array("sub_end_date"=>date('d-m-Y',strtotime($endDate)));
					
					$this->db->set($data);
					$this->db->where("order_id",$oid);
					$this->db->update("orders");
					echo 1;
					
				}
				
			}else{
				
				$cChk = $this->db->order_by("id","desc")->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"))->row();
				
				$dChk = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"id"=>$id,"pause_status"=>"Inactive"))->row();
				
//				$count = ($cChk == "Active") ? 30 : 31;
				
				$oChk = ($this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"))->num_rows());

				if(($oChk != 31) || (strtotime($dChk->delivery_date) == strtotime($cChk->delivery_date))){

					$st = ($status=="Active") ? "Inactive" : "Active";
					$this->db->where("id",$id)->update("tbl_subscribed_deliveries",array("pause_status"=>$st));
					
					echo 'you cannot pause order on this date'.$oChk;
					exit();

				}	
				
				
				$edate = $cChk->delivery_date;
				$d = $this->db->delete("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"delivery_date"=>$edate));
				
				if($d){
					
					$upords = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->result();
					
					$update = end($upords)->delivery_date;

					$data = array("sub_end_date"=>date('d-m-Y',strtotime($update)));
					
					$this->db->set($data);
					$this->db->where("order_id",$oid);
					$this->db->update("orders");
					
					echo 0;
				
				}
				
			}

		}else{
			if($status=="Active"){
				echo $this->alert->pnotify("Error","Error Occured While Enabling Navbar Menu","error");
			}else{
				echo $this->alert->pnotify("Error","Error Occured While Disabling Navbar Menu","error");
			}	
		}
	
	
	
}
	
public function subscribedOrders(){
	
	$this->load->view("subscribedOrders");
	
}	


}