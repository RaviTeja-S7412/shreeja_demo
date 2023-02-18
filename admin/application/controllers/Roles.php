<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Roles extends CI_Controller {
	
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
	
}

public function index(){

	$data["roles"] = $this->db->get_where("fdm_va_roles",array("id!="=>1))->result();
	$this->load->view("roles/allRoles",$data);

}

	
	
public function editRole($id){

	$data["u"] = $this->db->get_where("fdm_va_roles",array("id"=>$id))->row();
	$this->load->view("roles/editRole",$data);
}
	
public function udpate_permissions(){
			
	$role_id = $this->uri->segment(3);
	$moduleid = $this->input->post("moduleid");
	$smodule = $this->input->post("smoduleid");

//	print_r($moduleid);
//	
//	echo json_encode(array("module_id"=>$moduleid,"sub_module_id"=>$moduleid));
	
	$submodules = array();
	for($j=0;$j<sizeof($moduleid);$j++) {
		$submodules[$j] = $this->input->post("smoduleid".$moduleid[$j]);
	}
	
	
	
	$data2 = array(); 
	for($i=0;$i<sizeof($moduleid);$i++) {
		
			$data2[$i] = array("module_id"=>$moduleid[$i],"sub_module_id"=>$submodules[$i]);			
		
	}
	
	
		if(count($moduleid) > 0){
			
			$rchk = $this->db->get_where("fdm_va_admin_role_access",array("role_id"=>$role_id))->num_rows();
			
			if($rchk == 1){
				
				$d = $this->db->where("role_id",$role_id)->update("fdm_va_admin_role_access",array("modules"=> json_encode($data2)));
				
			}else{
				
				$d = $this->db->insert("fdm_va_admin_role_access",array("role_id"=>$role_id,"modules"=>json_encode($data2)));
				
			}
	
							
		}else{
	// deleting all modules for user
			$data = array("role_id"=>$role_id);
			$this->db->delete("fdm_va_admin_role_access",$data);
		}

		redirect("roles/editRole/".$role_id);
		
}

}