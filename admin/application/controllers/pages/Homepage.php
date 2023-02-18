<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Homepage extends CI_Controller {
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
}

public function index($id = ""){
	
	$this->load->view("pages/homepage/HomePage");
}


public function updateBanner(){
	
	$bid = $this->input->post("bid");
	$btext = $this->input->post("banner_text");
	$date = date("Y-m-d");

	$bi = $this->db->get_where("fdm_va_home_slider_images",array("id"=>$bid))->row();


	    if($_FILES['banner_image']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/home_slider_images/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
//                $config['encrypt_name']             = TRUE;
				$config['max_width']            = 1720;
				$config['max_height']           = 800;	
				$config['min_width']            = 1280;
				$config['min_height']           = 380;				
                $this->load->library('upload', $config);
		
		$dd=$this->upload->do_upload("banner_image");
			if($dd){
				$d=$this->upload->data();

				$bimage = 'uploads/home_slider_images/'.$d['file_name'];

				unlink($bi->images);
			}else{
				$this->alert->pnotify("error","Please Select Valid Image","error");
				redirect("pages/dynamic-page/homepage");
			}
		}else{
			
			
			$bimage=$bi->images;
			
		}

		$data = array(

			"description" => $btext,
			"images" => $bimage,

		);

		$this->db->set($data);
		$this->db->where("id",$bid);
		$banner = $this->db->update("fdm_va_home_slider_images");

	  if($banner){
        $this->alert->pnotify("success","Banner Image Successfully Updated","success");
		redirect("pages/dynamic-page/homepage");
      }else{
      	$this->alert->pnotify("error","Error Occured While Updating Banner Image","error");
		redirect("pages/dynamic-page/homepage");
      }
}	
	
	
	
	


/*   welcome note starts   */

public function welcomenote($id){
	
	$desc = $this->input->post("description");

	$eimg = $this->db->get_where("tbl_company_overview",array("id"=>$id))->row();
	
	
	    if($_FILES['image']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/company_overview/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
//                $config['encrypt_name']             = TRUE;
		
                $this->load->library('upload', $config);
		
		$dd=$this->upload->do_upload("image");
		
			if($dd){
				$d=$this->upload->data();

				$image = 'uploads/company_overview/'.$d['file_name'];
			}else{
				$this->alert->pnotify("error","Please Select Valid Image","error");
				redirect("pages/dynamic-page/homepage");			}
		}else{
			
			
			$image=$eimg->image;
			
		}

	
	
	
	
	$data = array(
		"image" => $image,
		"description" => $desc,

	);

	$this->db->set($data);
	$this->db->where("id",$id);
	$welcome = $this->db->update("tbl_company_overview");

	if($welcome){
			$this->alert->pnotify("success","Company Overview Updated Successfully","success");
			redirect("pages/dynamic-page/homepage");
	}else{

			$this->alert->pnotify("error","Error Occured While Updating Company Overview","error");
			redirect("pages/dynamic-page/homepage");
	}

}

/*   welcome note ends   */

	
/* About Us Start */	

	public function insertAbout(){

	$name = $this->input->post("title");
	$desc = $this->input->post("desc");
	$target = $this->input->post("target");
	$link = $this->input->post("link");
	$date = date("Y-m-d H:i:s");
	
//	
//	$chk = $this->db->get_where("tbl_about_us_homepage",array("title"=>$name,"deleted"=>0))->num_rows();
//	if($chk>=1){
//
//			$this->alert->pnotify("error","$name Already Exists","error");
//			redirect("site-map");
//	}
	
	$data = array(
		"title" => $name,
		"target" => $target,
		"link" => $link,
		"created_date" => $date,
		"description" => $desc

	);

	$c = $this->db->insert("tbl_about_us_homepage",$data);
	  if($c){
        $this->alert->pnotify("success","$name Successfully Added","success");
		redirect("pages/dynamic-page/homepage");
      }else{
      	$this->alert->pnotify("error","Error Occured While Adding $name","error");
		redirect("pages/dynamic-page/homepage");
      }
 
  

}	
	
	
public function updateAbout(){

	$id = $this->input->post("s_id");
	$name = $this->input->post("title");
	$desc = $this->input->post("desc");
	$target = $this->input->post("target");
	$link = $this->input->post("link");
	$date = date("Y-m-d H:i:s");
	
	
//	$nchk = $this->db->get_where("fdm_va_sitemap_side_menu",array("name"=>$name,"id"=>$id))->row()->name;
//
//	if($nchk==$name){
//
//		$data = array("name" => $name);
//
//		 $this->db->set($data);
//		 $this->db->where("id",$id);
//		 $this->db->update("fdm_va_sitemap_side_menu");
//
//	}else{
//		$nchk1 = $this->db->get_where("fdm_va_sitemap_side_menu",array("name"=>$name,"deleted"=>0))->num_rows();	
//		if($nchk1>=1){
//			$this->alert->pnotify("error","Menu Already Exists","error");
//			redirect("site-map/".$id);
//		}else{	
//		$data = array("name" => $name);
//
//		 $this->db->set($data);
//		 $this->db->where("id",$id);
//		 $this->db->update("fdm_va_sitemap_side_menu");
//		}
//	}
	
	$data = array(
		"title" =>$name,
		"target" => $target,
		"link" => $link,
		"description" => $desc,

	);
	
	 $this->db->set($data);
     $this->db->where("id",$id);
	 $c = $this->db->update("tbl_about_us_homepage");
	
	  if($c){
        $this->alert->pnotify("success","$name Successfully Updated","success");
		redirect("pages/dynamic-page/homepage");
      }else{
      	$this->alert->pnotify("error","Error Occured While Updating $name","error");
		redirect("pages/dynamic-page/homepage");
      }
 
  

}

	
	
	
	
public function aboutstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_about_us_homepage");
		
		if($d){
			if($status=="Active"){
				echo 1;
				//echo $this->alert->pnotify("Success","Successfully News Enabled","success");
			}else{
				echo 0;
				//echo $this->alert->pnotify("Success","Successfully News Disabled","success");	
			}

		}else{
			if($status=="Inactive"){
				echo 2;
				echo $this->alert->pnotify("Error","Error Occured While Enabling News","error");
			}else{
				echo 3;
				echo $this->alert->pnotify("Error","Error Occured While Disabling News","error");
			}	
		}
		
}  	
	
	
public function delAbout($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("tbl_about_us_homepage");

	if($d){
			$this->alert->pnotify("success","Successfully Deleted","success");
			redirect("pages/dynamic-page/homepage");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting","error");
			redirect("pages/dynamic-page/homepage");
	}
}	
	

public function updatefsp(){

	$id = $this->input->post("f_id");
	$desc = $this->input->post("desc");
	$target = $this->input->post("target");
	$link = $this->input->post("link");
	$date = date("Y-m-d H:i:s");
	
	
//	$nchk = $this->db->get_where("fdm_va_sitemap_side_menu",array("name"=>$name,"id"=>$id))->row()->name;
//
//	if($nchk==$name){
//
//		$data = array("name" => $name);
//
//		 $this->db->set($data);
//		 $this->db->where("id",$id);
//		 $this->db->update("fdm_va_sitemap_side_menu");
//
//	}else{
//		$nchk1 = $this->db->get_where("fdm_va_sitemap_side_menu",array("name"=>$name,"deleted"=>0))->num_rows();	
//		if($nchk1>=1){
//			$this->alert->pnotify("error","Menu Already Exists","error");
//			redirect("site-map/".$id);
//		}else{	
//		$data = array("name" => $name);
//
//		 $this->db->set($data);
//		 $this->db->where("id",$id);
//		 $this->db->update("fdm_va_sitemap_side_menu");
//		}
//	}
	
	$data = array(
		"target" => $target,
		"link" => $link,
		"description" => $desc,

	);
	
	 $this->db->set($data);
     $this->db->where("id",$id);
	 $c = $this->db->update("tbl_home_foodsafetypolicy");
	
	  if($c){
        $this->alert->pnotify("success","Food Safety Policy Successfully Updated","success");
		redirect("pages/dynamic-page/homepage");
      }else{
      	$this->alert->pnotify("error","Error Occured While Updating Food Safety Policy","error");
		redirect("pages/dynamic-page/homepage");
      }
 
  

}
	
	

}
