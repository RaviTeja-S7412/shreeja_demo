
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Stylemanager extends CI_Controller {

	
public function __construct(){
			
		   parent::__construct();

		$id = $this->session->userdata("admin_id");
	
		$userstatus = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row()->status;
	
		if($userstatus != "Active"){
		   $msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Login To Access Dashboard</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");
		}

 }	

public function index(){
	
	$this->load->view("superadmin/stylemanager/style_manager");
	
}
	
public function updateStyle(){
	
	$style = $this->input->post("style");
	
	$up = file_put_contents("assets/front/css/style.css",$style);
	
	if($up > 0){
		
			$this->alert->pnotify("success","Styles Successfully Updated","success");
			redirect("style-manager");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Styles","error");
			redirect("style-manager");
	}
	
	
}
	
	
	
}