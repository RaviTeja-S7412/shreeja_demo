<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agentdeliverableqty extends CI_Controller {
	
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
	
}
	
// Deliverable quantity
	
	public function index()
	{
		$aid = $this->session->userdata("admin_id");
		$aagt = json_decode($this->admin->get_admin("assigned_agents",$aid));
		
		$this->load->view('orders/agentOrders/deliverableQuantity');
	}
	
	public function getOrders($role,$aid,$date="",$sh="",$ti="",$bda="",$agt="",$city="",$am=""){
	
	//	$role = $this->admin->get_admin("role");
	
	    if($date != ""){
	        
	        $ddate = date("Y-m-d",strtotime($date));
	        
	    }

		$shift = ($sh);

        if($role == 1 || $role == 10){
            $aagt = $this->db->select("id")->where_in("role",[2,3,4,5,13])->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();
        }else{
		    $aagt = json_decode($this->admin->get_admin("assigned_agents",$aid));
        }
        
		if($role == 7){

			if($date != ""){
			    
				$this->db->order_by("id","desc");

				if($shift){

					$this->db->where("order_delivery_time",$shift);

				}else{

					$this->db->where_in("order_delivery_time",["evening","morning"]);	

				}
				
				if($agt!=""){
					
					$sAgts = explode(",",$agt);
					
				}else{
					
					$sAgts = $aagt->agents;
					
				}
                
                if($city != ""){
					
					$this->db->where("city",$city);
				}
				$data["orders"] = $this->db->select("product_id,order_id,deleted")->where_in("agent_id",$sAgts)->get_where("agent_orders",array("delivery_date"=>$ddate,"deleted"=>0))->result_array();

			}else{

				$data["orders"] = $this->db->select("product_id,order_id,deleted")->order_by("id","desc")->where_in("agent_id",$aagt->agents)->get_where("agent_orders",["deleted"=>0])->result_array();
			}

		}elseif($role == 11 || $role == 12 || $role == 1 || $role == 10){

			if($agt != ""){
				
				$arr = explode(",",$agt);
			
			}elseif($bda!=""){
			
				$sEmp = explode(",",$bda);
			
			}elseif($ti != ""){
			
				$sEmp = json_decode($this->admin->get_admin("assigned_agents",$ti))->salesemployees;
			
			}elseif($am != ""){
			
				$tids = json_decode($this->admin->get_admin("assigned_agents",$am))->tincharge;
				
				$tots = [];
				foreach($tids as $tid){
					
					$tots[] = json_decode($this->db->get_where("fdm_va_auths",["id"=>$tid,"role"=>12])->row()->assigned_agents)->salesemployees;
					
				}
				
				if(count($tots) > 1){

                    $ftot = [];
					for($i = 0; $i < count($tots); $i++){

						$ftot = array_merge($ftot,$tots[$i]);

					}
				}else{

					$ftot = $tots[0];

				}
			
				$sEmp = $ftot;
				
			}else{
				
				$sEmp = $aagt->salesemployees;
				
			}
			
			if($agt == ""){
			    
			    if(($role == 1 || $role == 10) && ($am == "") && ($bda == "") && ($ti == "")){
			        
			        $arr = [];
			        foreach($aagt as $aggttt){
			            $arr[] = $aggttt->id;
			        }
			        
			    }else{
			    
    				$bdas = $this->db->select("assigned_agents")->where_in("id",$sEmp)->get_where("fdm_va_auths",array("deleted"=>0))->result();
    
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
			    }

			}
			
			if($date != ""){

				$this->db->order_by("id","desc");

				if($shift){

					$this->db->where("order_delivery_time",$shift);

				}else{

					$this->db->where_in("order_delivery_time",["evening","morning"]);	

				}

                if($city != ""){
					
					$this->db->where("city",$city);
				}
				
				if(count($arr) > 0){
				    
				    $this->db->where_in("agent_id",array_unique($arr));
				    
				}
				
				$data["orders"] = $this->db->select("product_id,order_id,deleted")->get_where("agent_orders",["delivery_date"=>"$ddate","deleted"=>0])->result_array();

			}else{

				$data["orders"] = $this->db->select("product_id,order_id,deleted")->order_by("id","desc")->where_in("agent_id",array_unique($arr))->get_where("agent_orders",["deleted"=>0])->result_array();

			}
		}elseif($role == 2 || $role == 3 || $role == 4 || $role == 5 || $role == 13){

			if($date != ""){
			    
			    if($shift){

				    $shdata = "and order_delivery_time='".$shift."'";

				}else{
				    
				    $shdata = "";
				    
				}

				$data["orders"] = $this->db->query("select product_id,order_id,deleted from agent_orders where agent_id=$aid and delivery_date='$ddate' and deleted=0 $shdata order by id desc")->result_array();

			}else{

				$data["orders"] = $this->db->query("select product_id,order_id,deleted from agent_orders where agent_id=$aid and deleted=0 order by id desc")->result_array();

			}
		}else{

			if($date != ""){
			    
			    if($shift){

				    $shdata = "and order_delivery_time='".$shift."'";

				}else{
				    
				    $shdata = "";
				    
				}
				
				if($city){

				    $cdata = "and city='".$city."'";

				}else{
				    
				    $cdata = "";
				    
				}

				$data["orders"] = $this->db->query("select product_id,order_id,deleted from agent_orders where delivery_date='$ddate' and deleted=0 $shdata $cdata order by id desc")->result_array();

			}else{

				$data["orders"] = $this->db->query("select product_id,order_id,deleted from agent_orders where deleted=0 order by id desc")->result_array();

			}
		}

		return $data["orders"];

	}	

	
	public function allProductquantity(){
	
		$aid = $this->session->userdata("admin_id");
        $role = $this->admin->get_admin("role");
		$date = ($this->input->post("sdate") != "") ? date("Y-m-d",strtotime($this->input->post("sdate"))) : '';
        $shift = $this->input->post("shift");
        $city = $this->input->post("city");
        $am = $this->input->post("am");
        $ti = $this->input->post("ti");
        $bda = $this->input->post("bda");
        $agent = $this->input->post("agent");
		
		 $i = 0;	
		 $ci = 0;
		 $data = [];
		
		 $categories = $this->db->get_where("tbl_categories")->result(); 
		
		 foreach($categories as $c){
			 $products = $this->db->select("product_quantity,product_id,id,product_name")->group_by("product_id")->where(array("assigned_to"=>"agents","product_category"=>$c->id))->get("tbl_products")->result_array();
		 		
			 $cqty = [];
			 foreach($products as $row1){

				$product_quantity = json_decode($row1['product_quantity']);

				foreach ($product_quantity->quantity as $key => $value) {

					$packets = $this->get_success_orders($row1['product_id'],$value,$aid,$role,$date,$shift,$ti,$bda,$agent,$city,$am,$row1['id']);

					if($packets["total"] != "0 "){

						$cqty[] = round($packets["total"],2);
						
//						$new['sno'] = $i+1;
						$new['pcode'] = $row1['product_id'];
						$new['pname'] = $row1['product_name'];
						$new['packets'] = round($packets["total"],2);
						$new['uom'] = $packets["qty"];
						$data[$i] = $new;
						$i++;

					}

				//  	echo json_encode($packets);
				}
			}
			 
				if(round(array_sum($cqty),2) > 0){
	//				$new['sno'] = '<p class="category">'.($i+1).'</p>';
					$new['pcode'] = '<p class="category"></p>';
					$new['pname'] = '<strong style="font-weight: 600;font-size: 16px;">'.$c->category_name.'</strong>';
					$new['packets'] = '<strong style="font-weight: 600;font-size: 16px;">'.round(array_sum($cqty),2).'</strong>';
					$new['uom'] = '<strong style="font-weight: 600;font-size: 16px;">'.$packets["qty"].'</strong>';
					$data[$i] = $new; 
					$i++; 
				}
			 
		 }
		
			$results = ["sEcho" => 1,"iTotalRecords" => count($data),"iTotalDisplayRecords" => count($data),"aaData" => $data ];
			echo json_encode($results);	

		}	

	public function get_success_orders($pid,$cat,$aid,$role,$date,$shift,$ti,$bda,$agent,$city,$am,$pr_id){

			$orders = $this->getOrders($role,$aid,$date,$shift,$ti,$bda,$agent,$city,$am);
		  //  return $orders;
			$pqty = [];
			foreach($orders as $o){
				
				if($o['deleted']==0){

					$opdata = json_decode($o["product_id"]);

					foreach($opdata as $op){
						
				// 		if($op->pid){
							
							$product_id = $op->pid;
							$pid = $pid;
							
				// 		}else{
							
				// 			$product_id = $op->productId;
				// 			$pid = $pr_id;
							
				// 		}

						if($product_id==$pid && $op->category==$cat && $o['order_id']){

							$str = $op->category;

							$qtyMea = preg_replace('!\d+!', '', $str);

							$qM = str_replace(" ","",$qtyMea);

							$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

							if($op->qtyType == "ea" || $op->qtyType == "EA"){

								$eTot = $int * $op->productQty;

								if($qM == "gm" || $qM == "GM"){

									if($eTot >= 1000){

										$total = round(str_replace(",",".",number_format($int * $op->productQty)),2);

										$pqty[] = array("total"=>$total,"type"=>"KG");

									}else{

										$pqty[] = array("total"=>$eTot,"type"=>"gm");

									}


								}elseif($qM == "ML" || $qM == "ml"){

									if($eTot >= 1000){

										$total = round(str_replace(",",".",number_format($int * $op->productQty)),2);

										$pqty[] = array("total"=>$total,"type"=>"L");

									}else{

										$pqty[] = array("total"=>$eTot,"type"=>"ML");

									}

								}else{


									$pqty[] = array("total"=>$eTot,"type"=>$qM);


								}

							}else{

								$pqty[] = array("total"=>$op->productQty,"type"=>$op->qtyType);

							}

						}
				}
			}
			}
			
			$grandTotal = [];
			$grandQty = [];
			
			foreach($pqty as $pt){
				
				if($pt['type'] == "ML" || $pt['type'] == "gm"){
					
					$grandQty[] = ($pt['type'] == "ML") ? "L" : "KG";
					$grandTotal[] = $pt['total']/1000;
					
				}else{
					
					$grandQty[] = $pt['type'];
					$grandTotal[] = $pt['total'];
					
				}
				
			}
			
			return array("total"=>array_sum($grandTotal),"qty"=>implode("",array_unique($grandQty)));
// 			return array("total"=>($pqty),"qty"=>implode("",array_unique($grandQty)));
//				return ($orders);
		}
		
	
	
}