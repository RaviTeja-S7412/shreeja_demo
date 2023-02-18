<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

public function __construct(){
			
		   parent::__construct();
	
 }

public function index(){
	
	$this->load->view("products");

}
	
public function sampleOrder(){
	
	
	$uid = $this->session->userdata("user_id");									

	if($uid){

		$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$uid,"order_status"=>"Success"))->num_rows();

		if($sordChk == 1){

			$data["oc"] = "You have already requested for “Free sample”, will deliver you shortly.";
			$data["products"] = "";

		}else{
			
			$data["products"] = $this->db->get_where("tbl_sample_products",array("status"=>"Active"))->result();
			$data["oc"] = "";
		}

	}	
	
	$this->load->view("sampleOrderproducts",$data);

}	
	





}