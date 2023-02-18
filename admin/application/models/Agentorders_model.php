<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Agentorders_model extends CI_Model{


	public function getReportstr(){
		
		$role = $this->admin->get_admin("role");
	
		if($role == 11){

			$tr = array("SNo","status","Date","Shift","TI Code","TI City","TI Name","BDA Code","BDA City","BDA Name","Agent Code","Agent City","Agent Name","Route","Item Code","Item Name","Quantity","UOM","Action");
			
		}elseif($role == 12){

			$tr = array("SNo","status","Date","Shift","BDA Code","BDA City","BDA Name","Agent Code","Agent City","Agent Name","Route","Item Code","Item Name","Quantity","UOM","Action");;

		}elseif($role == 7){
			
			$tr = array("SNo","status","Date","Shift","Agent Code","Agent City","Agent Name","Route","Item Code","Item Name","Quantity","UOM","Action");;
			
		}else{
			
			$tr = array("SNo","status","OrderID","CreatedDate","Date","Shift","AMCity","AM","AMCode","TICity","TIName","TICode","BDACity","BDAName","BDACode","AgentCity","AgentName","AgentCode","Route","ItemName","ItemCode","Quantity","UOM","Action");;
			
		}
		
		return $tr;
		
	}

	
	public function getReporttbody($orders){
		
		$role = $this->admin->get_admin("role");
		$data = array();
		
		if($role == 11){
		
			$tbody = [];
			
			$id = 0;
			foreach($orders as $ord){
			    
			    $agt = $this->getAgtdetails($ord->agent_id);
				$bda = $this->getBdadetails($ord->agent_id);
				$ti = $this->getTidetails($bda["bdaid"]);
				
				$products = json_decode($ord->product_id);	    	
				
				$pname = array();
				$qty = array();
				$uom = array();
				$pcode = array();
				foreach($products as $p){

					$pname[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_name; 
					$pcode[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_id; 
					$qty[] = $p->productQty;
					$uom[] = $p->qtyType;	
				}
				
				$route = "";
				if($ord->order_delivery_time == "morning"){
			    
    			    $route = $agt['mroute'];
    			    
    			}elseif($ord->order_delivery_time == "evening"){
    			    
    			    $route = $agt['eroute'];
    			    
    			}
				
				$actions = "";
				$status = "";
				
				$actions = '<a href="'.base_url().'orders/agent-order/updateOrder/'.$ord->order_id.'" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a><a href="'.base_url().'orders/agent-order/delOrder/'.$ord->order_id.'" class="text-inverse p-r-10" onClick="return confirm("Are you sure want to cancel this order")"><i class="fas fa-trash" style="color: black"></i></a>';
				
				if($ord->order_status == "Pending"){
				
					$status = '<label class="badge badge-success">Success</label>';
				
				}elseif($ord->order_status == "Cancelled"){
					
					$status = '<label class="badge badge-danger">Cancelled</label>';
					
				}
				$tbody[] = array(
								++$id,
								$status,
								date('d-m-Y',strtotime($ord->delivery_date)),
								$ord->order_delivery_time,
		 						$ti['code'],
								$ti['city'],
								$ti['name'],
								$bda['code'],
								$bda['city'],
								$bda['name'],
								$agt['code'],
								$agt['city'],
								$agt['name'],
								$route,
								implode(", <br>",$pcode),
								implode(", <br>",$pname),
								implode(", <br>",$qty),
								implode(", <br>",$uom),
								$actions
							);
				
			}
			
			
		}elseif($role == 12){
			
			$tbody = [];
			
			$id = 0;
			foreach($orders as $ord){
				
				$agt = $this->getAgtdetails($ord->agent_id);
				$bda = $this->getBdadetails($ord->agent_id);
				
				$products = json_decode($ord->product_id);	    	
				
				$pname = array();
				$qty = array();
				$uom = array();
				$pcode = array();
				foreach($products as $p){

					$pname[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_name; 
					$pcode[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_id; 
					$qty[] = $p->productQty;
					$uom[] = $p->qtyType;	
				}
				
				$route = "";
				if($ord->order_delivery_time == "morning"){
			    
    			    $route = $agt['mroute'];
    			    
				}elseif($ord->order_delivery_time == "evening"){
    			    
    			    $route = $agt['eroute'];
    			    
    			}
				
				$actions = "";
				$status = "";
				
				$actions = '<a href="'.base_url().'orders/agent-order/updateOrder/'.$ord->order_id.'" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a><a href="'.base_url().'orders/agent-order/delOrder/'.$ord->order_id.'" class="text-inverse p-r-10" onClick="return confirm("Are you sure want to cancel this order")"><i class="fas fa-trash" style="color: black"></i></a>';
				
				if($ord->order_status == "Pending"){
				
					$status = '<label class="badge badge-success">Success</label>';
				
				}elseif($ord->order_status == "Cancelled"){
					
					$status = '<label class="badge badge-danger">Cancelled</label>';
					
				}
				$tbody[] = array(
								++$id,
								$status,
								date('d-m-Y',strtotime($ord->delivery_date)),
								$ord->order_delivery_time,
								$bda['code'],
								$bda['city'],
								$bda['name'],
								$agt['code'],
								$agt['city'],
								$agt['name'],
								$route,
								implode(", <br>",$pcode),
								implode(", <br>",$pname),
								implode(", <br>",$qty),
								implode(", <br>",$uom),
								$actions
							);
				
			}
			
		}elseif($role == 7){
			
			$tbody = [];
			
			$id = 0;
			foreach($orders as $ord){
				
				$agt = $this->getAgtdetails($ord->agent_id);
				$products = json_decode($ord->product_id);	    	
				
				$pname = array();
				$qty = array();
				$uom = array();
				$pcode = array();
				foreach($products as $p){

					$pname[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_name; 
					$pcode[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_id; 
					$qty[] = $p->productQty;
					$uom[] = $p->qtyType;	
				}
				
				$route = "";
				if($ord->order_delivery_time == "morning"){
			    
    			    $route = $agt['mroute'];
    			    
				}elseif($ord->order_delivery_time == "evening"){
    			    
    			    $route = $agt['eroute'];
    			    
    			}
				
				$actions = "";
				$status = "";
				
				$actions = '<a href="'.base_url().'orders/agent-order/updateOrder/'.$ord->order_id.'" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a><a href="'.base_url().'orders/agent-order/delOrder/'.$ord->order_id.'" class="text-inverse p-r-10" onClick="return confirm("Are you sure want to cancel this order")"><i class="fas fa-trash" style="color: black"></i></a>';
				
				if($ord->order_status == "Pending"){
				
					$status = '<label class="badge badge-success">Success</label>';
				
				}elseif($ord->order_status == "Cancelled"){
					
					$status = '<label class="badge badge-danger">Cancelled</label>';
					
				}
				$tbody[] = array(
								++$id,
								$status,
								date('d-m-Y',strtotime($ord->delivery_date)),
								$ord->order_delivery_time,
								$agt['code'],
								$agt['city'],
								$agt['name'],
								$route,
								implode(", <br>",$pcode),
								implode(", <br>",$pname),
								implode(", <br>",$qty),
								implode(", <br>",$uom),
								$actions
							);				
			}
			
		}else{
			
			$tbody = [];
			
			$id = 0;
			foreach($orders as $ord){
				
				$agt = $this->getAgtdetails($ord->agent_id);
				$bda = $this->getBdadetails($ord->agent_id);
				$ti = $this->getTidetails($bda["bdaid"]);
				$am = $this->getAmdetails($bda["bdaid"],$ti['tid']);
				
				$products = json_decode($ord->product_id);	    	
				
				$pname = array();
				$qty = array();
				$uom = array();
				$pcode = array();
				
				foreach($products as $p){
					$pcode[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_id; 
					$pname[] = $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_name; 
					$qty[] = $p->productQty;
					$uom[] = $p->qtyType;	
				}
				
				$route = "";
				if($ord->order_delivery_time == "morning"){
			    
    			    $route = $agt['mroute'];
    			    
				}elseif($ord->order_delivery_time == "evening"){
    			    
    			    $route = $agt['eroute'];
    			    
    			}
				
				$actions = "";
				$status = "";
				
				$actions = '<a href="'.base_url().'orders/agent-order/updateOrder/'.$ord->order_id.'" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a><a href="'.base_url().'orders/agent-order/delOrder/'.$ord->order_id.'" class="text-inverse p-r-10" onClick="return confirm("Are you sure want to cancel this order")"><i class="fas fa-trash" style="color: black"></i></a>';
				
				if($ord->order_status == "Pending"){
				
					$status = '<label class="badge badge-success">Success</label>';
				
				}elseif($ord->order_status == "Cancelled"){
					
					$status = '<label class="badge badge-danger">Cancelled</label>';
					
				}
				$tbody[] = array(
								++$id,
								$status,
								$ord->order_id,
								$ord->created_date,
								date('d-m-Y',strtotime($ord->delivery_date)),
								$ord->order_delivery_time,
		 						$am['city'],
		 						$am['name'],
		 						$am['code'],
								$ti['city'],
								$ti['name'],
		 						$ti['code'],
								$bda['city'],
								$bda['name'],
								$bda['code'],
								$agt['city'],
								$agt['name'],
								$agt['code'],
								$route,
								implode(", <br>",$pname),
								implode(", <br>",$pcode),
								implode(", <br>",$qty),
								implode(", <br>",$uom),
								$actions
							);
				
			}
			
		}
		
		return $tbody;
		
		
	}
	
	
	public function getAgtdetails($aid){
		
		$agt = $this->db->get_where("fdm_va_auths",array("id"=>$aid,"deleted"=>0))->row();
		
		$data = array();
				
		$data["city"] = $this->db->get_where("tbl_locations",array("id"=>$agt->city))->row()->location;
		$data["name"] = $agt->name;	
		$data["code"] = $agt->agent_id;	
		$data["mroute"] = $agt->route;	
		$data["eroute"] = $agt->eroute;	
		
		return $data;
	}
	
	public function getBdadetails($aid){
		
		$bdas = $this->db->get_where("fdm_va_auths",array("role"=>7,"deleted"=>0))->result();
		
		$data = array();
		
		foreach($bdas as $bd){
			
			$agts = json_decode($bd->assigned_agents);
			
			if(in_array($aid,$agts->agents)){
				
				$data["city"] = $this->db->get_where("tbl_locations",array("id"=>$bd->city))->row()->location;
				$data["name"] = $bd->name;	
				$data["bdaid"] = $bd->id;	
				$data["code"] = $bd->agent_id;	
			}
			
		}
		
		return $data;
	}
	
	public function getTidetails($aid){
		
		$bdas = $this->db->get_where("fdm_va_auths",array("role"=>12,"deleted"=>0))->result();
		
		$data = array();
		
		foreach($bdas as $bd){
			
			$agts = json_decode($bd->assigned_agents);
			
			if(in_array($aid,$agts->salesemployees)){
				
				$data["city"] = $this->db->get_where("tbl_locations",array("id"=>$bd->city))->row()->location;
				$data["name"] = $bd->name;	
				$data["tid"] = $bd->id;	
				$data["code"] = $bd->agent_id;	
				
			}
			
		}
		
		return $data;
	}
	
	public function getAmdetails($bid,$tid){
		
		$bdas = $this->db->get_where("fdm_va_auths",array("role"=>11,"deleted"=>0))->result();
		
		$data = array();
		
		foreach($bdas as $bd){
			
			$agts = json_decode($bd->assigned_agents);
			
			if(in_array($bid,$agts->salesemployees) && in_array($tid,$agts->tincharge)){
				
				$data["city"] = $this->db->get_where("tbl_locations",array("id"=>$bd->city))->row()->location;
				$data["name"] = $bd->name;	
				$data["aid"] = $bd->id;	
				$data["code"] = $bd->agent_id;	
				
			}
			
		}
		
		return $data;
	}
	
}