<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Products_model extends CI_Model{


	public function allProducts(){
		
		return $this->db->get_where("tbl_products",array("deleted"=>0, "assigned_to"=>'consumers'))->result();
		
	}
	
	public function getProduct($id){
		
		return $this->db->get_where("tbl_products",array("deleted"=>0,"id"=>$id, "assigned_to"=>'consumers'))->row();
		
	}
	
	
	public function productDiscountprice($pid){
		
		
		$pdate = date("m/d/Y");
		
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"id"=>$pid, "assigned_to"=>'consumers'))->row();
		
		$cat = json_decode($products->product_quantity);	
							
		$pm = $this->db->query("select * from tbl_price_management where product_id = '$pid' AND  '$pdate' BETWEEN  startdate AND enddate and deleted=0 and status='Active'")->row();
							
		$discPm = json_decode(isset($pm->price_management) ? $pm->price_management : "");
						
		$disType = isset($discPm->discount_type) ? $discPm->discount_type : "";
						
		$disPrice = isset($discPm->price) ? $discPm->price : "";
		
		if($pm){
								
			if(count($disPrice) >= 1){
									
				if($disPrice[0] != ""){
										
					 	if($disType == "percent"){
											
								$pe = $disPrice[0]/100*$cat->price[0];	
											
								$data = $cat->price[0]-$pe;
		
						}else{
											
							$data = $disPrice[0];
						
						}
						
				}else{
						
					$data = $cat->price[0];
								  
				}			
									
			}else{
						
				$data = $cat->price[0];
								  
			}
			
		}else{
								
			$data = $cat->price[0];
		
		}
		
		return($data);
		
	}
	
	
	
	public function getCategoryprice($cid,$pid){
	
//	$pid = $this->input->post("pid");
//	$cid = $this->input->post("cid");
		
	$data = "";	
				
	$pdate = date("m/d/Y");
						
	$pcat = $this->db->get_where("tbl_products",array("id"=>$pid,"status"=>"Active","deleted"=>0, "assigned_to"=>'consumers'))->row()->product_quantity;
	
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
							
			$data = json_encode(array("dis_type"=>"percent","price"=>$disp,"percentage"=>$disPrice[$key],"extprice"=>$extCat->price[$key]));		
						
						}else{
							
							$disp = $disPrice[$key];
							$ddPrice = $extCat->price[$key] - $disp;
							
							$data = json_encode(array("dis_type"=>"rs","price"=>$disp,"disPrice"=>$ddPrice,"extprice"=>$extCat->price[$key]));							
						}
					
					}
				}

			}
		}
	}
		
	return($data);	
		
  }
	
	
	
 public function getSampleorderproducts($catid){
	 
	$products = $this->db->get_where("tbl_sample_products",array("status"=>"Active"))->result(); 
	 
	if(count($products) > 0){	

		foreach($products as $pr){
			
			$sdata[] = $this->db->get_where("tbl_products",array("id"=>$pr->product_id,"product_category"=>$catid, "assigned_to"=>'consumers'))->row();
			$quantity[] = $pr->qty;
			$sid[] = $pr->id;
			
		}
	}
	 
	$data = json_encode(array("sdata"=>$sdata,"quantity"=>$quantity,"sid"=>$sid));
	
	return $data; 
	 
 }	
	
	

public function getinvoiceData($oid){
	
$zero = array();
$five = array();
$twelve = array();
$eighteen = array();
	
	
$zqty = array();	
$fqty = array();	
$tqty = array();	
$eqty = array();
	
$zopid = array();	
$fopid = array();	
$topid = array();	
$eopid = array();	
	
	
$opdata = $this->db->get_where("order_products",array("order_id"=>$oid))->result(); 
	
	
  foreach($opdata as $op){
	  
	  
	  if($op->gst == 0){
		  
		  $zero[] = $op->product_id;
		  $zqty[] = $op->qty;
		  $zopid[] = $op->order_product_id;
		  
	  }
	  
	  if($op->gst == 5){
		  
		  $five[] = $op->product_id;
		  $fqty[] = $op->qty;
		  $fopid[] = $op->order_product_id;
	  }
	  
	  if($op->gst == 12){
		  
		  $twelve[] = $op->product_id;
		  $tqty[] = $op->qty;
		  $topid[] = $op->order_product_id;
	  }
	  
	  if($op->gst == 18){
		  
		  $eighteen[] = $op->product_id;
		  $eqty[] = $op->qty;
		  $eopid[] = $op->order_product_id;
	  }
	  

//	  $zero[] = $this->db->get_where("order_products",array('gst'=>0))->row()->product_id;
//	  $five[] = $this->db->get_where("order_products",array("order_id"=>$oid,'gst'=>5))->row()->product_id;
//	  $twelve[] = $this->db->get_where("order_products",array("order_id"=>$oid,'gst'=>12))->row()->product_id;
//	  $eighteen[] = $this->db->get_where("order_products",array("order_id"=>$oid,'gst'=>18))->row()->product_id;
//	  $quantity[] = $op->qty;

  }

	
$zvalue = array();	
$fvalue = array();	
$tfvalue = array();	
$tvalue = array();	
$ttvalue = array();	
$evalue = array();	
$tevalue = array();	
	
	
foreach($zero as $key => $z){
	
	$zvalue[] = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$z,"order_product_id"=>$zopid[$key]))->row()->price*$zqty[$key];
	
}
	

foreach($five as $key => $f){
	
	$fval = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$f,"order_product_id"=>$fopid[$key]))->row()->price*$fqty[$key];
	
	$fgst = $this->admin->gst_total($fval,5);
	$tfvalue[] = $fval - $fgst;
	$fvalue[] = $fgst;
	
}
	
foreach($twelve as $key => $t){
	
	$tval = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$t,"order_product_id"=>$topid[$key]))->row()->price*$tqty[$key];
	
	$gst = $this->admin->gst_total($tval,12);
	$ttvalue[] = $tval - $gst;
	$tvalue[] = $gst;
}	
foreach($eighteen as $key => $t){
	
	$eval = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$t,"order_product_id"=>$eopid[$key]))->row()->price*$eqty[$key];

    $egst = $this->admin->gst_total($eval,18);
	$tevalue[] = $eval - $egst;
	$evalue[] = $egst;
	
}
	
$data = json_encode(array("zero"=>array_sum($zvalue),"five"=>array_sum($fvalue),"tfive"=>array_sum($tfvalue),"twelve"=>array_sum($tvalue),"ttwelve"=>array_sum($ttvalue),"eighteen"=>array_sum($evalue),"teighteen"=>array_sum($tevalue),"qty"=>array_sum($quantity)));

return $data; 
	
//return($zero);
	
}	
	




}