<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Updatehistory_model extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}

    public function agentorderupdateHistory($odata,$oid,$uid,$aid){
        
        $uoData = $this->db->get_where("agent_orders",array("order_id"=>$oid))->row();

		$exproducts = json_decode($odata->product_id);
		$upproducts = json_decode($uoData->product_id);
	
		$desc = array();				

		foreach($exproducts as $key => $p){

			$pData = $this->db->get_where("tbl_products",array("id"=>$p->productId))->row();

			$uppro = $upproducts[$key];

			if($p->productQty != 0){

				if($p->productQty != $uppro->productQty){

					$desc[] = "Quantity has been changed from ".$p->productQty.$p->qtyType." to ".$uppro->productQty.$uppro->qtyType." for ".$pData->product_name;

				}

			}

		}

		if(strtotime($odata->delivery_date) != strtotime($uoData->delivery_date)){

			$desc[] = "Delivery date has been changed from ".date("d-M-y",strtotime($odata->delivery_date))." to ".date("d-M-y",strtotime($uoData->delivery_date))." for Order ID : ".$oid;

		}

		if($odata->order_delivery_time != $uoData->order_delivery_time){

			$desc[] = "Delivery time has been changed from ".$odata->order_delivery_time." to ".$uoData->order_delivery_time." for Order ID : ".$oid;

		}

		if(count($desc) > 0){

			foreach($desc as $up){

				$data = array("agent_order_id"=>$oid,"description"=>$up,"updated_by"=>$uid,"agent_id"=>$aid);
				$this->db->insert("agent_order_update_history",$data);
			}

		}
        
    }
	
	public function deletedHistory($oid,$aid){
		
		$aname = $this->db->get_where("fdm_va_auths",array("id"=>$aid))->row()->name;
		
		$cby = $this->db->get_where("agent_orders",array("order_id"=>$oid))->row()->agent_id;
		
		$up = "Order ID : ".$oid." is deleted by $aname";
		
		$data = array("agent_order_id"=>$oid,"description"=>$up,"updated_by"=>$aid,"agent_id"=>$cby);
		$this->db->insert("agent_order_update_history",$data);
		
	}
	

}