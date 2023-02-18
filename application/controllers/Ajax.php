<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

public function __construct(){
			
		   parent::__construct();
	
 }

public function getCategoryprice(){
	
	$pid = $this->input->post("pid");
	$cid = $this->input->post("cid");
				
	$pdate = date("m/d/Y");
						
	$pcat = $this->db->get_where("tbl_products",array("id"=>$pid,"status"=>"Active","deleted"=>0,"assigned_to"=>'consumers'))->row()->product_quantity;
	
	$pm = $this->db->query("select * from tbl_price_management where product_id = '$pid' AND  '$pdate' BETWEEN  startdate AND enddate and deleted=0 and status='Active'")->row();

	$extCat = json_decode($pcat);
	
	
	if($pm){
	
		$discPm = json_decode(isset($pm->price_management) ? $pm->price_management : "");

		$disType = isset($discPm->discount_type) ? $discPm->discount_type : "";

		$disQty = isset($discPm->quantity) ? $discPm->quantity : "";

		$disPrice = isset($discPm->price) ? $discPm->price : "";

		if(count($disQty) > 0){

			foreach($disQty as $key => $qty){

				if($cid == $qty){

					if($disPrice[$key] != ""){
					
						if($disType == "percent"){
							
							$pe = $disPrice[$key]/100*$extCat->price[$key];	
											
							$disp = $extCat->price[$key]-$pe;
							
			echo json_encode(array("dis_type"=>"percent","price"=>$disp,"percentage"=>$disPrice[$key],"extprice"=>$extCat->price[$key]));		
						
						}else{
							
							$disp = $disPrice[$key];
							
							$ddPrice = $extCat->price[$key] - $disp;
							echo json_encode(array("dis_type"=>"rs","price"=>$disp,"disPrice"=>$ddPrice,"extprice"=>$extCat->price[$key]));							
						}
					
					}else{
						
						
						$ep = $extCat->price[$key];
						echo json_encode(array("dis_type"=>"ext","price"=>$ep));	
						
					}
				}

			}
		}
	}else{
		
		foreach($extCat->quantity as $key => $qty){
		
		if($cid == $qty){
			
				$ep = $extCat->price[$key];
				echo json_encode(array("dis_type"=>"ext","price"=>$ep));	
			}
		}
		
	}
  }
	
	
 public function cartUpdate(){
	 
	 $quantity = $this->input->post("qty");
	 $cartid = $this->input->post("cart_id");
	 
		$cdata = array('rowid'  => $cartid,'qty'  => $quantity );
		
	 
		$c = $this->cart->update($cdata);
	 
	 	if($c){
			
			echo $this->cart->total();
			
		}
	 	
 }	
	
public function getsubQuantity(){
	
	$qty = $this->input->post("qty");
	$meas = $this->input->post("measurement");
	
	$data = array();

	foreach($qty as $key => $value){
		
		$int = number_format($value*30);
		
		$chkVal = $value*30;
		
		
		if($chkVal >= 1000){
			
			if($meas[$key] == "ML"){
		
				$data[] = round(str_replace(",",".",$int),2)." L";
		
			}else{
				
				$data[] = round(str_replace(",",".",$int),2)." KG";
			}
				
		}else{
			
			if($meas[$key] == "ML"){
		
				$data[] = round(str_replace(",",".",$int),2)." L";
		
			}else{
				
				$data[] = round(str_replace(",",".",$int),2)." KG";
			}			
		}
	}
	
//	print_r($data);
	
	echo json_encode(array("qty"=>$data));
	
}	
 
	
	
}
	

