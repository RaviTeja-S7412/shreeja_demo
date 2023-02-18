<?php
class Navbar_minibar extends CI_Controller {

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
public function allMinibars(){

	$data["nav"] = $this->db->query("select * from fdm_va_navbar_minibar where deleted=0 order by id desc")->result();
	$this->load->view("navbar/minibar/allMinibars",$data);

}

public function updateNavbar($id){

	$data["n"] = $this->db->get_where("fdm_va_navbar_footer_menu",array("id"=>$id))->row();
	$data["smenu"] = $this->db->query("select * from fdm_va_navbar_footer_submenu where deleted=0  and footer_menu_name=$id order by id desc")->result();
	$this->load->view("footer_navbar/editFootermenu",$data);

}

public function updateSubmenu($id){

	$data["sm"] = $this->db->get_where("fdm_va_navbar_footer_submenu",array("id"=>$id))->row();
	$data["smenu"] = $this->db->query("select * from fdm_va_navbar_footer_submenu where deleted=0 and id=$id order by id desc")->result();
	$this->load->view("footer_navbar/editFooterSubmenu",$data);

}

public function insertMinibar(){

	$name = $this->input->post("name",true);
	$link = $this->input->post("link",true);
	$target = $this->input->post("target",true);
	$date = date("Y-m-d H:i:s");
	$cby = $this->session->userdata("admin_id");
//	$meta_title = $this->input->post("meta_title",true);
//	$meta_keyword = $this->input->post("meta_keyword",true);
//	$meta_description = $this->input->post("meta_description",true);
	
	
	$chk = $this->db->get_where("fdm_va_navbar_minibar",array("name"=>$name,"deleted"=>0))->num_rows();
	if($chk>=1){

			$this->alert->pnotify("error","Menu Name Already Exists","error");
			redirect("menus/top-menu");
	}
	
	$lchk = $this->db->get_where("fdm_va_navbar_minibar",array("link"=>$link,"deleted"=>0))->num_rows();
	if($lchk>=1){

			$this->alert->pnotify("error","Link Already Exists","error");
			redirect("menus/top-menu");
	}

	$data = array(

		"name" => $name,
		"link" => $link,
		"target" => $target,
		"created_date" => $date,
		"created_by" => $cby,
//		"meta_title" => $meta_title,
//		"meta_keyword" => $meta_keyword,
//		"meta_description" => $meta_description,
	
	);

	$n = $this->db->insert("fdm_va_navbar_minibar",$data);

	if($n){

			$this->alert->pnotify("success","Menu Successfully Added","success");
			redirect("menus/top-menu");
	}else{

			$this->alert->pnotify("error","Error Occured While Adding Menu","error");
			redirect("menus/top-menu");
	}

}

	public function navbarstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("fdm_va_navbar_minibar");
		
		if($d){
			if($status=="Active"){
				echo $this->alert->pnotify("Success","Successfully Menu Enabled","success");
			}else{
				echo $this->alert->pnotify("Success","Successfully Menu Disabled","success");	
			}

		}else{
			if($status=="Active"){
				echo $this->alert->pnotify("Error","Error Occured While Enabling Menu","error");
			}else{
				echo $this->alert->pnotify("Error","Error Occured While Disabling Menu","error");
			}	
		}
		
		
	}


public function updateMinibar(){

	$id = $this->input->post("mini_id");
	$name = $this->input->post("name",true);
	$link = $this->input->post("link",true);
	$target = $this->input->post("target",true);
	$date = date("Y-m-d H:i:s");
	$uby = $this->session->userdata("admin_id");
//	$meta_title = $this->input->post("meta_title",true);
//	$meta_keyword = $this->input->post("meta_keyword",true);
//	$meta_description = $this->input->post("meta_description",true);
	
	
	$nchk = $this->db->get_where("fdm_va_navbar_minibar",array("name"=>$name,"id"=>$id))->row()->name;

	if($nchk==$name){

		$data = array("name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n =  $this->db->update("fdm_va_navbar_minibar");

	}else{
		$nchk1 = $this->db->get_where("fdm_va_navbar_minibar",array("name"=>$name,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","Menu Name Already Exists","error");
			redirect("menus/top-menu/".$id);
		}else{	
		$data = array("name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n = $this->db->update("fdm_va_navbar_minibar");
		}
	}
	
	$lchk = $this->db->get_where("fdm_va_navbar_minibar",array("link"=>$link,"id"=>$id))->row()->link;

	if($lchk==$link){

		$data = array("link" => $link);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_navbar_minibar");

	}else{
		$lchk1 = $this->db->get_where("fdm_va_navbar_minibar",array("link"=>$link,"deleted"=>0))->num_rows();	
		if($lchk1>=1){
			$this->alert->pnotify("error","Link Already Exists","error");
			redirect("menus/top-menu/".$id);
		}else{	
		$data = array("link" => $link);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_navbar_minibar");
		}
	}	


	$data = array(
		"link" => $link,
		"target" => $target,
		"updated_date" => $date,
		"updated_by" => $uby,
//		"meta_title" => $meta_title,
//		"meta_keyword" => $meta_keyword,
//		"meta_description" => $meta_description,
	);

		$this->db->set($data);
		 $this->db->where("id",$id);
		 $n = $this->db->update("fdm_va_navbar_minibar");
		
	if($n){

			$this->alert->pnotify("success","Menu Successfully Updated","success");
			redirect("menus/top-menu/".$id);
	}else{

			$this->alert->pnotify("error","Error Occured While Updating Menu","error");
			redirect("menus/top-menu/".$id);
	}


	}



public function delMinibar($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("fdm_va_navbar_minibar");

	if($d){
			
			$this->alert->pnotify("success","Menu Successfully Deleted","success");
			redirect("menus/top-menu");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Menu","error");
			redirect("menus/top-menu");
	}
}



}
