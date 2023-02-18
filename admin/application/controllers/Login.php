<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

public function __construct(){
			
		   parent::__construct();
			
	}

public function index(){


		$this->load->view("login");
}



function do_login(){

		$email = $this->input->post("email",true);
		$pass = $this->input->post("pass");

		if(empty($email)){
			$msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Enter User Name</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");

		}
		if(empty($pass)){
			$msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Enter Password</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");
		}
		$a = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$email,"deleted"=>0,"status"=>"Active"))->row();

if($a){


			$chk1 = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$email,"deleted"=>0,"status"=>"Active"))->num_rows();
			if($chk1==1){

			$u = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$email,"deleted"=>0,"status"=>"Active"))->row();
			$cpassword = $this->secure->decrypt($u->password);

			if($pass==$cpassword){
				
					$date = date("Y-m-d H:i:s");
					$data = array("last_logged_in"=>$date);

					$this->db->set($data);
					$this->db->where("id",$u->id);
					$this->db->update("fdm_va_auths");

					$this->session->set_userdata(array("admin_id"=>$u->id,"email"=>$u->email));
					redirect("dashboard");
					
			}else{

				$msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Enter Correct Password</div>';	
				$this->session->set_flashdata("fmsg",$msg);
				redirect("login");	
			}
		}else{
			$msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Enter Correct Email Address</div>';	
				$this->session->set_flashdata("fmsg",$msg);
				redirect("login");
		}

	
}else{
	$msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>User Not Registered With Us Or Please Contact Administrator</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");
}	
}


}