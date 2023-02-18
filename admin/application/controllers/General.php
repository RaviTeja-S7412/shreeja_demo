<?php
class General extends CI_Controller {

public function __construct(){
			
	parent::__construct();
		
	$this->secure->loginCheck();
}

public function general(){

	$data["c"] = $this->db->query("select * from fdm_va_general_contact where deleted=0 and status='Active'")->row();
	$data['soc'] = "";
	$data['loc'] = "";
	$data['areas'] = "";
	
	$this->load->view("general/general",$data);

}

public function mandatoryupdate(){

	$am = $this->admin->get_option("is_mandatory_update");

	$ams=$this->input->post("status",true);


	if($ams=='1'){

		$up = $this->admin->insertoption("is_mandatory_update","1");
		echo 1;
		
	}else{

		$up1 = $this->admin->insertoption("is_mandatory_update","0");
		echo 0;
		
	}
}

public function appversionupdate(){

	$am = $this->admin->get_option("app_version");

	$ams=$this->input->post("app_version",true);
	$up = $this->admin->insertoption("app_version",$ams);

	$this->alert->pnotify("success","Successfully Updated","success");
	redirect('general');

}
	
public function dev_mode(){

	$am = $this->admin->get_option("is_development_mode");

	$ams=$this->input->post("status",true);


	if($ams=='1'){

		$up = $this->admin->insertoption("is_development_mode","1");
		echo 1;
		
	}else{

		$up1 = $this->admin->insertoption("is_development_mode","0");
		echo 0;
		
	}
}
	
	
public function updatewelcomeoffer(){

	$am = json_decode($this->admin->get_option("welcome_note"));
	
	if($_FILES['image']['size']!='0'){
		//profile pic uploading
		$config['upload_path']          = "uploads/offers/";
		$config['allowed_types']        = 'gif|jpg|png|jpeg';		
		$this->load->library('upload', $config);

		$dd=$this->upload->do_upload("image");

		if($dd){  
			$d=$this->upload->data();
			$nimage = "uploads/offers/".$d['file_name'];
		}else{
			$nimage = $am->image;
		}
	}else{


		$nimage=$am->image;

	}				

	$data = array("status"=>$this->input->post("status"),"message"=>$this->input->post("message"),"image"=>$nimage);

	$up = $this->admin->insertoption("welcome_note",json_encode($data));
	$this->alert->pnotify("success","Successfully Updated","success");
	redirect("general");
}


public function insertHeaderLogo(){

	  $logo = $this->db->get_where("fdm_va_general_logo",array("id"=>1,"logo_type"=>"Header"))->row();					

	  if($_FILES['logo']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/general/logo/header/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
//                $config['encrypt_name']             = TRUE;
			    $config['max_width']            = 450;
				$config['max_height']           = 80;		
        $this->load->library('upload', $config);
		
		$dd=$this->upload->do_upload("logo");
		
			if($dd){  
				$d=$this->upload->data();

				$nimage = "uploads/general/logo/header/".$d['file_name'];

				unlink($logo->logo);
			}else{
				$this->alert->pnotify("error","Please Select Valid Image Format Or Dimensions","error");
				redirect("general");
			}
		}else{
			
			
			$nimage=$logo->logo;
			
		}				


				$data = array("logo"=>$nimage,"date"=>date("Y-m-d H:i:s"));

				$this->db->set($data);
				$this->db->where("id",1);
				$l = $this->db->update("fdm_va_general_logo");
	if($l){

			$this->alert->pnotify("success","Header Logo Successfully Updated","success");
			redirect("general");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Header Logo","error");
			redirect("general");
	}

}



public function updateContact(){
	$id = $this->input->post("c_id",true);
	$name = $this->input->post("cname");
	$email = $this->input->post("email",true);
	$mobile = $this->input->post("mobile",true);
	$address = $this->input->post("address",true);
	$date = date("Y-m-d H:i:s");

	$data = array("email"=>$email,"mobile"=>$mobile,"address"=>$address,"company_name"=>$name);
		 $this->db->set($data);
		 $this->db->where("id",$id);
	$c = $this->db->update("fdm_va_general_contact");
	if($c){
			$this->alert->pnotify("success","Contact Successfully Updated","success");
			redirect("general");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Contact","error");
			redirect("general");
	}

}


// Social Networking

public function insertSocial(){

	$title = $this->input->post("title",true);
	$link = $this->input->post("link");
	$icon = $this->input->post("icon");
	
	
	$schk = $this->db->get_where("fdm_va_social_networking",array("title"=>$title))->num_rows();
	
	if($schk == 1){
		
		$this->alert->pnotify("error","$title Already Exists","error");
		
		redirect("general");
		
	}	
	

//	  	$config['upload_path']          = "uploads/general/social_networking/";
//        $config['allowed_types']        = 'gif|jpg|png|jpeg';
//        $config['encrypt_name']             = TRUE;
//        $config['max_width']            = 35;
//        $config['max_height']           = 35;
//		
//        $this->load->library('upload', $config);
//		
//		if($this->upload->do_upload("icon")){
//		
//		$d=$this->upload->data();
//		
// 			$icon = "uploads/general/social_networking/".$d['file_name'];
// 		
// 		}else{
//
// 			$this->alert->pnotify("error","Please Select Valid Image","error");
//			redirect("general");
//
// 		}

 	$data = array(
 		
 		"title" => $title,
 		"link" => $link,
 		"icon" => $icon,
 		"created_date" => date("Y-m-d"),
 		"created_by" => $this->session->userdata("admin_id"),

 	);	

 	$sn = $this->db->insert("fdm_va_social_networking",$data);

 	if($sn){

 			$this->alert->pnotify("success","Social Site Successfully Added","success");
			redirect("general");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Adding Social Site","error");
			redirect("general");
	}
}


public function updateSocial($id){
	$data["c"] = $this->db->query("select * from fdm_va_general_contact where deleted=0 and status='Active'")->row();
	$data['soc'] = $this->db->query("select * from fdm_va_social_networking where deleted=0 and id=$id")->row();
	$data['loc'] = '';
	$data['areas'] = "";

	$this->load->view("general/general",$data);

}

public function editSocialnetwork(){

	$id = $this->input->post("soc_id");
	$title = $this->input->post("title",true);
	$link = $this->input->post("link");
	$icon = $this->input->post("icon");

	$schk = $this->db->get_where("fdm_va_social_networking",array("title"=>$title,"id"=>$id))->row()->title;

	if($schk==$title){

		$data = array("title" => $title);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("fdm_va_social_networking");
		
		
	}else{
		$nchk1 = $this->db->get_where("fdm_va_social_networking",array("title"=>$title,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","$title Already Exists","error");
			redirect("general/update-social-site/".$id);
		}else{	
		$data = array("title" => $title);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("fdm_va_social_networking");
			
			
		}
	}
	
	

	$sn = $this->db->get_where("fdm_va_social_networking",array("id"=>$id))->row();

//	if($_FILES['icon']['size']!='0'){
//	  	$config['upload_path']          = "uploads/general/social_networking/";
//        $config['allowed_types']        = 'gif|jpg|png|jpeg';
//        $config['encrypt_name']             = TRUE;
//        $config['max_width']            = 35;
//        $config['max_height']           = 35;
//		
//        $this->load->library('upload', $config);
//		
//		if($this->upload->do_upload("icon")){
//		
//		$d=$this->upload->data();
//		
// 		$icon = "uploads/general/social_networking/".$d['file_name'];
// 	
// 		unlink($sn->icon);
// 		}else{
//
// 			$this->alert->pnotify("error","Please Select Valid Image","error");
//			redirect("general/update-social-site/".$id);
//
// 		}
//
// 	}else{
// 		$icon = $sn->icon;
// 	}	

 	$data = array(
 		
 		"link" => $link,
 		"icon" => $icon,
 		"updated_date" => date("Y-m-d"),
 		"updated_by" => $this->session->userdata("admin_id"),

 	);	
 		$this->db->set($data);
 		$this->db->where("id",$id);
 		$sn = $this->db->update("fdm_va_social_networking");

 	if($sn){

 			$this->alert->pnotify("success","Social Site Successfully Updated","success");
			redirect("general/update-social-site/".$id);
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Social Site","error");
			redirect("general/update-social-site/".$id);
	}
}

	public function socialsitestatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("fdm_va_social_networking");
		
		if($d){
			if($status=="Active"){
				echo 1;
				//echo $this->alert->pnotify("Success","Successfully Social Site Enabled","success");
			}else{
				echo 0;
				//echo $this->alert->pnotify("Success","Successfully Social Site Disabled","success");	
			}

		}else{
			if($status=="Inactive"){
				echo 2;
				//echo $this->alert->pnotify("Error","Error Occured While Enabling Social Site","error");
			}else{
				echo 3;
				//echo $this->alert->pnotify("Error","Error Occured While Disabling Social Site","error");
			}	
		}
		
		
	}
	
	

public function delSocialsite($id){


	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$dd = $this->db->update("fdm_va_social_networking");

	if($dd){
	  $this->alert->pnotify("success","Social Site Successfully Deleted","success");
		//redirect("pages/news-and-community/".$pid);
      }else{
      	$this->alert->pnotify("error","Error Occured While Deleting Social Site","error");
		//redirect("pages/news-and-community/".$pid);
      }

}
	
// Social Networking Ends	

	

// Location

public function insertLocation(){
	
	$loc_name = $this->input->post("location",true);
	$assign_to = $this->input->post("assign_to",true);
//	$cutCharges = $this->input->post("cutoffCharges",true);
	
	$lchk = $this->db->get_where("tbl_locations",array("location"=>$loc_name,"assign_to"=>$assign_to))->num_rows();
	
	if($lchk == 1){
		
		$this->alert->pnotify("error","Location Already Exists","error");
		redirect("general");
		
	}
	
	
	  	$config['upload_path']          = "uploads/general/locations/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_width']            = 500;
        $config['max_height']           = 500;
		
        $this->load->library('upload', $config);
		
		if($this->upload->do_upload("image")){
		
		$d=$this->upload->data();
		
 			$icon = "uploads/general/locations/".$d['file_name'];
 		
 		}else{

 			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("general");

 		}
	
	
 	$data = array(
 		
 		"location" => $loc_name,
 		"created_date" => date("Y-m-d"),
		"image" => $icon,
		"assign_to" => $assign_to,
        "address" => $this->input->post("address"),		
        "gst_number" => $this->input->post("gst_number"),		
        "pan_number" => $this->input->post("pan_number")		
//		"cutoffCharges" => $cutCharges
 
 	);	

 	$sn = $this->db->insert("tbl_locations",$data);
	$iid = $this->db->insert_id();

 	if($sn){
		
		$products = $this->db->like("location","2")->get_where("tbl_products",["assigned_to"=>"agents","deleted"=>0])->result_array();
	
		foreach($products as $p){

			unset($p["id"]);
			$p["location"] = json_encode(["$iid"]);
			$this->db->insert("tbl_products",$p);
			
		}
		$this->alert->pnotify("success","Location Successfully Added","success");
		redirect("general");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Adding Location","error");
			redirect("general");
	}
}


public function updateLocation($id){
	$data["c"] = $this->db->query("select * from fdm_va_general_contact where deleted=0 and status='Active'")->row();
	$data['soc'] = '';
	$data['loc'] = $this->db->query("select * from tbl_locations where deleted=0 and id=$id")->row();;
	$data['areas'] = "";
	
	$this->load->view("general/general",$data);

}

public function editLocation(){

	$id = $this->input->post("loc_id");
	$loc_name = $this->input->post("location",true);
	$assign_to = $this->input->post("assign_to",true);
//	$cutCharges = $this->input->post("cutoffCharges",true);

	$schk = $this->db->get_where("tbl_locations",array("location" => $loc_name,"assign_to"=>$assign_to,"id"=>$id))->row();

	if($schk->location==$loc_name){

		$data = array("location" => $loc_name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("tbl_locations");
		
		
	}else{
		$nchk1 = $this->db->get_where("tbl_locations",array("location"=>$loc_name,"assign_to"=>$assign_to,"deleted"=>0))->num_rows();	
		if($nchk1>=1){
			$this->alert->pnotify("error","$loc_name Already Exists","error");
			redirect("general/update-location/".$id);
		}else{	
		$data = array("location" => $loc_name);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("tbl_locations");
			
			
		}
	}
	
		if($_FILES['image']['size']!='0'){
	  	$config['upload_path']          = "uploads/general/locations/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_width']            = 500;
        $config['max_height']           = 500;
		
        $this->load->library('upload', $config);
		
		if($this->upload->do_upload("image")){
		
		$d=$this->upload->data();
		
 		$icon = "uploads/general/locations/".$d['file_name'];
 	
 		unlink($schk->image);
 		}else{

 			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("general/update-location/".$id);

 		}

 	}else{
 		$icon = $schk->image;
 	}	

	
		 $data = array("image" => $icon,"assign_to" => $assign_to,
        "address" => $this->input->post("address"),		
        "gst_number" => $this->input->post("gst_number"),		
        "pan_number" => $this->input->post("pan_number"));

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("tbl_locations");

 	if($c){

 			$this->alert->pnotify("success","Location Successfully Updated","success");
			redirect("general/update-location/".$id);
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Location","error");
			redirect("general/update-location/".$id);
	}
}

	
public function Locationstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_locations");
		
		if($d){
			if($status==1){
				echo 1;
				//echo $this->alert->pnotify("Success","Successfully Social Site Enabled","success");
			}else{
				echo 0;
				//echo $this->alert->pnotify("Success","Successfully Social Site Disabled","success");	
			}

		}else{
			if($status==0){
				echo 2;
				//echo $this->alert->pnotify("Error","Error Occured While Enabling Social Site","error");
			}else{
				echo 3;
				//echo $this->alert->pnotify("Error","Error Occured While Disabling Social Site","error");
			}	
		}
		
		
	}

public function delLocation($id){

	$dd = $this->db->delete("tbl_locations",array("id"=>$id));

	if($dd){
	  $this->alert->pnotify("success","Location Successfully Deleted","success");
		//redirect("pages/news-and-community/".$pid);
      }else{
      	$this->alert->pnotify("error","Error Occured While Deleting Location","error");
		//redirect("pages/news-and-community/".$pid);
      }

}
	
// Location Ends	

	

	
// areas

public function insertArea(){

	$loc_name = $this->input->post("location",true);
	$area = $this->input->post("area",true);
	$assign_to = $this->input->post("assign_to",true);

	$lchk = $this->db->get_where("tbl_areas",array("area_name"=>$area,"assign_to"=>$assign_to))->num_rows();
	
	if($lchk == 1){
		
		$this->alert->pnotify("error","Area Already Exists","error");
		
		redirect("general");
		
	}
	
 	$data = array(
 		
 		"city_id" => $loc_name,
		"area_name" => $area,
		"assign_to" => $assign_to
 
 	);	

 	$sn = $this->db->insert("tbl_areas",$data);

 	if($sn){

 			$this->alert->pnotify("success","Area Successfully Added","success");
			redirect("general");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Adding Area","error");
			redirect("general");
	}
}


public function updateArea($id){
	$data["c"] = $this->db->query("select * from fdm_va_general_contact where deleted=0 and status='Active'")->row();
	$data['soc'] = '';
	$data['areas'] = $this->db->query("select * from tbl_areas where deleted=0 and id=$id")->row();
	$data['loc'] = "";
	
	$this->load->view("general/general",$data);

}

public function editArea(){

	$id = $this->input->post("area_id");
	$loc_name = $this->input->post("location",true);
	$area = $this->input->post("area",true);
	$assign_to = $this->input->post("assign_to",true);

	$lchk = $this->db->get_where("tbl_areas",array("area_name"=>$area,"assign_to"=>$assign_to,"id !="=>$id))->num_rows();
	
	if($lchk == 1){
		
		$this->alert->pnotify("error","Area Already Exists","error");
		
		redirect("general");
		
	}
	
	 $data = array(

		"city_id" => $loc_name,
		"area_name" => $area,
		"assign_to" => $assign_to

	);	

	 $this->db->set($data);
	 $this->db->where("id",$id);
	 $c = $this->db->update("tbl_areas");

 	if($c){

 			$this->alert->pnotify("success","Area Successfully Updated","success");
			redirect("general/update-area/".$id);
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Area","error");
			redirect("general/update-area/".$id);
	}
}

public function areastatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_areas");
		
		if($d){
			if($status=="Active"){
				echo 1;
				//echo $this->alert->pnotify("Success","Successfully Social Site Enabled","success");
			}else{
				echo 0;
				//echo $this->alert->pnotify("Success","Successfully Social Site Disabled","success");	
			}

		}else{
			if($status=="Inactive"){
				echo 2;
				//echo $this->alert->pnotify("Error","Error Occured While Enabling Social Site","error");
			}else{
				echo 3;
				//echo $this->alert->pnotify("Error","Error Occured While Disabling Social Site","error");
			}	
		}
		
		
	}

public function delArea($id){


	$this->db->where("id",$id);
	$dd = $this->db->delete("tbl_areas");

	if($dd){
	  $this->alert->pnotify("success","area Successfully Deleted","success");
		//redirect("pages/news-and-community/".$pid);
      }else{
      	$this->alert->pnotify("error","Error Occured While Deleting area","error");
		//redirect("pages/news-and-community/".$pid);
      }

}
	
// areas Ends		
	


// charges starts
	

public function insertCharges(){

	$loc_name = $this->input->post("location",true);
	$dCharges = $this->input->post("deliveryCharges",true);
	$cCharges = $this->input->post("cutoffCharges",true);
	$mCharges = $this->input->post("minCharges",true);
	$chargeType = $this->input->post("chargeType",true);
	$orderType = $this->input->post("orderType",true);

	if($chargeType == "deliveryCharges"){
		
		$delCharges = $dCharges;
		$coffCharges = $cCharges;
		$minCharges = "";
		
	}else{
		
		$delCharges = "";
		$coffCharges = "";
		$minCharges = $mCharges;
		
	}
	
	$cChk = $this->db->get_where("tbl_charges",array("deliveryType"=>$orderType,"city_id"=>$loc_name))->num_rows();
	
	if($cChk == 1){
		
		$this->alert->pnotify("error","Already added","error");
		redirect("general");
		
	}
	
	
 	$data = array(
 		
 		"city_id" => $loc_name,
 		"chargeType" => $chargeType,
		"deliveryType" => $orderType,
		"deliveryCharges" => $delCharges,
		"cutoffCharges" => $coffCharges,
		"minimumCharges" => $minCharges
 
 	);	

 	$sn = $this->db->insert("tbl_charges",$data);

 	if($sn){

 			$this->alert->pnotify("success","Successfully Added","success");
			redirect("general");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Adding","error");
			redirect("general");
	}
}
public function updateCharges(){

	$id = $this->input->post("c_id",true);
	$loc_name = $this->input->post("location",true);
	$dCharges = $this->input->post("deliveryCharges",true);
	$cCharges = $this->input->post("cutoffCharges",true);
	$mCharges = $this->input->post("minCharges",true);
	$chargeType = $this->input->post("chargeType",true);
	$orderType = $this->input->post("orderType",true);

	if($chargeType == "deliveryCharges"){
		
		$delCharges = $dCharges;
		$coffCharges = $cCharges;
		$minCharges = "";
		
	}else{
		
		$delCharges = "";
		$coffCharges = "";
		$minCharges = $mCharges;
		
	}
	
	$cChk = $this->db->get_where("tbl_charges",array("deliveryType"=>$orderType,"city_id"=>$loc_name,"id !="=>$id))->num_rows();
	
	if($cChk == 1){
		
		$this->alert->pnotify("error","Already added","error");
		redirect("general");
		
	}
	
 	$data = array(
 		
 		"city_id" => $loc_name,
 		"chargeType" => $chargeType,
		"deliveryType" => $orderType,
		"deliveryCharges" => $delCharges,
		"cutoffCharges" => $coffCharges,
		"minimumCharges" => $minCharges
 
 	);	

 	$sn = $this->db->where("id",$id)->update("tbl_charges",$data);

 	if($sn){

 			$this->alert->pnotify("success","Successfully Updated","success");
			redirect("general");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating","error");
			redirect("general");
	}
}
	
	
public function delCharges($id){


	$dd = $this->db->delete("tbl_charges",array("id"=>$id));

	if($dd){
	  $this->alert->pnotify("success","Successfully Deleted","success");
		//redirect("pages/news-and-community/".$pid);
      }else{
      	$this->alert->pnotify("error","Error Occured While Deleting","error");
		//redirect("pages/news-and-community/".$pid);
      }

}	
	
	
	public function chargestatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_charges");
		
		if($d){
			if($status=="Active"){
				echo 1;
				//echo $this->alert->pnotify("Success","Successfully Social Site Enabled","success");
			}else{
				echo 0;
				//echo $this->alert->pnotify("Success","Successfully Social Site Disabled","success");	
			}

		}else{
			if($status=="Inactive"){
				echo 2;
				//echo $this->alert->pnotify("Error","Error Occured While Enabling Social Site","error");
			}else{
				echo 3;
				//echo $this->alert->pnotify("Error","Error Occured While Disabling Social Site","error");
			}	
		}
		
		
	}	
	
	
// 	

}

