<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {

public function __construct(){
			
	parent::__construct();
		
	$this->secure->loginCheck();
}
	
	
public function index($id = "")
	{
		$this->load->view('faqs/faqs');
	}

	
public function insertQue(){
	
	$que = $this->input->post("question");
	$ans = $this->input->post("answer");
	$date = date("Y-m-d H:i:s");
	
	$data = array("question"=>$que,"answers"=>$ans,"created_date"=>$date);
	
	$qi = $this->db->insert("tbl_faqs",$data);
	
	if($qi){
		
			$this->alert->pnotify("success","Question Successfully Added","success");
			redirect("faqs");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Adding Question","error");
			redirect("faqs");
	}
	
}	
	

public function updateQue(){
	
	$id = $this->input->post("faq_id");
	$que = $this->input->post("question");
	$ans = $this->input->post("answer");
	$date = date("Y-m-d H:i:s");
	
	$data = array("question"=>$que,"answers"=>$ans,"created_date"=>$date);
	
	
	$this->db->set($data);
	$this->db->where("id",$id);
	$qi = $this->db->update("tbl_faqs");
	
	if($qi){
		
			$this->alert->pnotify("success","Question Successfully Updated","success");
			redirect("faqs");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Question","error");
			redirect("faqs");
	}
	
}	
	
public function delQue($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("tbl_faqs");

	if($d){
			$this->alert->pnotify("success","Question Successfully Deleted","success");
			redirect("faqs");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Question","error");
			redirect("faqs");
	}
}	
	
}