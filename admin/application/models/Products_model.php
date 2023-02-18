<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Products_model extends CI_Model{


	public function allProducts(){
		
		return $this->db->query("select * from tbl_products where deleted=0 order by id desc")->result();
		
	}
	
	
	public function allConsumerproducts(){
		
		return 	$this->db->query("select * from tbl_products where deleted=0 and assigned_to='consumers' order by id desc")->result();
		
	}
	
	public function getProduct($id){
		
		return $this->db->get_where("tbl_products",array("deleted"=>0,"id"=>$id))->row();
		
	}
	
	public function productDiscountprice($pid){
		
		
		$pdate = date("m/d/Y");
		
		$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"id"=>$pid,"assigned_to"=>"agents"))->row();
		
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
	
/*	public function getinvoiceData($oid){
	
$zero = array();
$five = array();
$twelve = array();
$eighteen = array();
$quantity = array();	
	
	
$opdata = $this->db->get_where("order_products",array("order_id"=>$oid))->result(); 
	
	
	  foreach($opdata as $op){

		  $zero[] = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"gst_charges"=>"0","assigned_to"=>'consumers'))->row()->id;
		  $five[] = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"gst_charges"=>"5", "assigned_to"=>'consumers'))->row()->id;
		  $twelve[] = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"gst_charges"=>"12", "assigned_to"=>'consumers'))->row()->id;
		  $eighteen[] = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"gst_charges"=>"18", "assigned_to"=>'consumers'))->row()->id;
		  $quantity[] = $op->qty;
		  
	  }

	
$zvalue = array();	
$fvalue = array();	
$tfvalue = array();	
$tvalue = array();	
$ttvalue = array();	
$evalue = array();	
$tevalue = array();	
	
	
foreach($zero as $key => $z){
	
	$zvalue[] = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$z))->row()->price*$quantity[$key];
	
}
	

foreach($five as $key => $f){
	
	$fval = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$f))->row()->price*$quantity[$key];
	
	$tfvalue[] = $fval;
	$fvalue[] = $fval * 5/100;
	
}
	
foreach($twelve as $key => $t){
	
	$tval = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$t))->row()->price*$quantity[$key];
	
	$ttvalue[] = $tval;
	$tvalue[] = $tval * 12/100;
}	
foreach($eighteen as $key => $t){
	
	$eval = $this->db->get_where("order_products",array("order_id"=>$oid,"product_id"=>$t))->row()->price*$quantity[$key];

	$tevalue[] = $eval;
	$evalue[] = $eval * 18/100;
	
}
	
$data = json_encode(array("zero"=>array_sum($zvalue),"five"=>array_sum($fvalue),"tfive"=>array_sum($tfvalue),"twelve"=>array_sum($tvalue),"ttwelve"=>array_sum($ttvalue),"eighteen"=>array_sum($evalue),"teighteen"=>array_sum($tevalue),"qty"=>array_sum($quantity)));

return $data; 
	
	
	
}	*/


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