<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends CI_Controller {
public function __construct(){
			
	parent::__construct();
	$this->secure->loginCheck();


}
public function index(){
	
	$this->load->view("products/categories/categories");

}

public function editCategory($id){
	
	$data["cat"] = $this->db->get_where("tbl_categories",array("id"=>$id))->row();
	$this->load->view("products/categories/categories",$data);

}
public function insertCategory(){
	
	$cname = $this->input->post("cat_name");
	
	$cchk = $this->db->get_where("tbl_categories",array("category_name"=>$cname))->num_rows();
	
	if($cchk == 1){
		
		$this->alert->pnotify("error","Category Already Exists","error");
		
		redirect("products/categories");
		
	}
	
	
	$data = array("category_name" => $cname, "created_date" => date("Y-m-d H:i:s"));

	$c = $this->db->insert("tbl_categories",$data);
	
	if($c){
			
			$this->alert->pnotify("success","Category Created Successfully","success");
			redirect("products/categories");
			
	}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("products/categories");
	}
	
	
}


public function updateCategory(){
	
	$id = $this->input->post("cid");
	$cname = $this->input->post("cat_name");
	
	
	$nchk = $this->db->get_where("tbl_categories",array("category_name"=>$cname,"id"=>$id,"deleted"=>0))->row()->category_name;

	if($nchk==$cname){

		$data = array("category_name" => $cname);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("tbl_categories");
		
		 $this->alert->pnotify("success","Category Updated Successfully","success");
		 redirect("products/categories");
		
		

	}else{
		$nchk1 = $this->db->get_where("tbl_categories",array("category_name"=>$cname,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","Category Already Exists","error");
			redirect("products/edit-category/".$id);
		}else{	
		$data = array("category_name" => $cname);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("tbl_categories");
			
		 $this->alert->pnotify("success","Category Updated Successfully","success");
		 redirect("products/categories");
			
			
		}
	}
	
	
	
	if($c){
			
			$this->alert->pnotify("success","Category Updated Successfully","success");
			redirect("products/categories");
			
	}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("products/categories");
	}
	
	
}	
	

	

public function delRoute(){
	
	$rtype = $this->input->post("rdtype");
	$rid = $this->input->post("rdid");
	

	if($rtype == "mainmenu"){
		
		$mm = $this->db->delete("fdm_va_navbar_header_routes",array("id"=>$rid,"type"=>$rtype));
		
		if($mm){
			
			$this->alert->pnotify("success","Route Deleted Successfully","success");
			redirect("routes");
			
		}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("routes");
		}
		
	}elseif($rtype == "footermenu"){
		
		$fm = $this->db->delete("fdm_va_navbar_footer_routes",array("id"=>$rid,"type"=>$rtype));
		
		if($fm){
			
			$this->alert->pnotify("success","Route Deleted Successfully","success");
			redirect("routes");
			
		}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("routes");
		}
		
		
	}elseif($rtype == "topmenu"){
		
		$tm = $this->db->delete("fdm_va_navbar_minibar_routes",array("id"=>$rid,"type"=>$rtype));
		
		if($tm){
			
			$this->alert->pnotify("success","Route Deleted Successfully","success");
			redirect("routes");
			
		}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("routes");
		}
		
		
	}elseif($rtype == "locationmenu"){
		
		$lm = $this->db->delete("fdm_va_cms_location_routes",array("id"=>$rid,"type"=>$rtype));
		
		if($lm){
			
			$this->alert->pnotify("success","Route Deleted Successfully","success");
			redirect("routes");
			
		}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("routes");
		}
		
		
	}

}	





}
