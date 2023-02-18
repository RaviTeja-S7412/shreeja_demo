<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Offers_api extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}
	
	
	public function check_value_offer_on_this_day($dtype,$total,$uid){
	    
	    $chkOffext = $this->db->get_where("orders",array("user_id"=>$uid,"hasOffer"=>"Active","payment_status"=>"Success"))->num_rows();	
	    
	    $cartdata = $this->db->get_where("tbl_cart",["userid"=>$uid])->result_array();
	    $date = date("m/d/Y", strtotime("now"));
	    
	    $udata = $this->db->get_where("shreeja_users",array("userid"=>$uid))->row();
	 
	    $query = $this->db->query("SELECT * FROM tbl_product_offers WHERE '$date' between from_date AND to_date AND offerType='Amount' and status='Active' and city='$udata->user_location' order by cartValue DESC");
	    $sOffer = $this->db->query("SELECT * FROM tbl_product_offers WHERE offerType='sameProduct' and status='Active' and city='$udata->user_location'");
	    $cOffer = $this->db->query("SELECT * FROM tbl_product_offers WHERE offerType='crossProduct' and status='Active' and city='$udata->user_location'");
	    
	    $cContents = $this->db->get_where("tbl_cart",["userid"=>$uid])->result_array();
		foreach($cContents as $key => $items){
			if($items['order_ref'] == "offer"){
                $this->db->delete("tbl_cart",["id"=>$items["id"]]);
			}
		}
	    
	   // return array("status"=>true,"offer"=>$chkOffext);
	    
	    $offerproducts = [];
	    $status = false;
	    
	    if($query->num_rows() > 0){
	        
	        if($chkOffext > 0){
	        
    	       // return array("status"=>false,"offer"=>[]);
    	        
    	    }else{
    	        
    	         if($query->num_rows() > 0){
    	             
    	             $status = true;
    	             
    	             foreach($query->result_array() as $row2){
    	                 
    	                if($total >=$row2['cartValue']){
                            
                            $productid = $row2['outputProduct'];
                               
                            $query2 = $this->db->where(array("id"=>$productid))->get("tbl_products")->row_array();
                    	    $data1['Text'] ="One offer added to your cart ". $query2['product_name'];
                	    	$data1['type'] =$row2['orderType'];
                	    	$data1['qty'] = 1;
                	    	$data1['pid'] = $productid;
                			$data1['product_image'] = $query2['product_image'];
                		    $data1['product_banner'] = $query2['product_banner_image'];
                		   
    						$offerproducts[] = $data1;
                                
                        }  
    	             }
    	         }
    	    }
	    }
	    
	    
	    if($sOffer->num_rows() > 0 ){
			   
			$sameProducts  = $sOffer->result_array();
			
			foreach($sameProducts as $row){
    			$pid =  $row['inputProduct'];
    			$qty =  $row['inputQty'];
    
    			$cdata = $this->db->get_where("tbl_cart",["userid"=>$uid])->result_array();
    
        			$sStatus = "";
        			$getQty = "";
        
        			foreach($cdata as $c){
        				
        				if($c["product_id"] == $pid && $c["qty"] >= $qty){
        
        					$sStatus = true;
                            $getQty = $c["qty"];
        
        				}
        
        			}
    
    
    			 if($sStatus){
    
    				 if ((strtotime($date) >= strtotime($row["from_date"])) && (strtotime($date) <= strtotime($row["to_date"]))){
    
                            $status = true;
    						$productid = $row['inputProduct'];
    						/*$pdata = $this->get_product($productid);
    						$cat = json_decode($pdata["product_quantity"]);
    
    
    						$pid = $productid;
    						$price = 0;
    						$category = $cat->quantity[0];*/
    						$qty = $row['outputQty'];
    						
    						$query2 = $this->db->where(array("id"=>$productid))->get("tbl_products")->row_array();
                    	    $data1['Text'] ="One offer added to your cart ". $query2['product_name'];
                	    	$data1['type'] =$row['orderType'];
                	    	$data1['qty'] = ($qty*$getQty);
                	    	$data1['pid'] = $productid;
                			$data1['product_image'] = $query2['product_image'];
                		    $data1['product_banner'] = $query2['product_banner_image'];
                		   
    						$offerproducts[] = $data1;
    
    
    
    
    					}
    
    			 }
    			 
    			 
	        } 

		}
		
		if($cOffer->num_rows() > 0 ){
			  
			$crossProducts  = $cOffer->result_array();
			$cContents = $this->db->get_where("tbl_cart",["userid"=>$uid])->result_array();
			
			foreach($crossProducts as $row){

    			$sStatus = "";
    			$getQty = "";
                $pid =  $row['inputProduct'];
    			$qty =  $row['inputQty'];
    			
    			foreach($cContents as $c){
    				
    				if($c["product_id"] == $pid && $c["qty"] >= $qty){
    
    					$sStatus = true;
                        $getQty = $c["qty"];
    
    				}
    
    			}
    
    
    			 if($sStatus){
    
    				 if ((strtotime($date) >= strtotime($row["from_date"])) && (strtotime($date) <= strtotime($row["to_date"]))){
    
                            $status = true;
    						$productid = $row['outputProduct'];
    						/*$pdata = $this->get_product($productid);
    						$cat = json_decode($pdata["product_quantity"]);
    
    						$pid = $productid;
    						$price = 0;
    						$category = $cat->quantity[0];*/
    						$qty = $row['outputQty'];
    						
    						$query2 = $this->db->where(array("id"=>$productid))->get("tbl_products")->row_array();
                    	    $data1['Text'] ="One offer added to your cart ". $query2['product_name'];
                	    	$data1['type'] =$row['orderType'];
                	    	$data1['qty'] = ($qty*$getQty);
                	    	$data1['pid'] = $productid;
                			$data1['product_image'] = $query2['product_image'];
                		    $data1['product_banner'] = $query2['product_banner_image'];
                		   
    						$offerproducts[] = $data1;
    
    						/*$data = array(
    							"category" => $category,
    							"qty" => ($qty*$getQty),
    							"product_id" =>$pid,
    							"ref" => "offer"
    						);
    
    						$offerproducts[] = $sodata;*/
    
    					}
    
    			 }
            }

	   }
	   
	   return array("status"=>$status,"offer"=>$offerproducts);
	   
	}
	
// 	public function get_product($pid){
	    
// 		$query = $this->db->where(array("id"=>$pid))->get("tbl_products")->row_array();
// 		return $query;
// 	}
	
	    
	public function value_offer_notification($type,$total,$uid){
	    
	    
	    $chkOffext = $this->db->get_where("orders",array("user_id"=>$uid,"hasOffer"=>"Active","payment_status"=>"Success"))->num_rows();	
	    
	    if($chkOffext != 0){
	        
	        return array("status"=>false,"offer"=>[]);
	        
	    }
	    
	    $date = date("m/d/Y", strtotime("now"));
	    $query = $this->db->query("SELECT * FROM tbl_product_offers WHERE '$date' between from_date AND to_date AND offerType='$type' and orderType='deliveryonce' and  status='Active' order by cartValue DESC");
	    $squery = $this->db->query("SELECT * FROM tbl_product_offers WHERE '$date' between from_date AND to_date AND offerType='$type' and orderType='subscribe' and  status='Active' order by cartValue DESC");
	    $data=[];
	    $i=0;
	    if($query->num_rows() > 0 || $squery->num_rows() > 0){
	        
	         $row  = $query->row_array();
             $value =  $row['cartValue'];
	        
	             
	             foreach($query->result_array() as $row2){
	                 
	                if($total >=$row2['cartValue']){
                            $productid = $row2['outputProduct'];
                            	$query2 = $this->db->where(array("id"=>$productid))->get("tbl_products")->row_array();
                    	    	$data1['Text'] ="One offer added to your cart ". $query2['product_name'];
                    	    	$data1['type'] =$row2['orderType'];
                    			$data1['product_image'] = $query2['product_image'];
                    		    $data1['product_banner'] = $query2['product_banner_image'];
                    		    $data[$i] = $data1;
                    		    $i++;
                            // return array("status"=>true,"offer"=>$data);
                            //return array("status"=>true,"offer"=>$this->get_product($productid));
                        break;    
                    }  
    	         }
	       // }
	        
// subscribe

	             
	             foreach($squery->result_array() as $row2){
	                 
	                if(($total*30) >=$row2['cartValue']){
                            $productid = $row2['outputProduct'];
                            	$query2 = $this->db->where(array("id"=>$productid))->get("tbl_products")->row_array();
                    	    	$data1['Text'] ="One offer added to your cart ". $query2['product_name'];
                    	    	$data1['type'] =$row2['orderType'];
                    			$data1['product_image'] = $query2['product_image'];
                    		    $data1['product_banner'] = $query2['product_banner_image'];
                    		    $data[$i] = $data1;
                    		    $i++;
                            // return array("status"=>true,"offer"=>$data);
                            //return array("status"=>true,"offer"=>$this->get_product($productid));
                        break;    
                    }  
    	         }
	       // }
	        
	        
	         return array("status"=>true,"offer"=>$data);
	    } else{
	       return array("status"=>false,"offer"=>[]);  
	    } 
	}
	
	
	public function get_product($pid){
	    
		$query = $this->db->where(array("id"=>$pid))->get("tbl_products")->row_array();
		$data['product_name'] = $query['product_name'];
		$data['description'] = $query['description'];
		$data['product_image'] = $query['product_image'];
		$data['product_banner'] = $query['product_banner_image'];
		return $data;
	}

    
}