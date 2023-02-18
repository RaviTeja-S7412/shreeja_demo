<?php
class Navbar_footer_menu extends CI_Controller {

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
public function allNavbars(){

	$data["nav"] = $this->db->query("select * from fdm_va_navbar_footer_menu where deleted=0 order by id desc")->result();
	$this->load->view("footer_navbar/allFootermenu",$data);

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

public function insertNavbar(){

	$name = $this->input->post("name",true);
	$link = $this->input->post("link",true);
	$target = $this->input->post("target",true);
	$date = date("Y-m-d H:i:s");
	$cby = $this->session->userdata("admin_id");

	$nchk = $this->db->get_where("fdm_va_navbar_footer_menu",array("name"=>$name,"deleted"=>0))->num_rows();
	if($nchk>=1){

			$this->alert->pnotify("error","Footer Menu Name Already Exists","error");
			redirect("menus/footer-menu");
	}
	
	
	$lchk = $this->db->get_where("fdm_va_navbar_footer_menu",array("link"=>$link,"deleted"=>0))->num_rows();
	if($lchk>=1){

			$this->alert->pnotify("error","Menu Link Already Exists","error");
			redirect("menus/footer-menu");
	}

	$data = array(

		"name" => $name,
		"link" => $link,
		"target" => $target,
		"created_date" => $date,
		"created_by" => $cby,
		
	);

	$n = $this->db->insert("fdm_va_navbar_footer_menu",$data);

	if($n){

			$this->alert->pnotify("success","Footer Menu Successfully Added","success");
			redirect("menus/footer-menu");
	}else{

			$this->alert->pnotify("error","Error Occured While Adding Footer Menu","error");
			redirect("menus/footer-menu");
	}

}

public function insertSubmenu(){

	//$id = $this->input->post("id");
	$mname = $this->input->post("menu_id",true);
	$smname = $this->input->post("sub_menu_name",true);
	$link = $this->input->post("sub_menu_link",true);
	$target = $this->input->post("sub_menu_target",true);
	$date = date("Y-m-d H:i:s");
	$cby = $this->session->userdata("admin_id");
//	$meta_title = $this->input->post("meta_title",true);
//	$meta_keyword = $this->input->post("meta_keyword",true);
//	$meta_description = $this->input->post("meta_description",true);
		
	$data = array(
		"footer_menu_name" => $mname,
		"footer_submenu_name" => $smname,
		"footer_submenu_link" => $link,
		"footer_submenu_target" => $target,
		"created_date" => $date,
		"created_by" => $cby,
//		"meta_title" => $meta_title,
//		"meta_keyword" => $meta_keyword,
//		"meta_description" => $meta_description,

	);

	$n = $this->db->insert("fdm_va_navbar_footer_submenu",$data);

	if($n){

			$this->alert->pnotify("success","Navbar Sub Menu Successfully Added","success");
			redirect("menus/edit-footer-menu/".$mname);
	}else{

			$this->alert->pnotify("error","Error Occured While Adding Navbar Sub Menu","error");
			redirect("menus/edit-footer-menu/".$mname);
	}

}
	
	
	
	public function navbarstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("fdm_va_navbar_footer_menu");
		
		if($d){
			if($status=="Active"){
				echo $this->alert->pnotify("Success","Successfully Navbar Menu Enabled","success");
			}else{
				echo $this->alert->pnotify("Success","Successfully Navbar Menu Disabled","success");	
			}

		}else{
			if($status=="Active"){
				echo $this->alert->pnotify("Error","Error Occured While Enabling Navbar Menu","error");
			}else{
				echo $this->alert->pnotify("Error","Error Occured While Disabling Navbar Menu","error");
			}	
		}
		
		
	}
	public function navbarSubmenustatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("fdm_va_navbar_footer_submenu");
		
		if($d){
			if($status=="Active"){
				echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Enabled","success");
			}else{
				echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Disabled","success");	
			}

		}else{
			if($status=="Active"){
				echo $this->alert->pnotify("Error","Error Occured While Enabling Navbar Sub Menu","error");
			}else{
				echo $this->alert->pnotify("Error","Error Occured While Disabling Navbar Sub Menu","error");
			}	
		}
		
		
	}	

public function editNavbar(){

	$id = $this->input->post("id");
	$name = $this->input->post("name",true);
	$link = $this->input->post("link",true);
	$target = $this->input->post("target",true);
	$date = date("Y-m-d H:i:s");
	$uid = $this->session->userdata("admin_id");

	$nchk = $this->db->get_where("fdm_va_navbar_footer_menu",array("name"=>$name,"id"=>$id))->row()->name;

	if($nchk==$name){

		$data = array("name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n =  $this->db->update("fdm_va_navbar_footer_menu");

	}else{
		$nchk1 = $this->db->get_where("fdm_va_navbar_footer_menu",array("name"=>$name,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","Footer Menu Name Already Exists","error");
			redirect("menus/edit-footer-menu/".$id);
		}else{	
		$data = array("name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n = $this->db->update("fdm_va_navbar_footer_menu");
		}
	}
	
	$lchk = $this->db->get_where("fdm_va_navbar_footer_menu",array("link"=>$link,"id"=>$id))->row()->link;

	if($lchk==$link){

		$data = array("link" => $link);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n =  $this->db->update("fdm_va_navbar_footer_menu");

	}else{
		$lchk1 = $this->db->get_where("fdm_va_navbar_footer_menu",array("link"=>$link,"deleted"=>0))->num_rows();	
		if($lchk1>=1){
			$this->alert->pnotify("error","Menu Link Already Exists","error");
			redirect("menus/edit-footer-menu/".$id);
		}else{	
		$data = array("link" => $link);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n = $this->db->update("fdm_va_navbar_footer_menu");
		}
	}
	
	
	$data = array("target"=>$target,"updated_date"=>$date,"updated_by" => $uid);
			 
		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $n = $this->db->update("fdm_va_navbar_footer_menu");	
	
	if($n){

			$this->alert->pnotify("success","Footer Menu Successfully Updated","success");
			redirect("menus/footer-menu");
	}else{

			$this->alert->pnotify("error","Error Occured While Updating Footer Menu","error");
			redirect("menus/footer-menu");
	}


	}

public function editNavbarsubmenu(){


	$id = $this->input->post("id");
	$mname = $this->input->post("menu_name",true);
	$smname = $this->input->post("sub_menu_name",true);
	$link = $this->input->post("sub_menu_link",true);
	$target = $this->input->post("sub_menu_target",true);
	$date = date("Y-m-d H:i:s");
	$cby = $this->session->userdata("admin_id");
//	$meta_title = $this->input->post("meta_title",true);
//	$meta_keyword = $this->input->post("meta_keyword",true);
//	$meta_description = $this->input->post("meta_description",true);
	
//	$lchk = $this->db->get_where("fdm_va_navbar_footer_submenu",array("footer_submenu_link"=>$link,"id"=>$id))->row()->footer_submenu_link;

//	if($lchk==$link){
//
//		$data = array("footer_submenu_link" => $link);
//
//		 $this->db->set($data);
//		 $this->db->where("id",$id);
//		 $n =  $this->db->update("fdm_va_navbar_footer_submenu");
//
//	}else{
//		$lchk1 = $this->db->get_where("fdm_va_navbar_footer_submenu",array("footer_submenu_link"=>$link,"deleted"=>0))->num_rows();	
//		if($lchk1>=1){
//			$this->alert->pnotify("error","Menu Link Already Exists","error");
//			redirect("menus/edit-footer-sub-menu/".$id);
//		}else{	
//		$data = array("footer_submenu_link" => $link);
//
//		 $this->db->set($data);
//		 $this->db->where("id",$id);
//		 $n = $this->db->update("fdm_va_navbar_footer_submenu");
//		}
//	}
	
	$data = array(
		"footer_submenu_link" => $link,
		"footer_menu_name" => $mname,
		"footer_submenu_name" => $smname,
		"footer_submenu_target" => $target,
		"updated_date" => $date,
		"updated_by" => $cby,
//		"meta_title" => $meta_title,
//		"meta_keyword" => $meta_keyword,
//		"meta_description" => $meta_description,

	);
	$this->db->set($data);
	$this->db->where("id",$id);
	$n = $this->db->update("fdm_va_navbar_footer_submenu");		
	if($n){

			$this->alert->pnotify("success","Navbar Sub Menu Successfully Updated","success");
			redirect("menus/edit-footer-sub-menu/".$id);
	}else{

			$this->alert->pnotify("error","Error Occured While Updating Navbar Sub Menu","error");
			redirect("menus/edit-footer-sub-menu/".$id);
	}


	}


public function delNavbar($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("fdm_va_navbar_footer_menu");

	if($d){
			$data = array("deleted"=>1,"status"=>"Inactive");
			$this->db->set($data);
			$this->db->where("footer_menu_name",$id);
			$d = $this->db->update("fdm_va_navbar_footer_submenu");

			$this->alert->pnotify("success","Navbar Menu Successfully Deleted","success");
			redirect("menus/footer-menu");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Navbar Menu","error");
			redirect("menus/footer-menu");
	}
}

public function delNavbarSubmenu($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("fdm_va_navbar_footer_submenu");

	if($d){

			$this->alert->pnotify("success","Navbar Sub Menu Successfully Deleted","success");
			redirect("menus/edit-footer-menu/".$id);
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Navbar Sub Menu","error");
			redirect("menus/edit-footer-menu/".$id);
	}
}


}
