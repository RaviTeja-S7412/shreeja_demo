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
			
			if($status=="Active"){
				
				$ords = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->result();
				
				$edate = end($ords)->delivery_date;
				$edate = strtotime($edate);
				$date = strtotime("+1 day", $edate);
				
				$endDate = date('Y-m-d', $date);

				$data = array("delivery_date"=>$endDate,"order_id"=>$oid,"user_id"=>$uid);

				$d = $this->db->insert("tbl_subscribed_deliveries",$data);
				
				echo 1;
				
			}else{
				
				$odate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"))->result();
				
				$edate = end($odate)->delivery_date;
//				echo $edate;
				$d = $this->db->delete("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"delivery_date"=>$edate));
				
				echo 0;
				
			}
			
		$uorders = $this->db->order_by("id","desc")->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"));
			
		if($uorders->num_rows() != 30){
			
			if($uorders->num_rows() > 30){
				
				$count = ($uorders->num_rows() - 30);
				
				$this->db->order_by("id","desc")->limit($count)->delete("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid,"pause_status"=>"Inactive"));
				
			}else{
				
				$count = (30 - $uorders->num_rows());
				
				for($i=1; $i<=$count; $i++){
					
					$edate = end($uorders->row()->delivery_date);
					$edate = strtotime($edate);
					$date = strtotime("+1 day", $edate);

					$endDate = date('Y-m-d', $date);

					$data = array("delivery_date"=>$endDate,"order_id"=>$oid,"user_id"=>$uid);

					$d = $this->db->insert("tbl_subscribed_deliveries",$data);
					
				}
				
			}
			
		}
			
// delete last inactive orders			
			
		$linords = $this->db->order_by("id","desc")->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->result();	
			
		$upid = 0;	
		foreach($linords as $lin){
			
			if(($lin->pause_status == "Active") && ($upid==0)){
				
				$this->db->delete("tbl_subscribed_deliveries",array("id"=>$lin->id));
				
			}

			++$upid;
			
		}
			
// update last date
			
			$updatedenddate = $this->db->order_by("id","desc")->get_where("tbl_subscribed_deliveries",array("order_id"=>$oid,"user_id"=>$uid))->row()->delivery_date;

			$data = array("sub_end_date"=>$updatedenddate,"edate"=>date("Y-m-d",strtotime($updatedenddate)));

			$this->db->set($data);
			$this->db->where("order_id",$oid);
			$this->db->update("orders");	


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