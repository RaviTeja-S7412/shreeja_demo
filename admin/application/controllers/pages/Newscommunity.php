<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Newscommunity extends CI_Controller {
public function __construct(){
			
		parent::__construct();
		$id = $this->session->userdata("admin_id");
		$userstatus = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row()->status;
	
		if($userstatus != "Active"){
		   $msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Login To Access News</div>';	
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

public function editPage($nid="null"){
	
	$data["side_menu"] = "";
	$data["news_id"] = "";
	$this->load->view("pages/newsCommunity/newsCommunity",$data);
}



/* News and community */

public function insertNews(){

	//$id = $this->input->post("pageid");
	$title = $this->input->post("title");
	$sdesc = $this->input->post("short_desc");
	$desc = $this->input->post("news_description");
	$link = $this->input->post("link");
	$cid = $this->session->userdata("admin_id");
	$date = date("Y-m-d H:i:s");
	$news_id = $this->admin->generateNewsid();

	    $upload_config = array('upload_path' => "uploads/news/".$news_id, 'allowed_types' =>
        'jpg|jpeg|gif|png', 'encrypt_name' => true );

    $this->load->library('upload', $upload_config);

    // create an album if not already exist in uploads dir
    // wouldn't make more sence if this part is done if there are no errors and right before the upload ??
    if (!is_dir('uploads/news/'))
    {
        mkdir('./uploads/news', 0777, true);
    }
    $dir_exist = true; // flag for checking the directory exist or not
    if (!is_dir('uploads/news/' . $news_id))
    {
        mkdir('./uploads/news/' . $news_id, 0777, true);
        $dir_exist = false; // dir not exist
    }
    else{

    }

    if (!$this->upload->do_upload('news_image'))
    {
        // upload failed
        //delete dir if not exist before upload
        if(!$dir_exist)
          rmdir('./uploads/news/' . $news_id);
			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("news-and-community/");
		

        //return array('error' => $this->upload->display_errors('<span>', '</span>'));
    } else
    {
        // upload success
        //$this->upload->do_upload('news_image');
        $upload_data = $this->upload->data();

 		$nimage = 'uploads/news/'.$news_id."/".$upload_data['file_name'];
	}
    
    

	$data = array(
		"id" => $news_id,
		"title" => $title,
		"short_desc" => $sdesc,
		"news_description" => $desc,
		"link" => $link,
		"news_image" => $nimage,
		"created_by" => $cid,
		"created_date" => $date

	);

	$c = $this->db->insert("fdm_va_news_and_community",$data);
	  if($c){
        $this->alert->pnotify("success","News Successfully Added","success");
		redirect("news-and-community");
      }else{
      	$this->alert->pnotify("error","Error Occured While Adding News","error");
		redirect("news-and-community");
      }
 
  

}

public function updateNews(){
	//$pid = $this->input->post("pageid");
	$news_id = $this->input->post("news_id");
	
	$nid =  base64_encode($news_id);
	
	$title = $this->input->post("title");
	$sdesc = $this->input->post("short_desc");
	$desc = $this->input->post("news_description");
	$cid = $this->session->userdata("admin_id");
	$date = date("Y-m-d H:i:s");
	$link = $this->input->post("link");

	$n = $this->db->get_where("fdm_va_news_and_community",array("id"=>$news_id))->row();


	    if($_FILES['news_image']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/news/".$news_id;
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['encrypt_name']             = TRUE;
		
                $this->load->library('upload', $config);
		
		$dd=$this->upload->do_upload("news_image");
		
			if($dd){
				$d=$this->upload->data();

				$nimage = 'uploads/news/'.$news_id."/".$d['file_name'];
			}else{
				$this->alert->pnotify("error","Please Select Valid Image","error");
				redirect("news-and-community/".$nid);			}
		}else{
			
			
			$nimage=$n->news_image;
			
		}
		

	$data = array(
		"title" => $title,
		"short_desc" => $sdesc,
		"news_description" => $desc,
		"link" => $link,
		"news_image" => $nimage,
		"updated_by" => $cid,
		"updated_date" => $date

	);

	 $this->db->set($data);
	 $this->db->where("id",$news_id);
	 $c = $this->db->update("fdm_va_news_and_community");
	  if($c){
        $this->alert->pnotify("success","News Successfully Updated","success");
		redirect("news-and-community");
      }else{
      	$this->alert->pnotify("error","Error Occured While Updating News","error");
		redirect("news-and-community");
      }
  }

	public function newsstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("fdm_va_news_and_community");
		
		if($d){
			if($status==1){
				echo 1;
				//echo $this->alert->pnotify("Success","Successfully News Enabled","success");
			}else{
				echo 0;
				//echo $this->alert->pnotify("Success","Successfully News Disabled","success");	
			}

		}else{
			if($status==1){
				echo 2;
				echo $this->alert->pnotify("Error","Error Occured While Enabling News","error");
			}else{
				echo 3;
				echo $this->alert->pnotify("Error","Error Occured While Disabling News","error");
			}	
		}
		
		
	}  


public function delNews($id){


	$data = array("deleted"=>1,"status"=>0);
	$this->db->set($data);
	$this->db->where("id",$id);
	$dd = $this->db->update("fdm_va_news_and_community");

	if($dd){
	  $this->alert->pnotify("success","News Successfully Deleted","success");
		//redirect("pages/news-and-community/".$pid);
      }else{
      	$this->alert->pnotify("error","Error Occured While Deleting News","error");
		//redirect("pages/news-and-community/".$pid);
      }

}





public function insert_image(){
	
	    			$name = md5(rand(100, 200));
	                $ext = explode('.', $_FILES['file']['name']);
	                $filename = $name . '.' . $ext[1];
	                $destination = '../uploads/newscommunity/' . $filename; //change this directory
	                $location = $_FILES["file"]["tmp_name"];
	                move_uploaded_file($location, $destination);
					echo $destination;
					exit();
}

public function delImages(){

	$src = $this->input->post("file");
	$file_name = str_replace(base_url(), '', $src); // striping host to get relative path
        if(unlink($file_name))
        {
            echo 'File Delete Successfully';
        }
}





/* News and community ends */
	

/* side menu start */	
	
public function insertSidemenu(){

	$name = $this->input->post("name");
	$target = $this->input->post("target");
	$link = $this->input->post("link");
	$cid = $this->session->userdata("admin_id");
	$date = date("Y-m-d H:i:s");
	
	
	$chk = $this->db->get_where("fdm_va_news_side_menu",array("name"=>$name,"deleted"=>0))->num_rows();
	if($chk>=1){

			$this->alert->pnotify("error","Menu Already Exists","error");
			redirect("news-and-community");
	}
	
	$data = array(
		"name" => $name,
		"target" => $target,
		"link" => $link,
		"created_by" => $cid,
		"created_date" => $date

	);

	$c = $this->db->insert("fdm_va_news_side_menu",$data);
	  if($c){
        $this->alert->pnotify("success","Menu Successfully Added","success");
		redirect("news-and-community");
      }else{
      	$this->alert->pnotify("error","Error Occured While Adding Menu","error");
		redirect("news-and-community");
      }
 
  

}	
	
	
public function updateSidemenu(){

	$id = $this->input->post("s_id");
	$name = $this->input->post("name");
	$target = $this->input->post("target");
	$link = $this->input->post("link");
	$uid = $this->session->userdata("admin_id");
	$date = date("Y-m-d H:i:s");
	
	
	$nchk = $this->db->get_where("fdm_va_news_side_menu",array("name"=>$name,"id"=>$id))->row()->name;

	if($nchk==$name){

		$data = array("name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_news_side_menu");

	}else{
		$nchk1 = $this->db->get_where("fdm_va_news_side_menu",array("name"=>$name,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","Menu Already Exists","error");
			redirect("news-and-community/".$id);
		}else{	
		$data = array("name" => $name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_news_side_menu");
		}
	}
	
	$data = array(
		"target" => $target,
		"link" => $link,
		"updated_by" => $uid,
		"updated_date" => $date

	);
	
	 $this->db->set($data);
     $this->db->where("id",$id);
	 $c = $this->db->update("fdm_va_news_side_menu");
	
	  if($c){
        $this->alert->pnotify("success","Menu Successfully Updated","success");
		redirect("news-and-community");
      }else{
      	$this->alert->pnotify("error","Error Occured While Updating Menu","error");
		redirect("news-and-community");
      }
 
  

}
	
	
public function delSidemenu($id){

	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$d = $this->db->update("fdm_va_news_side_menu");

	if($d){
			$this->alert->pnotify("success","Menu Successfully Deleted","success");
			redirect("news-and-community");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting Menu","error");
			redirect("news-and-community");
	}
}	
	
	
/* side menu ends */
	
	

public function updateBanner(){
	
	$bid = $this->input->post("bid");
	$btext = $this->input->post("banner_text");
	$uid = $this->session->userdata("admin_id");
	$date = date("Y-m-d");

	$bi = $this->db->get_where("fdm_va_news_banner",array("id"=>$bid))->row();


	    if($_FILES['banner_image']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/banners/news_and_community/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['encrypt_name']             = TRUE;
				$config['max_width']            = 1920;
				$config['max_height']           = 480;	
			
                $this->load->library('upload', $config);
		
		$dd=$this->upload->do_upload("banner_image");
			if($dd){
				$d=$this->upload->data();

				$bimage = 'uploads/banners/news_and_community/'.$d['file_name'];

				unlink($bi->img);
			}else{
				$this->alert->pnotify("error","Please Select Valid Image","error");
				redirect("news-and-community");
			}
		}else{
			
			
			$bimage=$bi->img;
			
		}

		$data = array(

			"description" => $btext,
			"img" => $bimage,
			"updated_by" => $uid,
			"updated_date" => $date	

		);

		$this->db->set($data);
		$this->db->where("id",$bid);
		$banner = $this->db->update("fdm_va_news_banner");

	  if($banner){
        $this->alert->pnotify("success","Banner Image Successfully Updated","success");
		redirect("news-and-community");
      }else{
      	$this->alert->pnotify("error","Error Occured While Updating Banner Image","error");
		redirect("news-and-community");
      }
}	
	
	
	
	
	


}
