<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Indentordersexport extends CI_Controller {
	
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
	
}

	
public function index(){

	$data["u"] = "";
	$this->load->view("orders/agentOrders/indentordersExport");
}

public function getOrders($sdate="",$edate="",$shift="",$city=""){
	
	$role = $this->admin->get_admin("role");
	$aagt = json_decode($this->admin->get_admin("assigned_agents"));
	
	if($role == 7){
		
		if($shift != ""){
			
			$this->db->where("order_delivery_time",$shift);
			
		}
		if($city != ""){
			
			$this->db->where("city",$city);
			
		}
		if($sdate != ""){
			
			$this->db->where("delivery_date between '$sdate' and '$edate'");
			
		}
		
		$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",$aagt->agents)->get_where("agent_orders")->result();
		
	}elseif($role == 12){
		
		$bdas = $this->db->select("assigned_agents")->where_in("id",$aagt->salesemployees)->get_where("fdm_va_auths",array("deleted"=>0))->result();
		
		$agents = array();
		
		foreach($bdas as $bd){
			
			$adata = json_decode($bd->assigned_agents,TRUE);
			
			$agt = array();
			foreach($adata["agents"] as $i => $ag){
				
				$agt[] = $ag;
				
//				$arr = array_merge($adata["agents"],$adata["agents"][$i]);
				
			}
			
			
			$agents[] = $agt;
			
		}
		
		if(count($agents) > 1){
			$arr = [];
			for($i = 0; $i < count($agents); $i++){

				$arr = array_merge($arr,$agents[$i]);

			}
		}else{
			
			$arr = $agents[0];
			
		}
		
		if($shift != ""){
			
			$this->db->where("order_delivery_time",$shift);
			
		}
		if($city != ""){
			
			$this->db->where("city",$city);
			
		}
		if($sdate != ""){
			
			$this->db->where("delivery_date between '$sdate' and '$edate'");
			
		}
		$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",array_unique($arr))->get_where("agent_orders")->result();
		
	}elseif($role == 11){
				
		$bdas = $this->db->select("assigned_agents")->where_in("id",$aagt->salesemployees)->get_where("fdm_va_auths",array("deleted"=>0))->result();
		
		$agents = array();
		
		foreach($bdas as $bd){
			
			$adata = json_decode($bd->assigned_agents,TRUE);
			
			$agt = array();
			foreach($adata["agents"] as $i => $ag){
				
				$agt[] = $ag;
				
//				$arr = array_merge($adata["agents"],$adata["agents"][$i]);
				
			}
			
			
			$agents[] = $agt;
			
		}
		
		
		if(count($agents) > 1){
			$arr = [];
			for($i = 0; $i < count($agents); $i++){
			    

				$arr = array_merge($arr,$agents[$i]);

			}
		}else{
			
			$arr = $agents[0];
			
		}
		
		if($shift != ""){
			
			$this->db->where("order_delivery_time",$shift);
			
		}
		if($city != ""){
			
			$this->db->where("city",$city);
			
		}
		if($sdate != ""){
			
			$this->db->where("delivery_date between '$sdate' and '$edate'");
			
		}
		$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",array_unique($arr))->get_where("agent_orders")->result();
		
		
	}else{
		
		if($sdate != ""){
			
			$squery = "and delivery_date between '$sdate' and '$edate'";
			
		}else{
			
			$squery = "";
			
		}
		
		if($shift != ""){
			
			$shdata = "and order_delivery_time='$shift'";
			
		}else{
			
			$shdata = "";
			
		}
		if($city != ""){
			
			$ccity = "and city='$city'";
			
		}else{
			
			$ccity = "";
			
		}
		
		$data["orders"] = $this->db->query("select * from agent_orders where deleted=0 $squery $shdata $ccity order by id desc")->result();
		
	}
	
	return $data["orders"];
	
}	
	

public function filterOrders(){
	
	$sdate = date('Y-m-d', strtotime($this->input->post("sdate")));
	$edate = date('Y-m-d', strtotime($this->input->post("edate")));
	$shift = $this->input->post("shift");
	$city = $this->input->post("city");

/*	$this->db->select('order_id,product_id,delivery_date,order_delivery_time,agent_id');
	$this->db->from('agent_orders');
	
	$this->db->where('delivery_date BETWEEN "'. date('Y-m-d', strtotime($sdate)). '" and "'. date('Y-m-d', strtotime($edate)).'"');
	$this->db->where("order_status","Pending");
	if($shift != ""){
		
		$this->db->where("order_delivery_time",$shift);
		
	}
	if($city != ""){
		
		$this->db->where("city",$city);
		
	}
	
	$resutset = $this->db->get();*/
	
	$orders = $this->getOrders($sdate,$edate,$shift,$city);
	
	$jsonData = array();
	
	$id = 1;
	
	foreach($orders as $u){
		
		$products = json_decode($u->product_id);	    	
		$aData = $this->db->get_where("fdm_va_auths",array("id"=>$u->agent_id))->row();
		
//		$product = [];
		
		foreach($products as $p){

            $route = "";

			$pdata = $this->db->select("product_id,product_name")->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row();
			
			$product = $pdata->product_id."<br>"; 
			$category = $pdata->product_name."<br>"; 
			$productQty = $p->productQty."<br>";
			$qtyType = $p->qtyType."<br>";
			
			if($u->order_delivery_time == "morning"){
			    
			    $route = $aData->route;
			    
			}elseif($u->order_delivery_time == "evening"){
			    
			    $route = $aData->eroute;
			    
			}
		
		$nData = array();
		$nData["sno"] = $id;
		$nData["cnumber"] = $aData->agent_id;
		$nData["cname"] = $aData->name;
		$nData["mroute"] = $route;
		$nData["itemcode"] = $product;
		$nData["pname"] =  $category;
		$nData["date"] = date("d.m.Y",strtotime($u->delivery_date));
		$nData["cdate"] = $u->created_date;
		$nData["shift"] = $u->order_delivery_time;
		$nData["qty"] =  $productQty;
		$nData["uom"] =  $qtyType;
		$jsonData[] = $nData;
		
		$id++;
	}
	
	}
	
	$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
	echo json_encode($results);
	
}	
	
}