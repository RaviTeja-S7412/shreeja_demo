<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Nonprofitsassociations extends CI_Controller {
public function __construct(){
			
		parent::__construct();
		$id = $this->session->userdata("admin_id");
		if(!$id){
		   $msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Login To Access Users</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");
		}
	$ar = $this->db->get_where("fdm_va_roles",array("id"=>$id))->row();	
if($id==1){

}else{
	
	   $url = $this->uri->segment(1);

	   $m = $this->db->get_where("fdm_va_modules",array("module_link"=>$url))->row();
        
   	   $ua = $this->db->get_where("fdm_va_admin_role_access",array("user_id"=>$id,"module_id"=>$m->module_id))->row();
                     
            if($m->module_id==$ua->module_id){
               
            }else{
               redirect("dashboard/error_module");
            }

	

}

}

public function editPage(){

	$this->load->view("pages/businessBanking/innerpages/childPages/nonprofitsassociations");
}




  
  public function updateLayout(){
  	$layout_id = $this->input->post("layout_id");
  	$page_id = $this->input->post("page_id");
  	$component_ids = json_encode($this->input->post("component_ids"));
	$created_by = $this->session->userdata("admin_id");
	$created_date = date("Y-m-d");

	if($component_ids=='null'){
      	$this->alert->pnotify("error","Please Select Atleast One Component","error");
      	redirect("business-banking/industries-served/govcon-banking");
	}

	// $pchk = $this->db->get_where("fdm_va_inner_pages_layout",array("page_id"=>$page_id))->num_rows();

	// if($pchk>=1){
	// 	$this->alert->pnotify("error","Layout Already Created","error");
 //      	redirect("customer-banking/checking");
	// }

	$data = array(
		"page_id" => $page_id,
		"component_ids" => $component_ids,
		"created_by" => $created_by,
		"created_date" => $created_date
	);

			$this->db->set($data);
			$this->db->where("id",$layout_id);
	$layout = $this->db->update("fdm_va_inner_pages_layout");


	if($layout){
	   $this->alert->pnotify("success","Layout Successfully Updated","success");
		redirect("business-banking/industries-served/govcon-banking");
    }else{
      	$this->alert->pnotify("error","Error Occured While Updating Layout","error");
		redirect("business-banking/industries-served/govcon-banking");
    }

}

  public function delComponent($id){


	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$dd = $this->db->update("fdm_va_customer_banking_checking_components");

	if($dd){
	  $this->alert->pnotify("success","Component Successfully Deleted","success");
		//redirect("pages/news-and-community/".$pid);
      }else{
      	$this->alert->pnotify("error","Error Occured While Deleting Component","error");
		//redirect("pages/news-and-community/".$pid);
      }

}




/* End Services  */



public function updateComponentstatus(){

   $id = $this->input->post_get("id",true);

   $ia = $this->db->get_where("fdm_va_customer_banking_checking_components",array("id"=>$id))->row();

   if($ia->status=="Active"){
	   $data = array("status"=>"Inactive","updated_by"=>$this->session->userdata("admin_id"));
	   $this->db->set($data);
	   $this->db->where("id",$id);
	   $up = $this->db->update("fdm_va_customer_banking_checking_components");
	   if($up){
	   		echo 1;
	   }else{
	   		echo 0;
	   }
   }elseif($ia->status=="Inactive"){

	   $data = array("status"=>"Active","updated_by"=>$this->session->userdata("admin_id"));
	   $this->db->set($data);
	   $this->db->where("id",$id);
	   $up = $this->db->update("fdm_va_customer_banking_checking_components");
	   if($up){
	   		echo 2;
	   }else{
	   		echo 0;
	   }


   }
}






public function updateBanner(){
	
	$bid = $this->input->post("bid");
	$pageid = $this->input->post("page_id");
	$innerpageid = $this->input->post("inner_page_id");
	$btext = $this->input->post("banner_text");
	$uid = $this->session->userdata("admin_id");
	$date = date("Y-m-d");

	$bi = $this->db->get_where("fdm_va_innerpages_banner_images",array("id"=>$bid))->row();


	    if($_FILES['banner_image']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/banners/inner_pages/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['encrypt_name']             = TRUE;
				$config['max_width']            = 1920;
				$config['max_height']           = 480;	
		
                $this->load->library('upload', $config);
		
		$dd=$this->upload->do_upload("banner_image");
			
			if($dd){
				$d=$this->upload->data();

				$bimage = 'uploads/banners/inner_pages/'.$d['file_name'];

				unlink($bi->banner_image);
			}else{
				$this->alert->pnotify("error","Please Select Valid Image","error");
				redirect("business-banking/industries-served/non-profits-associations");
			}
		}else{
			
			
			$bimage=$bi->banner_image;
			
		}

		$data = array(

			"banner_text" => $btext,
			"banner_image" => $bimage,
			"page_id" => $pageid,
			"inner_page_id" => $innerpageid,
			"updated_by" => $uid,
			"updated_date" => $date	

		);

		$this->db->set($data);
		$this->db->where("id",$bid);
		$banner = $this->db->update("fdm_va_innerpages_banner_images");

	  if($banner){
        $this->alert->pnotify("success","Banner Image Successfully Updated","success");
		redirect("business-banking/industries-served/non-profits-associations");
      }else{
      	$this->alert->pnotify("error","Error Occured While Updating Banner Image","error");
		redirect("business-banking/industries-served/non-profits-associations");
      }
}

/* Banner ends */


/* component */ 


/* end component */

/* Customer banking ends */


}
