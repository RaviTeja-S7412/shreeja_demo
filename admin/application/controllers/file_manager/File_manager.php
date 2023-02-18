<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class File_manager extends CI_Controller {
	public function __construct(){

		parent::__construct();
		
	$this->secure->loginCheck();
	
		
  }
	
 public function index(){
	 
	 $this->load->view("file_manager/file_manager");
	 
 }
	
	
public function insertImages(){
	
$cdate = date("Y-m-d");
$created_by = $this->session->userdata("admin_id");
$gtype = $this->input->post("gtype");

$hw = $this->db->get_where("fdm_va_gallery_types",array("id"=>$gtype))->row();	

$pdf = $this->db->get_where("fdm_va_gallery_types",array("id"=>$gtype))->row()->id;		
	
if($pdf == 4){
	
	sleep(3);
  if($_FILES["files"]["name"] != '')
  {
   $output = '';
   $config["upload_path"] = 'uploads/gallery/';
   $config["allowed_types"] = 'pdf';
    
   //$config["encrypt_name"] = TRUE;   
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
      <img src="uploads/gallery/'.$data["file_name"].'" class="img-responsive" style="height: 300px; width: 100%"/>
     </div>
     ';
	 	$imgname = 'uploads/gallery/'.$data["file_name"];
		
	
	 $data1 = array("img_name"=>$imgname,"gallery_type"=>$gtype,"created_by"=>$created_by,"created_date"=>$cdate);  	
	 $up = $this->db->insert("fdm_va_gallery",$data1);

    }
   }
   echo $output;   
  }
	
}else{	
	
	
sleep(3);
  if($_FILES["files"]["name"] != '')
  {
   $output = '';
   $config["upload_path"] = 'uploads/gallery/';
   $config["allowed_types"] = 'gif|jpg|png';
   $config['max_width']            = $hw->width;
   $config['max_height']           = $hw->height;	  
   $config['min_width']            = $hw->minwidth;
   $config['min_height']           = $hw->minheight;	  
   //$config["encrypt_name"] = TRUE;   
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
      <img src="uploads/gallery/'.$data["file_name"].'" class="img-responsive" style="height: 300px; width: 100%"/>
     </div>
     ';
	 	$imgname = 'uploads/gallery/'.$data["file_name"];
		
	
	 $data1 = array("img_name"=>$imgname,"gallery_type"=>$gtype,"created_by"=>$created_by,"created_date"=>$cdate);  	
	 $up = $this->db->insert("fdm_va_gallery",$data1);

    }
   }
   echo $output;   
  }
	
}
}	
	
public function updateImg(){

   $id = $this->input->post_get("id",true);
   $ia = $this->db->get_where("fdm_va_gallery",array("id"=>$id))->row();

   if($ia->deleted==0){
	   $data = array("status"=>"Inactive","deleted"=>1,"updated_by"=>$this->session->userdata("admin_id"));
	   $this->db->set($data);
	   $this->db->where("id",$id);
	   $up = $this->db->update("fdm_va_gallery");
	   if($up){
	   		echo 1;
	   }else{
	   		echo 0;
	   }
   }elseif($ia->deleted==1){

	   $data = array("status"=>"Active","deleted"=>0,"updated_by"=>$this->session->userdata("admin_id"));
	   $this->db->set($data);
	   $this->db->where("id",$id);
	   $up = $this->db->update("fdm_va_gallery");
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

	$di = $this->db->get_where("fdm_va_gallery",array("id"=>$id))->row();
	if($di->img_name){

		$del = unlink($di->img_name);
		
		if($del){
			$d = $this->db->delete("fdm_va_gallery",array("id"=>$id));
			if($d){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

}
	
	
public function getPdflink(){
	
   $id = $this->input->post_get("id",true);
   $ia = $this->db->get_where("fdm_va_gallery",array("id"=>$id))->row();
	
   if($ia){
	   
	echo "admin/".$ia->img_name;
	exit();
	
   }else{
	   
	   echo 0;
   }	
	
	
	
}	
	
	
// Gallery Types
	
	
public function insertGallerytype(){
	
	$name = $this->input->post("name");
	$height = $this->input->post("height");
	$width = $this->input->post("width");
	$mheight = $this->input->post("minheight");
	$mwidth = $this->input->post("minwidth");
	$cby = $this->session->userdata("admin_id");
	$cdate = date("Y-m-d");
	
	
	$chk = $this->db->get_where("fdm_va_gallery_types",array("gallery_type"=>$name,"deleted"=>0))->num_rows();
	if($chk>=1){

			$this->alert->pnotify("error","Gallery Type Already Exists","error");
			redirect("file-manager");
	}
	
	$data = array("gallery_type"=>$name,"height"=>$height,"width"=>$width,"minheight"=>$mheight,"minwidth"=>$mwidth,"created_by"=>$cby,"created_date"=>$cdate);
	
	$it = $this->db->insert("fdm_va_gallery_types",$data);
	
	if($it){
		
		$this->alert->pnotify("success","Gallery Type Successfully Added","success");
		redirect("file-manager");
     }else{
      	$this->alert->pnotify("error","Error Occured While Adding Gallery Type","error");
		redirect("file-manager");
     }
	    	
}
	
public function updateGallerytype(){
	
	$id = $this->input->post("id");
	$height = $this->input->post("height");
	$width = $this->input->post("width");
	$mheight = $this->input->post("minheight");
	$mwidth = $this->input->post("minwidth");
	$name = $this->input->post("name");
	$uby = $this->session->userdata("admin_id");
	$udate = date("Y-m-d");
	
		$nchk = $this->db->get_where("fdm_va_gallery_types",array("gallery_type"=>$name,"id"=>$id))->row()->gallery_type;

	if($nchk==$name){

		$data = array("gallery_type" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_gallery_types");

	}else{
		$nchk1 = $this->db->get_where("fdm_va_gallery_types",array("gallery_type"=>$name,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			
			$this->alert->pnotify("error","Gallery Type Already Exists","error");
			redirect("file-manager");
			
		}else{	
		$data = array("gallery_type" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_gallery_types");
		}
	}
	
	$data = array("updated_by"=>$uby,"updated_date"=>$udate,"height"=>$height,"width"=>$width,"minheight"=>$mheight,"minwidth"=>$mwidth);
	
	$this->db->set($data);
	$this->db->where("id",$id);
	$it = $this->db->update("fdm_va_gallery_types");
	
	if($it){
		
		$this->alert->pnotify("success","Gallery Type Successfully Updated","success");
		redirect("file-manager");
     }else{
      	$this->alert->pnotify("error","Error Occured While Adding Gallery Type","error");
		redirect("file-manager");
     }
	    	
}
	
public function delGallerytype($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("fdm_va_gallery_types");

	if($d){
			
			$this->alert->pnotify("success","Gallery Type Successfully Deleted","success");
			redirect("file-manager");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Gallery Type","error");
			redirect("file-manager");
	}
}	


	
	
	
	
}