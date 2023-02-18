<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Offers extends CI_Controller {
public function __construct(){
			
	parent::__construct();
	$this->secure->loginCheck();
	
}
public function index(){
	
	$data["offers"] = $this->db->query("select * from tbl_offer_management order by id desc")->result();
	$this->load->view("offers/allOffers",$data);

}

	
public function editOffer($id){
	
	
	$data["o"] = $this->db->get_where("tbl_offer_management",array("id"=>$id))->row();
	$data["offers"] = $this->db->query("select * from tbl_offer_management order by id desc")->result();
	$this->load->view("offers/allOffers",$data);

}	
	
// Price Management	
	
public function insertOffer(){

	$pid = $this->input->post("product");
	$qty = $this->input->post("qty");
	$sdate = $this->input->post("start_date");
	$edate = $this->input->post("end_date");	
	$otype = $this->input->post("orderType");	
	$price = $this->input->post("price");	
	$city = $this->input->post("city");
	$desc = $this->input->post("description");
	$promoCode = strtoupper(random_string('alnum',8));
	
	if(strtotime($edate) < strtotime($sdate)){
		
		$this->alert->pnotify("error","End date should be greater than Start date","error");
		redirect("offers");
		
	}
	
	$oMng = $this->db->get_where("tbl_offer_management",array("product_id"=>$pid))->result();
	
	$pchk = $this->db->get_where("tbl_products",array("id"=>$pid,"status"=>"Active","deleted"=>0,"assigned_to"=>"consumers"))->row();

	$ecat = json_decode($pchk->product_quantity);
	
	$exQty = $ecat->quantity;
	$exPrice = $ecat->price;
	
	foreach($exQty as $key => $ep){

		if($qty == $ep){
			
			if($price >= $exPrice[$key]){
	
				$this->alert->pnotify("error","Please Enter Valid Amount","error");
				redirect("offers/editOffer/".$oid);

			}
		}

	}
	
	
	if($pchk){
		
		$config['upload_path']          = 'uploads/offers/';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['overwrite'] = TRUE;


		$this->load->library('upload', $config);

		$this->upload->do_upload("image");

		$d=$this->upload->data();

		$image='uploads/offers/'.$d['file_name'];

			
	   $data = array("product_id"=>$pid,"qty"=>$qty,"price"=>$price,"startDate"=>$sdate,"endDate"=>$edate,"promocode"=>$promoCode,"order_type"=>$otype,"city"=>$city,"description"=>$desc,"image"=>$image);

	   $pm = $this->db->insert("tbl_offer_management",$data);

	   if($pm){

			$this->alert->pnotify("success","Successfully Offer Added","success");
			redirect("offers");

		}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("offers");

		}
			
	
		
	}else{
		
			$this->alert->pnotify("error","Error Occured Product is in Inactive","error");
			redirect("offers");
		
	}
	
	
}	

public function updateOffer(){

	$oid = $this->input->post("oid");
	$pid = $this->input->post("product");
	$qty = $this->input->post("qty");
	$sdate = $this->input->post("start_date");
	$edate = $this->input->post("end_date");	
	$otype = $this->input->post("orderType");	
	$price = $this->input->post("price");	
	$city = $this->input->post("city");
	$desc = $this->input->post("description");
	
	if(strtotime($edate) < strtotime($sdate)){
		
		$this->alert->pnotify("error","End date should be greater than Start date","error");
		redirect("offers");
		
	}
	
	$oMng = $this->db->get_where("tbl_offer_management",array("id"=>$oid))->row();
	
	$pchk = $this->db->get_where("tbl_products",array("id"=>$pid,"status"=>"Active","deleted"=>0,"assigned_to"=>"consumers"))->row();

	$ecat = json_decode($pchk->product_quantity);
	
	$exQty = $ecat->quantity;
	$exPrice = $ecat->price;
	
	foreach($exQty as $key => $ep){

		if($qty == $ep){
			
			if($price >= $exPrice[$key]){
	
				$this->alert->pnotify("error","Please Enter Valid Amount","error");
				redirect("offers/editOffer/".$oid);

			}
		}

	}

	
	
	
	if($pchk){
		
  	  if($_FILES['image']['size']!='0'){
		  
		$config['upload_path']          = 'uploads/offers/';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['overwrite'] = TRUE;


		$this->load->library('upload', $config);

		$this->upload->do_upload("image");

		$d=$this->upload->data();

		$image='uploads/offers/'.$d['file_name'];
		  
	  }else{
		  
		 $image = $oMng->image; 
	  }
		
		
	   $data = array("product_id"=>$pid,"qty"=>$qty,"price"=>$price,"startDate"=>$sdate,"endDate"=>$edate,"order_type"=>$otype,"city"=>$city,"description"=>$desc,"image"=>$image);
		
		
	   $this->db->set($data);
	   $this->db->where("id",$oid);	
	   $pm = $this->db->update("tbl_offer_management");

	   if($pm){

			$this->alert->pnotify("success","Successfully Offer Updated","success");
			redirect("offers");

		}else{

			$this->alert->pnotify("error","Error Occured Please Try Again","error");
			redirect("offers");

		}
			
	
		
	}else{
		
			$this->alert->pnotify("error","Error Occured Product is in Inactive","error");
			redirect("offers");
		
	}
	
	
}	


	
public function delOffer($id){


	$d = $this->db->delete("tbl_offer_management",array("id"=>$id));

	if($d){
			$this->alert->pnotify("success","Successfully Deleted","success");
//			redirect("products");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting","error");
//			redirect("products");
	}
}	
	

// Free Sample	
	
public function freeSampleproducts(){
	
	$this->load->view("products/sampleProducts");
	
}	
	
	
public function getProductquantity(){
		
		$id=$this->input->get("id",true);
		
		$d=$this->products_model->getProduct($id);
		
		$qty = json_decode($d->product_quantity);
	
		echo '<option value="">Select Quantity</option>';
	
		foreach($qty->quantity as $q){
			
			echo '<option value="'.$q.'">'.$q.'</option>';
		}
		
}

	
// Cross product offers starts
	
	
public function productOffers()
	{
		$this->load->view('productOffers/productOffers');
	}
	
	
public function insertCrossoffer(){

	$loc_name = $this->input->post("location",true);
	$offerType = $this->input->post("offerType",true);
	$startDate = $this->input->post("startDate",true);
	$endDate = $this->input->post("endDate",true);
	$orderType = $this->input->post("orderType",true);
	$inProduct = $this->input->post("inProduct",true);
	$inQty = $this->input->post("inQty",true);
	$outProduct = $this->input->post("outProduct",true);
	$outQty = $this->input->post("outQty",true);
	$description = $this->input->post("description",true);
	$cartValue = $this->input->post("cartValue",true);

	$config['upload_path']          = "uploads/crossProducts/";
	$config['allowed_types']        = 'gif|jpg|png|jpeg';

	$this->load->library('upload', $config);

	if($this->upload->do_upload("image")){

	$d=$this->upload->data();

		$icon = "uploads/crossProducts/".$d['file_name'];

	}else{

		$this->alert->pnotify("error","Please Select Valid Image","error");
		redirect("offers/productOffers");

	}
	
 	$data = array(
 		
 		"city" => $loc_name,
 		"from_date" => $startDate,
		"to_date" => $endDate,
		"orderType" => $orderType,
		"inputProduct" => $inProduct,
		"inputQty" => $inQty,
		"outputProduct" => $outProduct,
		"outputQty" => $outQty,
		"offerType" => $offerType,
		"cartValue" => $cartValue,
		"description" => $description,
		"banner" => $icon,
 
 	);	

 	$sn = $this->db->insert("tbl_product_offers",$data);

 	if($sn){

 			$this->alert->pnotify("success","Offer Successfully Added","success");
			redirect("offers/productOffers");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Adding Offer","error");
			redirect("offers/productOffers");
	}
}
		
public function offerstatus(){

	$id=$this->input->post_get("id",true);
	$status = $this->input->post("status",true);
	$data=array('status'=>$status);

	$this->db->set($data);
	$this->db->where("id",$id);
	$d=$this->db->update("tbl_product_offers");

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
	
public function editCrossoffer($id){
	
	$data["oo"] = $this->db->get_where("tbl_product_offers",array("id"=>$id))->row();
	$this->load->view('productOffers/productOffers',$data);
	
}	
	
public function updateCrossoffer(){

	$id = $this->input->post("id",true);
	$loc_name = $this->input->post("location",true);
	$offerType = $this->input->post("offerType",true);
	$startDate = $this->input->post("startDate",true);
	$endDate = $this->input->post("endDate",true);
	$orderType = $this->input->post("orderType",true);
	$inProduct = $this->input->post("inProduct",true);
	$inQty = $this->input->post("inQty",true);
	$outProduct = $this->input->post("outProduct",true);
	$outQty = $this->input->post("outQty",true);
	$description = $this->input->post("description",true);
	$cartValue = $this->input->post("cartValue",true);

	$schk = $this->db->get_where("tbl_product_offers",array("id"=>$id))->row();
	
	if($_FILES['image']['size']!='0'){
	  	$config['upload_path']          = "uploads/crossProducts/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
		
        $this->load->library('upload', $config);
		
		if($this->upload->do_upload("image")){
		
		$d=$this->upload->data();
		
 		$icon = "uploads/crossProducts/".$d['file_name'];
 	
 		unlink($schk->banner);
 		}else{

 			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("offers/productOffers");

 		}

 	}else{
 		$icon = $schk->banner;
 	}	
	
 	$data = array(
 		
 		"city" => $loc_name,
 		"from_date" => $startDate,
		"to_date" => $endDate,
		"orderType" => $orderType,
		"inputProduct" => $inProduct,
		"inputQty" => $inQty,
		"outputProduct" => $outProduct,
		"outputQty" => $outQty,
		"offerType" => $offerType,
		"cartValue" => $cartValue,
		"description" => $description,
		"banner" => $icon,
 
 	);	

 	$sn = $this->db->where("id",$id)->update("tbl_product_offers",$data);

 	if($sn){

 			$this->alert->pnotify("success","Offer Successfully Updated","success");
			redirect("offers/productOffers");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Offer","error");
			redirect("offers/productOffers");
	}
}
	
public function delCrossoffer($id){

	$d = $this->db->delete("tbl_product_offers",array("id"=>$id));

	if($d){
			$this->alert->pnotify("success","offer Successfully Deleted","success");
			redirect("offers/productOffers");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting offer","error");
			redirect("offers/productOffers");
	}
}	
	
	
	

public function insertCrossproduct(){

	$loc_name = $this->input->post("pname",true);
	$prid = $this->input->post("prId",true);

	$lchk = $this->db->get_where("tbl_cross_products",array("product_name"=>$loc_name))->num_rows();
	
	if($lchk == 1){
		
		$this->alert->pnotify("error","Product Already Exists","error");
		
		redirect("offers/productOffers");
		
	}
	
	
	  	$config['upload_path']          = "uploads/crossProducts/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
		
        $this->load->library('upload', $config);
		
		if($this->upload->do_upload("image")){
		
		$d=$this->upload->data();
		
 			$icon = "uploads/crossProducts/".$d['file_name'];
 		
 		}else{

 			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("offers/productOffers");

 		}
	
	
 	$data = array(
 		
 		"product_id" => $prid,
 		"product_name" => $loc_name,
		"image" => $icon,
 
 	);	

 	$sn = $this->db->insert("tbl_cross_products",$data);

 	if($sn){

 			$this->alert->pnotify("success","Product Successfully Added","success");
			redirect("offers/productOffers");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Adding Product","error");
			redirect("offers/productOffers");
	}
}

public function editCrossproduct(){

	$id = $this->input->post("pid");
	$loc_name = $this->input->post("pname",true);
	$prid = $this->input->post("prId",true);

	$lchk = $this->db->get_where("tbl_cross_products",array("product_name"=>$loc_name,"id !="=>$id))->num_rows();
	$schk = $this->db->get_where("tbl_cross_products",array("id"=>$id))->row();
	
	if($lchk == 1){
		
		$this->alert->pnotify("error","Product Already Exists","error");
		
		redirect("offers/productOffers");
		
	}
	
		if($_FILES['image']['size']!='0'){
	  	$config['upload_path']          = "uploads/crossProducts/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
		
        $this->load->library('upload', $config);
		
		if($this->upload->do_upload("image")){
		
		$d=$this->upload->data();
		
 		$icon = "uploads/crossProducts/".$d['file_name'];
 	
 		unlink($schk->image);
 		}else{

 			$this->alert->pnotify("error","Please Select Valid Image","error");
			redirect("offers/productOffers");

 		}

 	}else{
 		$icon = $schk->image;
 	}	

	
		 $data = array("image" => $icon,"product_name" => $loc_name,"product_id" => $prid);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $c = $this->db->update("tbl_cross_products");

 	if($c){

 			$this->alert->pnotify("success","Location Successfully Updated","success");
			redirect("offers/productOffers");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Location","error");
			redirect("offers/productOffers");
	}
}
	
public function delProduct($id){

	$d = $this->db->delete("tbl_cross_products",array("id"=>$id));

	if($d){
			$this->alert->pnotify("success","product Successfully Deleted","success");
			redirect("offers/productOffers");
	}else{

			$this->alert->pnotify("error","Error Occured While Deleting product","error");
			redirect("offers/productOffers");
	}
}
	
	
	
	
	
	

}
