<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dynamicpages extends CI_Controller {
public function __construct(){
			
	parent::__construct();
		
	$this->secure->loginCheck();

}
public function index(){

	$data["pages"] = $this->db->query("select * from fdm_va_pages order by id asc")->result();
	$this->load->view("pages/allPages",$data);

}




public function updatePage(){

	$id = $this->input->post("id",true);
	$name = $this->input->post("page_name",true);
	$pname = $this->admin->seo_friendly_url($name);
	//$plink = $this->input->post("page_link",true);
	$ptitle = $this->input->post("meta_title",true);
	$uid = $this->session->userdata("admin_id");
	$status = $this->input->post("status",true);
	//$cdate = date("Y-m-d H:i:s");
	$udate = date("Y-m-d H:i:s");

	$nchk = $this->db->get_where("fdm_va_pages",array("page_name"=>$name,"id"=>$id))->row()->page_name;

	if($nchk==$name){

		$data = array("page_name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_pages");

	}else{
		$nchk1 = $this->db->get_where("fdm_va_pages",array("page_name"=>$name,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","Page Name Already Exists","error");
			redirect("pages/homepage/".$id);
		}else{	
		$data = array("page_name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_pages");
		}
	}

	$data = array(

		"page_name" => $name,
		"meta_title" => $ptitle,
		"updated_date" => $udate,
		"status" => $status,
		"user_id" => $uid

	);

		 $this->db->set($data);
		 $this->db->where("id",$id);	
	$p = $this->db->update("fdm_va_pages");

	if($p){

			$this->alert->pnotify("success","Page Successfully Updated","success");
			redirect("pages");
	}else{

			$this->alert->pnotify("error","Error Occured While Updating Page","error");
			redirect("pages");
	}

}


public function insertImages(){

	 sleep(3);
  if($_FILES["files"]["name"] != '')
  {
   $output = '';
   $config["upload_path"] = 'uploads/home_slider_images/';
   $config["allowed_types"] = 'gif|jpg|png';
   $config["encrypt_name"] = TRUE;   
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   for($count = 0; $count<count($_FILES["files"]["name"]); $count++)
   {
    $_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
    $_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
    $_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
    $_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
    $_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
    if($this->upload->do_upload('file'))
    {
     $data = $this->upload->data();
     $url = $_SERVER["HTTP_HOST"];
     $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';

     $output .= '
     <div class="col-md-3">
      <img src="uploads/home_slider_images/'.$data["file_name"].'" class="img-responsive" style="height: 300px; width: 100%"/>
     </div>
     ';
	 	$imgname = 'uploads/home_slider_images/'.$data["file_name"];
		$date = date("Y-m-d H:i:s");
		$created_by = $this->session->userdata("admin_id");
		$updated_by = $this->session->userdata("admin_id");
		
	
	 $data1 = array("images"=>$imgname,"created_by"=>$created_by,"updated_by"=>$updated_by,"date"=>$date);  	
	 $up = $this->db->insert("fdm_va_home_slider_images",$data1);
	 // if($up){
	 // 	echo 1;
	 // }else{
	 // 	echo 0;
	 // }	
    }
   }
   echo $output;   
  }
}	

public function delPage($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("fdm_va_pages");

	if($d){

			$this->alert->pnotify("success","Page Successfully Deleted","success");
			redirect("pages");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Page","error");
			redirect("pages");
	}
}

public function updateImg(){

   $id = $this->input->post_get("id",true);
   $ia = $this->db->get_where("fdm_va_home_slider_images",array("id"=>$id))->row();

   if($ia->deleted==0){
	   $data = array("status"=>"Inactive","deleted"=>1,"updated_by"=>$this->session->userdata("admin_id"));
	   $this->db->set($data);
	   $this->db->where("id",$id);
	   $up = $this->db->update("fdm_va_home_slider_images");
	   if($up){
	   		echo 1;
	   }else{
	   		echo 0;
	   }
   }elseif($ia->deleted==1){

	   $data = array("status"=>"Active","deleted"=>0,"updated_by"=>$this->session->userdata("admin_id"));
	   $this->db->set($data);
	   $this->db->where("id",$id);
	   $up = $this->db->update("fdm_va_home_slider_images");
	   if($up){
	   		echo 2;
	   }else{
	   		echo 0;
	   }


   }
}

public function delImg(){

	$url = $_SERVER["HTTP_HOST"];
	$id = $this->input->post_get("id",true);

	$di = $this->db->get_where("fdm_va_home_slider_images",array("id"=>$id))->row();
	if($di->images){

		// $link = $url."/"freedom_bank/$di->images"";
		$del = unlink($di->images);
		
		if($del){
			$d = $this->db->delete("fdm_va_home_slider_images",array("id"=>$id));
			if($d){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

}


/*   welcome note starts   */

public function welcomenote($id){
	$title = $this->input->post("title",true);
	$desc = $this->input->post("description");
	$udate = date("Y-m-d H:i:s");
	$uuid = $this->session->userdata("admin_id");
	$pid = $this->input->post("pid");

	$data = array(
		"title" => $title,
		"description" => $desc,
		"updated_date" => $udate,
		"updated_by" => $uuid


	);

	$this->db->set($data);
	$this->db->where("id",$id);
	$welcome = $this->db->update("fdm_va_welcome_note");

	if($welcome){
			$this->alert->pnotify("success","Welcome Note Updated Successfully","success");
			redirect("pages/homepage/".$pid);
	}else{

			$this->alert->pnotify("error","Error Occured While Updating Welcome Note","error");
			redirect("pages/homepage/".$pid);
	}

}

/*   welcome note ends   */




}
