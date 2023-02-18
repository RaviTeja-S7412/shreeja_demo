<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metadata extends CI_Controller {
	
public function __construct(){
			
		parent::__construct();
		$id = $this->session->userdata("admin_id");
	
		$userstatus = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row()->status;
	
		if($userstatus != "Active"){
		   $msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Login To Access Users</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");
		}
	$ar = $this->db->get_where("fdm_va_roles",array("id"=>$id))->row();	
	//$arole = $ar->role_name;
	if($id==1){

	}else{

		   $url = $this->uri->segment(1);

		   $m = $this->db->get_where("fdm_va_modules",array("module_link"=>$url))->row();

		   $ua = $this->db->get_where("fdm_va_admin_role_access",array("user_id"=>$id,"module_id"=>$m->module_id))->row();

				if($m->module_id==$ua->module_id){
				   // echo "yes";

				}else{
				   //echo "no";
				   redirect("dashboard/error_module");
				}

	}	
}
public function index(){

	$this->load->view("superadmin/metaData/metaData");

}
	
	

	
public function updateMeta(){
	
	$pid = $this->input->post("pid");
	$meta_title = $this->input->post("meta_title",true);
	$meta_keyword = $this->input->post("meta_keyword",true);
	$meta_description = $this->input->post("meta_description",true);
	
	$data = array("meta_title"=>$meta_title,"meta_keyword"=>$meta_keyword,"meta_description"=>$meta_description);
	
	$this->db->set($data);
	$this->db->where("id",$pid);
	$ce = $this->db->update("pages");
	
	if($ce){
	    $this->alert->pnotify("success","Meta Data Successfully Updated","success");
		redirect("meta-data");
    }else{
      	$this->alert->pnotify("error","Error Occured While Updating Meta Data","error");
		redirect("meta-data");
    }
	
}	


}
