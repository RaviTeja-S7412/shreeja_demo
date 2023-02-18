<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

public function __construct(){
			
	parent::__construct();
		
//	$this->secure->loginCheck();
}
	
	public function getSelectedcacities(){
		
		$id=$this->input->get("id",true);
		
		if($id == "freeProduct"){
			
			$val = "consumers";
			
		}else{
			
			$val = $id;
			
		}
		
		$d=$this->db->get_where("tbl_locations",array("status"=>1,"deleted"=>0,"assign_to"=>$val))->result();
	
		echo '<option value="">Select City</option>';
	
		foreach($d as $a){
			
			echo '<option value="'.$a->id.'">'.$a->location.'</option>';
		}
		
	}
	
  	public function getAreas(){
		
		$id=$this->input->get("id",true);
		
		$d=$this->db->get_where("tbl_areas",array("status"=>"Active","deleted"=>0,"city_id"=>$id))->result();
	
		echo '<option value="">Select Area</option>';
	
		foreach($d as $a){
			
			echo '<option value="'.$a->id.'">'.$a->area_name.'</option>';
		}
	}
	
	
	
	public function bindAgents(){
		
		$city=$this->input->get("city",true);
		$teritaryincharge = $this->admin->allunAssndti($city);
		$salesemp = $this->admin->allunAssndsemp($city);
		$agents = $this->admin->getAllunassdagents($city);
								
		$tis = "";
		foreach($teritaryincharge as $r){

			$tis .= '<option value="'.$r->id.'">'.$r->name.'</option>';
			
		}
		
		$semps = "";
		foreach($salesemp as $se){

			$semps .= '<option value="'.$se->id.'">'.$se->name.'</option>';
			
		}
		
		$agts = "";
		foreach($agents as $ag){

			$agts .= '<option value="'.$ag->id.'">'.$ag->name.'</option>';
			
		}
		
		echo json_encode(["agents"=>$agts,"semp"=>$semps,"tis"=>$tis]);

	}
	
  	public function getAssignedcities(){
		
		$id=$this->input->get("id",true);
		
		$d=$this->db->get_where("tbl_locations",array("status"=>1,"deleted"=>0,"assign_to"=>$id))->result();
	
		echo '<option value="">Select City</option>';
	
		foreach($d as $a){
			
			echo '<option value="'.$a->id.'">'.$a->location.'</option>';
		}
		
}	
	
  	public function getagentProductquantity(){
		
		$id=$this->input->get("id",true);
		
		$d=$this->db->get_where("tbl_products",array("deleted"=>0,"id"=>$id,"assigned_to"=>"agents"))->row();
		
		$qty = json_decode($d->product_quantity);
	
		echo '<option value="">Select Quantity</option>';
	
		foreach($qty->quantity as $q){
			
			echo '<option value="'.$q.'">'.$q.'</option>';
		}
		
}	
	
  	public function getCategoryprice(){
	
	$pid = $this->input->post("pid");
	$cid = $this->input->post("cid");
				
	$pdate = date("m/d/Y");
						
	$pcat = $this->db->get_where("tbl_products",array("id"=>$pid,"status"=>"Active","deleted"=>0,"assigned_to"=>"agents"))->row()->product_quantity;
	
	$pm = $this->db->query("select * from tbl_price_management where product_id = '$pid' AND  '$pdate' BETWEEN  startdate AND enddate")->row();

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
	
  	public function getAgents(){
		
		$id=$this->input->get("id",true);
	  
	    if(count($id) > 0){
		
			$data=$this->db->where_in("id",$id)->get("fdm_va_auths")->result();

			$ags = array();
			
			foreach($data as $d){

				$qty = json_decode($d->assigned_agents);
				
				
				foreach($qty->agents as $q){
					
					$ags[] = $q;
					
				}
				
				

			}
			
			foreach(array_unique($ags) as $qq){
				
					$udata = $this->db->get_where("fdm_va_auths",array("id"=>$qq))->row();
					$role = $this->db->get_where("fdm_va_roles",array("id"=>$udata->role))->row()->role_name;

					echo '<option value="'.$qq.'">'.$udata->name.' ('.$role.')'.'</option>';	
				
			}
			
		}
		
  }	

  	public function getSemployees(){
		
		$id=$this->input->get("id",true);
	  
	    if(count($id) > 0){
		
			$data=$this->admin->allunAssndsempajax($id);

			$ags = array();
			foreach($data as $d){

				$qty = json_decode($d->assigned_agents);
				foreach($qty->salesemployees as $q){
					
					$ags[] = $q;
					
				}

			}
			
//			echo '<option value="">Select Sales Employees</option>';
			
			foreach(array_unique($ags) as $qq){
				
					$udata = $this->db->get_where("fdm_va_auths",array("id"=>$qq))->row();

					echo '<option value="'.$qq.'">'.$udata->name.'</option>';
				
			}
		}
		
  }	
	
	
	 public function getfilterdqTincharge(){
		
		$id=$this->input->get("id",true);
	  
	    if(count($id) > 0){
		
			$data=$this->db->where("id",$id)->get("fdm_va_auths")->result();
			$ags = array();
			foreach($data as $d){

				$qty = json_decode($d->assigned_agents);
				foreach($qty->tincharge as $q){
					
					$ags[] = $q;
					
				}

			}
			
			echo '<option value="">Select TI</option>';
			
			foreach(array_unique($ags) as $qq){
				
					$udata = $this->db->get_where("fdm_va_auths",array("id"=>$qq))->row();

					echo '<option value="'.$qq.'">'.$udata->name.'</option>';
				
			}
		}
		
  	}
	
	
	public function getfilterams(){
		
		$id=$this->input->get("id",true);
	  	
		$data=$this->db->get_where("fdm_va_auths",["role"=>11,"city"=>$id,"status"=>"Active","deleted"=>0])->result();
			
		echo '<option value="">Select AM</option>';

		foreach($data as $qq){

				echo '<option value="'.$qq->id.'">'.$qq->name.'</option>';

		}
		
  	}

	
  	public function getfilterdqSemployees(){
		
		$id=$this->input->get("id",true);
	  
	    if(count($id) > 0){
		
			$data=$this->db->where("id",$id)->get("fdm_va_auths")->result();
			$ags = array();
			foreach($data as $d){

				$qty = json_decode($d->assigned_agents);
				foreach($qty->salesemployees as $q){
					
					$ags[] = $q;
					
				}

			}
			
			echo '<option value="">Select BDA</option>';
			
			foreach(array_unique($ags) as $qq){
				
					$udata = $this->db->get_where("fdm_va_auths",array("id"=>$qq))->row();

					echo '<option value="'.$qq.'">'.$udata->name.'</option>';
				
			}
		}
		
  }	
	
  	public function getfilterdqAgents(){
		
		$id=$this->input->get("id",true);
	  
	    
			$data=$this->db->where("id",$id)->get("fdm_va_auths")->result();

			$ags = array();
			
			foreach($data as $d){

				$qty = json_decode($d->assigned_agents);
				
				
				foreach($qty->agents as $q){
					
					$ags[] = $q;
					
				}
				
				

			}
			
			echo '<option value="">Select Agent</option>';
		
			foreach(array_unique($ags) as $qq){
				
					$udata = $this->db->get_where("fdm_va_auths",array("id"=>$qq))->row();
					$role = $this->db->get_where("fdm_va_roles",array("id"=>$udata->role))->row()->role_name;

					echo '<option value="'.$qq.'">'.$udata->name.' ('.$role.')'.'</option>';	
				
			}
		
		
  }	
	
	
	
// teritary incharge sales employess while create or edit area manager
	
	public function allcamtisemp(){
		
		$id = $this->input->post_get("id");
		$city = $this->input->post_get("city");
		
		$getallAm = $this->db->get_where("fdm_va_auths",array("role"=>11,"deleted"=>0,"city"=>$city))->result();
		
		
		$fasemp = [];
		foreach($getallAm as $ams){
			
			$asemp = json_decode($ams->assigned_agents)->salesemployees;
			
			foreach($asemp as $key => $ae){
				
				array_push($asemp[$key],$key);
				
			}
			
			$fasemp = array_merge($fasemp,$asemp);
			
			
		}
		
		$getAlltis = $this->db->where_in("id",$id)->get_where("fdm_va_auths",array("role"=>12,"deleted"=>0))->result();
		
		$retallsemp = [];
		foreach($getAlltis as $tams){
			
			$tibda = json_decode($tams->assigned_agents)->salesemployees;
			
			foreach($tibda as $tt){
				
				if(in_array($tt,$fasemp)){
					
				}else{
					
					$retallsemp[] = $tt;
					
				}
				
			}
			
		}
		
		foreach($retallsemp as $ff){
			
			$sd = $this->db->get_where("fdm_va_auths",array("id"=>$ff))->row();
			
			echo '<option value="'.$ff.'">'.$sd->name.'</option>';
			
		}
		
	}
	
	public function alluamtisemp(){
		
		$id = $this->input->post_get("id");
		$aid = $this->input->post_get("aid");
		$city = $this->input->post_get("city");
		
		$getallAm = $this->db->get_where("fdm_va_auths",array("role"=>11,"deleted"=>0,"city"=>$city))->result();
		
// assigned sales employees

		$fasemp = [];
		foreach($getallAm as $ams){
			
			$asemp = json_decode($ams->assigned_agents)->salesemployees;
			
			foreach($asemp as $key => $ae){
				
				array_push($asemp[$key],$key);
				
			}
			
			$fasemp = array_merge($fasemp,$asemp);
			
		}

// incoming area manager sales employees		
		
		$amSemp = $this->db->get_where("fdm_va_auths",array("role"=>11,"id"=>$aid,"deleted"=>0))->row();
		
		$aas = json_decode($amSemp->assigned_agents)->salesemployees;
		
// filter all unassigned sales employees
		
		$getAlltis = $this->db->select("assigned_agents")->where_in("id",$id)->get_where("fdm_va_auths",array("role"=>12,"deleted"=>0))->result();
		
		$retallsemp = [];
		foreach($getAlltis as $tams){
			
			$tibda = json_decode($tams->assigned_agents)->salesemployees;
		
			foreach($tibda as $tt){
				
				if(in_array($tt,$aas)){
					
					$retallsemp[] = $tt;
					
				}elseif(in_array($tt,$fasemp)){
				    
				}else{
					
					$retallsemp[] = $tt;
					
				}
				
			}
			
		}
		
		foreach($retallsemp as $ff){
			
			$sd = $this->db->get_where("fdm_va_auths",array("id"=>$ff))->row();
			
			echo '<option value="'.$ff.'">'.$sd->name.'</option>';
			
		}
		
	}
	
	
}