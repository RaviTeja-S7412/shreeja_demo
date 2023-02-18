<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

	$this->load->view("dashboard");

}



public function updateProfile(){

	$this->load->view("profile.php");
}

public function editProfile(){
if($this->session->userdata("admin_id")){
	$id = $this->session->userdata("admin_id");
	$aname = $this->input->post("admin_name",true);
	$aemail = $this->input->post("admin_email",true);
	$echk = $this->db->get_where("fdm_va_auths",array("email"=>$aemail,"id"=>$id))->row()->email;

	if($echk==$aemail){

		$data = array("email" => $aemail);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");

	}else{
		$echk1 = $this->db->get_where("fdm_va_auths",array("email"=>$aemail))->num_rows();	
		if($echk1>=1){
			$this->alert->pnotify("error","Email Already Registered","error");
			redirect("admin/profile");
		}else{	
		$data = array("email" => $aemail);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");
		}
	}
	
$ea = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row();
	
	
if($_FILES['profile_pic']['size']!='0'){
	
	$config['upload_path']          = 'uploads/admin/profile/';
    $config['allowed_types']        = 'jpg|jpeg';
//    $config['encrypt_name']             = TRUE;
	$config['overwrite'] = TRUE;
	
	
    $this->load->library('upload', $config);
		
	$this->upload->do_upload("profile_pic");
		
	$d=$this->upload->data();
		
	$profile_pic='uploads/admin/profile/'.$d['file_name'];

}

	$data = array("name"=>$aname,"profile_pic"=>$profile_pic);
	$this->db->set($data);
	$this->db->where("id",$id);
	$au = $this->db->update("fdm_va_auths");

	if($au){
		$this->alert->pnotify("success","Profile Successfully Updated","success");
		redirect("admin/profile");
	}else{
		$this->alert->pnotify("error","Error Occured While Updating Profile","error");
		redirect("admin/profile");
	}

}

}


public function changePassword(){

	$opass = $this->input->post("opass",true);
	$npass = $this->input->post("npass",true);
	$cpass = $this->input->post("cpass",true);

	$aid = $this->session->userdata("admin_id");


		$a = $this->db->get_where("fdm_va_auths",array("id"=>$aid))->row();
		$op = $this->secure->decrypt($a->password);

		if($opass==$op){

			if($npass!=$cpass){
				$this->alert->pnotify("error","Passwords Do Not Match","error");
				redirect("admin/profile");
			}
			$data = array("password"=>$this->secure->encrypt($npass));
			$this->db->set($data);
			$this->db->where("id",$aid);
			$pp = $this->db->update("fdm_va_auths");
			if($pp){
				$this->alert->pnotify("success","Password Successfully Updated","success");
				redirect("admin/profile");
			}else{
				$this->alert->pnotify("error","Error Occured While Updating Your Password Please Try Again","error");
				redirect("admin/profile");
			}

		}else{
			$this->alert->pnotify("error","Please Enter Old Password Correctly","error");
			redirect("admin/profile");
		}
	}
	// elseif($uid){
	// 	$u = $this->db->get_where("fdm_va_users",array("id"=>$uid))->row();
	// 	$opp = $this->secure->decrypt($u->user_password);

	// 	if($opass==$opp){

	// 		if($npass!=$cpass){
	// 			$this->alert->pnotify("error","Passwords Do Not Match","error");
	// 			redirect("admin/profile");
	// 		}
	// 		$data1 = array("user_password"=>$this->secure->encrypt($npass));
	// 		$this->db->set($data1);
	// 		$this->db->where("id",$uid);
	// 		$pp = $this->db->update("fdm_va_users");
	// 		if($pp){
	// 			$this->alert->pnotify("success","Password Successfully Updated","success");
	// 			redirect("admin/profile");
	// 		}else{
	// 			$this->alert->pnotify("error","Error Occured While Updating Your Password Please Try Again","error");
	// 			redirect("admin/profile");
	// 		}

	// 	}else{
	// 		$this->alert->pnotify("error","Please Enter Old Password Correctly","error");
	// 		redirect("admin/profile");
	// 	}


	// }

//}

public function logout(){
		$this->session->sess_destroy();
		redirect("login");
}	

public function error_module(){

	$this->load->view("error-404");
}

}