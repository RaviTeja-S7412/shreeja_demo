<?php
class Navbar_optionsbar extends CI_Controller {

public function __construct(){
			
		parent::__construct();
		$id = $this->session->userdata("admin_id");
		if(!$id){
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
public function allOptionsbars(){

	$data["opt"] = $this->db->query("select * from fdm_va_navbar_optionsbar where deleted=0 order by id desc")->result();
	$this->load->view("navbar/optionsbar/allOptionsbar",$data);

}

public function updateNavbar($id){

	$data["n"] = $this->db->get_where("fdm_va_navbar_footer_menu",array("id"=>$id))->row();
	$data["smenu"] = $this->db->query("select * from fdm_va_navbar_footer_submenu where deleted=0  and footer_menu_name=$id order by id desc")->result();
	$this->load->view("footer_navbar/editFootermenu",$data);

}

public function insertOptionsbar(){

	$name = $this->input->post("title",true);
	$date = date("Y-m-d H:i:s");
	$cby = $this->session->userdata("admin_id");

	  	$config['upload_path']          = "uploads/options/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name']             = TRUE;
		$config['max_width']            = 80;
        $config['max_height']           = 80;
		
        $this->load->library('upload', $config);
		
		if($this->upload->do_upload("icon")){
		
		$d=$this->upload->data();
		
 			$icon = "uploads/options/".$d['file_name'];
 		
 		}else{

 			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("navbar/optionsbar");

 		}


	$chk = $this->db->get_where("fdm_va_navbar_optionsbar",array("title"=>$name,"deleted"=>0))->num_rows();
	if($chk>=1){

			$this->alert->pnotify("error","Option Already Exists","error");
			redirect("navbar/optionsbar");
	}

	$data = array(

		"title" => $name,
		"icon" => $icon,
		"created_date" => $date,
		"created_by" => $cby

	);

	$n = $this->db->insert("fdm_va_navbar_optionsbar",$data);

	if($n){

			$this->alert->pnotify("success","Option Successfully Added","success");
			redirect("navbar/optionsbar");
	}else{

			$this->alert->pnotify("error","Error Occured While Adding Option","error");
			redirect("navbar/optionsbar");
	}

}

	public function optionstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("fdm_va_navbar_optionsbar");
		
		if($d){
			if($status=="Active"){
				echo $this->alert->pnotify("Success","Successfully Option Enabled","success");
			}else{
				echo $this->alert->pnotify("Success","Successfully Option Disabled","success");	
			}

		}else{
			if($status=="Active"){
				echo $this->alert->pnotify("Error","Error Occured While Enabling Option","error");
			}else{
				echo $this->alert->pnotify("Error","Error Occured While Disabling Option","error");
			}	
		}
		
		
	}


public function updateOptionsbar(){

	$id = $this->input->post("opt_id");
	$name = $this->input->post("title",true);
	$date = date("Y-m-d H:i:s");
	$uby = $this->session->userdata("admin_id");

	$option = $this->db->get_where("fdm_va_navbar_optionsbar",array("id"=>$id,"deleted"=>0))->row();

	if($_FILES['icon']['size']!='0'){
			//profile pic uploading
		$config['upload_path']          = "uploads/options/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name']             = TRUE;
		$config['max_width']            = 80;
        $config['max_height']           = 80;
		
        $this->load->library('upload', $config);
		
		if($this->upload->do_upload("icon")){
		
		$d=$this->upload->data();
		
 			$icon = "uploads/options/".$d['file_name'];
 			unlink($option->icon);
 		
 		}else{

 			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("navbar/optionsbar/".$id);

 		}


 		
			
		}else{
			
			
			$icon=$option->icon;
			
		}

	$nchk = $this->db->get_where("fdm_va_navbar_optionsbar",array("title"=>$name,"id"=>$id))->row()->title;

	if($nchk==$name){

		$data = array("title" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n =  $this->db->update("fdm_va_navbar_optionsbar");

	}else{
		$nchk1 = $this->db->get_where("fdm_va_navbar_optionsbar",array("title"=>$name,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","Option Already Exists","error");
			redirect("navbar/optionsbar/".$id);
		}else{	
		$data = array("title" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n = $this->db->update("fdm_va_navbar_optionsbar");
		}
	}

	$data = array(

		"icon" => $icon,
		"updated_date" => $date,
		"updated_by" => $uby

	);
		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n = $this->db->update("fdm_va_navbar_optionsbar");
		
	if($n){

			$this->alert->pnotify("success","Option Successfully Updated","success");
			redirect("navbar/optionsbar/".$id);
	}else{

			$this->alert->pnotify("error","Error Occured While Updating Option","error");
			redirect("navbar/optionsbar/".$id);
	}


	}



public function delOptionbar($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("fdm_va_navbar_optionsbar");

	if($d){
			
			$this->alert->pnotify("success","Option Successfully Deleted","success");
			redirect("navbar/optionsbar");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Option","error");
			redirect("navbar/optionsbar");
	}
}



}
