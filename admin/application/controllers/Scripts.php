<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Scripts extends CI_Controller {
	
	public function __construct(){

		parent::__construct();

	}

	public function index(){

		 $begin = new DateTime( "13-09-2020" );
		 $end   = new DateTime( "12-10-2020" );

		for($i = $begin; $i <= $end; $i->modify('+1 day')){

			$ddate = $i->format("Y-m-d");

			$data = array("delivery_date"=>$ddate,"order_id"=>"ORD19300003956","user_id"=>2135);

			$this->db->insert("tbl_subscribed_deliveries",$data);

		}

	}
	
	public function addagentproducts(){
		
		$products = $this->db->get_where("tbl_products",["assigned_to"=>"agents","deleted"=>0])->result_array();
		$locations = $this->db->get_where("tbl_locations",["assign_to"=>"agents","deleted"=>0])->result();
		
		echo '<pre>';
		foreach($locations as $loc){
			
			foreach($products as $p){
				
				if($loc->id != json_decode($p["location"])[0]){
				
					unset($p["id"]);
					$p["location"] = json_encode([$loc->id]);
					$this->db->insert("tbl_products",$p);
				
					print_r($p);
				}
				
			}
			
		}
		
	}
	
	
	public function updatecostumerReferalids(){
		
		$customers = $this->db->get_where("shreeja_users")->result();
		
		foreach($customers as $cus){
			
			$rid = $this->admin->generateReferralid();
			$this->db->where(["userid"=>$cus->userid])->update("shreeja_users",["referral_id"=>$rid]);
			
		}
		
	}
	
	public function updateagentsReferalids(){
		
		$customers = $this->db->get_where("fdm_va_auths")->result();
		
		foreach($customers as $cus){
			
			$rid = $this->admin->generateReferralid();
			$this->db->where(["id"=>$cus->id])->update("fdm_va_auths",["referral_id"=>$rid]);
			
		}
		
	}
	

}