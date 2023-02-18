<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Referals extends CI_Controller {
	
	public function __construct(){

		parent::__construct();

		$this->secure->loginCheck();

	}

	public function referalslist(){

		$this->load->view("referals/referalslist");

	}
	
	public function agentReports(){

		$this->load->view("referals/agentReports");

	}
	
	public function consumerReports(){

		$this->load->view("referals/consumerReports");

	}
	
	public function agentReportsquantities(){

		$this->load->view("referals/agentReportsquantities");

	}
	
	public function agentconsolidatedReports(){

		$this->load->view("referals/agentconsolidatedReports");

	}
	
	public function viewReferers($id,$type){

		if($type == "Customer"){
		
			$data["udata"] = $this->db->get_where("shreeja_users",["userid"=>$id])->row();
			
		}else{
		
			$data["udata"] = $this->db->get_where("fdm_va_auths",["id"=>$id])->row();
			
		}
		$data["type"] = $type;
		$this->load->view("referals/viewreferers",$data);

	}
	
	public function referrerOrders($rid,$id){

		$data["u"] = $this->db->get_where("shreeja_users",["userid"=>$rid])->row();
		$data["udata"] = $this->db->get_where("shreeja_users",["userid"=>$id])->row();
		$this->load->view("referals/referrerOrders",$data);

	}

	public function createReferals(){
		
		$this->load->view("referals/createReferals");
		
	}
	
	public function insertReferal(){
		
		$referer = $this->input->post("referer");
		$referee = $this->input->post("referee");
		
		$data = $this->admin->getReferrers($referer,$referee);
//		print_r($data);
//		exit();
		
		if($data["status"]){
			
			$this->alert->pnotify("success",$data["message"],"success");
			redirect("referals/createReferals");
			
		}else{
			
			$this->alert->pnotify("error",$data["message"],"error");
			redirect("referals/createReferals");
			
		}
		
	}
	
	public function getNumber($num){
		if($num == 0){
		 
		    return 0;
		    
		}elseif($num == 1){
			
			return "1st";
			
		}elseif($num == 2){
			
			return "2nd";
			
		}elseif($num == 3){
			
			return "3rd";
			
		}else{
			
			return $num."th";
			
		}
		
	}
	
// getAgentreferalreports
	
	
	public function getAgentreferalreports(){

		$data = $this->db->get_where("tbl_user_referrals",["referrer_type"=>"Agent"])->result();
		
		$sdate = date("Y-m-d",strtotime($this->input->post("sdate")));
		$edate = date("Y-m-d",strtotime($this->input->post("edate")));
//		$oddate = $this->input->post("oddate");
		$jsonData = array();

		$id = 1;
		foreach($data as $u){
			
			$rdata = $this->db->get_where("fdm_va_auths",["id"=>$u->referrer_id])->row();
			$role = $this->db->get_where("fdm_va_roles",["id"=>$rdata->role])->row()->role_name;
			
			$this->db->select("location,user_id,user_data,order_id,order_type,sdate,edate,date_of_order,renewal_status,is_renew,deliveryShift,date_of_order");
			$this->db->where(array("payment_status"=>"Success","user_id"=>$u->referee_id,"order_type"=>"subscribe","date_of_order >="=>$u->cdate));
			/*if($this->input->post("sdate")){
			
				$this->db->where("sdate between '$sdate' and '$edate'");
				
			}*/
			$orders = $this->db->get("orders")->result();
			
			$ocount = count($orders);
			
	        $rnum = 0;
			if(count($orders) > 0){
				
				foreach($orders as $k => $o){
					
					if($k != 0){
					    $rchk = $this->db->get_where("orders",["payment_status"=>"Success","date_of_order >="=>$u->cdate,"user_id"=>$o->user_id])->num_rows();
					}
			        $city = $this->db->select("location")->get_where("tbl_locations",["id"=>$o->location])->row()->location;
			
					$udata = json_decode($o->user_data);
					$opdata = $this->db->get_where("order_products",["order_id"=>$o->order_id,"delivery_date>="=>$u->cdate])->result();
					
					if($k != 0){
    					if($rchk > 1){
    
    						$rnum += 1;
    
    					}
    					
					}
					$cnum = $this->getNumber($rnum);
					
					if($this->input->post("sdate")){
			
						$this->db->where("delivery_date between '$sdate' and '$edate'");

					}
					$sdel = $this->db->select("delivery_date")->get_where("tbl_subscribed_deliveries",["pause_status"=>"Inactive","order_id"=>$o->order_id,"deliver_status !="=>"Cancelled"])->result();
					
					foreach($opdata as $op){
						
						$pdata = json_decode($op->product_data);
						$pqty = json_decode($pdata->product_quantity);
						
						foreach($pqty->quantity as $kk => $qq){
							
							if($qq == $op->category){
								
								$item_code = $pqty->sap[$kk];
								
							}
							
						}
						
						$nData1 = array();
						
						if($op->orderRef == "offer"){
								
							$nData1["sno"] = $id;
							$nData1["oddate"] = $sdel[0]->delivery_date;
							$nData1["city"] = $city;
							$nData1["orderid"] = $o->order_id;
							$nData1["shift"] = $o->deliveryShift;
							$nData1["odate"] = $o->date_of_order;
							$nData1["Name"] = $udata->user_name;
							$nData1["Number"] = $udata->user_mobile;
							$nData1["Item_Code"] =  $item_code;
							$nData1["Item_name"] = $pdata->product_name;
							$nData1["Quantity"] = $op->qty;
							$nData1["UOM"] =  "EA";
							$nData1["rDate"] =date("Y-m-d",strtotime($udata->user_created));
							$nData1["ssdate"] = $o->sdate;
							$nData1["sedate"] = $o->edate;
							$nData1["refname"] =$rdata->name;
							$nData1["refcode"] =$rdata->referral_id;
							$nData1["agentid"] =$rdata->agent_id;
							$nData1["refcat"] =$role;
							$nData1["refnumber"] =$rdata->mobile_number;
							$nData1["ordercat"] = ($cnum != 0) ? "Renewal" : "New Subscription";
							$nData1["renewalnumber"] =($cnum != 0) ? "$cnum renewal" : "";

							$jsonData[] = $nData1;
							$id++; 	
								
						}else{
						
							foreach($sdel as $sd){
							
								$nData1["sno"] = $id;
								$nData1["oddate"] = $sd->delivery_date;
								$nData1["city"] = $city;
								$nData1["orderid"] = $o->order_id;
								$nData1["shift"] = $o->deliveryShift;
								$nData1["odate"] = $o->date_of_order;
								$nData1["Name"] = $udata->user_name;
								$nData1["Number"] = $udata->user_mobile;
								$nData1["Item_Code"] =  $item_code;
								$nData1["Item_name"] = $pdata->product_name;
								$nData1["Quantity"] = $op->qty;
								$nData1["UOM"] =  "EA";
								$nData1["rDate"] =date("Y-m-d",strtotime($udata->user_created));
								$nData1["ssdate"] = $o->sdate;
								$nData1["sedate"] = $o->edate;
								$nData1["refname"] =$rdata->name;
								$nData1["refcode"] =$rdata->referral_id;
								$nData1["agentid"] =$rdata->agent_id;
								$nData1["refcat"] =$role;
								$nData1["refnumber"] =$rdata->mobile_number;
								$nData1["ordercat"] = ($cnum != 0) ? "Renewal" : "New Subscription";
								$nData1["renewalnumber"] =($cnum != 0) ? "$cnum renewal" : "";

								$jsonData[] = $nData1;
								$id++; 
							}
							
						}
					}
					
				}
				
			}
		 }
	
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);

	}			
	
// getAgentreferalreports	

	public function getAgentreferalquantityreports(){

		$data = $this->db->get_where("tbl_user_referrals",["referrer_type"=>"Agent"])->result();
		$jsonData = array();
		$sdate = date("Y-m-d",strtotime($this->input->post("sdate")));
		$edate = date("Y-m-d",strtotime($this->input->post("edate")));
		
		$id = 1;
		foreach($data as $u){
			
			$rdata = $this->db->get_where("fdm_va_auths",["id"=>$u->referrer_id])->row();
			
			$orders = $this->db->query("SELECT location, user_id, user_data, order_id, order_type, sdate, date_of_order,renewal_status, is_renew FROM orders WHERE sdate between '$sdate' and '$edate' AND payment_status = 'Success' AND user_id = '$u->referee_id' AND order_type = 'subscribe' AND date_of_order >= '$u->cdate'")->result();
			
			$ocount = count($orders);
			
	
			if(count($orders) > 0){
				
				foreach($orders as $o){
			
					$opdata = $this->db->get_where("order_products",["order_id"=>$o->order_id])->result();
					
					$rnum = 0;
						
					if($o->is_renew == "Active"){

						$rnum += 1;

					}
					
					foreach($opdata as $op){
						
						$pdata = json_decode($op->product_data);
						$pqty = json_decode($pdata->product_quantity);
						
						$nData1 = array();
						$nData1["sno"] = $id;
						$nData1["city"] =$this->db->select("location")->get_where("tbl_locations",["id"=>$o->location])->row()->location;
						$nData1["agentid"] =$rdata->agent_id;
						$nData1["agentname"] =$rdata->name;
						$nData1["refcode"] =$rdata->referral_id;
						$nData1["Item_name"] = $pdata->product_name;
						$nData1["Quantity"] = $op->qty;
						$nData1["UOM"] =  "EA";
						$nData1["order_type"] =($rnum > 0) ? "$rnum renewal" : "New Subscription";

						$jsonData[] = $nData1;

						$id++; 
					}
					
				}
				
			}
		 }
	
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);

	}			
	
// customer reports
	
	public function getCustomerreferalreports(){

		$data = $this->db->get_where("tbl_user_referrals",["referrer_type"=>"Customer"])->result();
		$jsonData = array();
		
		$sdate = date("Y-m-d",strtotime($this->input->post("sdate")));
		$edate = date("Y-m-d",strtotime($this->input->post("edate")));

		$id = 1;
		foreach($data as $u){
			
			if($u->referrer_type == "Customer"){
			
				$rdata = $this->db->get_where("shreeja_users",["userid"=>$u->referrer_id])->row();
			
			}else{
				
				$rdata = $this->db->get_where("fdm_va_auths",["id"=>$u->referrer_id])->row();
				
			}
				
			$orders = $this->db->query("SELECT location, user_id, user_data, order_id, order_type, sdate, edate, date_of_order,renewal_status,deliveryShift, is_renew FROM orders WHERE edate between '$sdate' and '$edate' AND payment_status = 'Success' AND user_id = '$u->referee_id' AND order_type = 'subscribe' AND date_of_order >= '$u->cdate'")->result();
			
			$ocount = count($orders);
			
	        $rnum = 0;
			if(count($orders) > 0){
				
				foreach($orders as $k => $o){
					if($k != 0){
					    $rchk = $this->db->get_where("orders",["payment_status"=>"Success","date_of_order >="=>$u->cdate,"user_id"=>$o->user_id])->num_rows();
					}
			
					$udata = json_decode($o->user_data);
					$opdata = $this->db->get_where("order_products",["order_id"=>$o->order_id,"delivery_date>="=>$u->cdate])->result();
						
					if($k != 0){
    					if($rchk > 1){
    
    						$rnum += 1;
    
    					}
    					
					}
					$cnum = $this->getNumber($rnum);
					
					foreach($opdata as $op){
						
						$pdata = json_decode($op->product_data);
						$pqty = json_decode($pdata->product_quantity);
						
						foreach($pqty->quantity as $kk => $qq){
							
							if($qq == $op->category){
								
								$item_code = $pqty->sap[$kk];
								
							}
							
						}
						
						$nData1 = array();
						$nData1["sno"] = $id;
						$nData1["city"] = $this->db->select("location")->get_where("tbl_locations",["id"=>$o->location])->row()->location;
						$nData1["odate"] = $o->date_of_order;
						$nData1["orderid"] = $o->order_id;
						$nData1["shift"] = $o->deliveryShift;
						$nData1["cust_name"] = $udata->user_name;
						$nData1["cust_number"] = $udata->user_mobile;
//						$nData1["reg_date"] = date("Y-m-d",strtotime($udata->user_created));
						$nData1["sstdate"] = $o->sdate;
						$nData1["ssdate"] = $o->edate;
						$nData1["ref_name"] =($u->referrer_type == "Customer") ? $rdata->user_name : $rdata->name;
						$nData1["ref_code"] =$rdata->referral_id;
						$nData1["ref_cat"] =$u->referrer_type;
						$nData1["ref_number"] =($u->referrer_type == "Customer") ? $rdata->user_mobile : $rdata->mobile_number;
						$nData1["sap_code"] =  $item_code;
						$nData1["item_name"] = $pdata->product_name;
						$nData1["qty"] = $op->qty;
						$nData1["ordercat"] = ($cnum != 0) ? "Renewal" : "New Subscription";
						$nData1["renewalnumber"] =($cnum != 0) ? "$cnum renewal" : "";
						$nData1["uom"] =  "EA";

						$jsonData[] = $nData1;

						$id++; 
					}
					
				}
				
			}
		 }
	
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);

	}			

// agentconsolidatedReports reports
	
	public function agentfilterconsolidatedReports(){
		
		$data = $this->db->group_by("referrer_id")->get_where("tbl_user_referrals",["referrer_type"=>"Agent"])->result();
		
		$sdate = $this->input->post("sdate");
		$edate = $this->input->post("edate");
		$jsonData = array();

		$id = 1;
		
		$orders = [];
		foreach($data as $u){
			
			$refdata = $this->db->get_where("tbl_user_referrals",["referrer_type"=>"Agent","referrer_id"=>$u->referrer_id])->result();
			
			foreach($refdata as $ru){
			
				$orders[] = $this->getfiltered_success_orders($ru->referee_id,$ru->cdate,$u->referrer_id,$sdate,$edate);
				
			}
		 }
		
		$oresult = array();
		foreach($orders as $k => $v) {
			
			foreach($v as $kk => $vv){
				$id = $kk;
				$oresult[$id][] = $vv;
			}
				
		}
		
		$i = 1;
		foreach($oresult as $ok => $or){
			
//			$item_code = "";
			$pk = explode("-",$ok);
			
			$rdata = $this->db->get_where("fdm_va_auths",["id"=>$pk[1]])->row();
			$pdata = $this->db->get_where("tbl_products",["id"=>$pk[0]])->row();
			
			$pqty = json_decode($pdata->product_quantity);

			foreach($pqty->quantity as $kk => $qq){

				if($qq == $pk[2]){

					$item_code = $pqty->sap[$kk];

				}

			}
			
		
			$tqty = 0;
			foreach($or as $to){
				
				$et = explode("-",$to);
				$tqty += $et[0] * $et[1];
				
			}
			
			if($tqty > 0){
			
				$nData1 = array();
				$nData1["sno"] = $i;
				$nData1["city"] = $this->db->select("location")->get_where("tbl_locations",["id"=>$rdata->city])->row()->location;
				$nData1["ref_name"] =$rdata->name;
				$nData1["ref_code"] =$rdata->referral_id;
				$nData1["ref_cat"] = $this->db->select("role_name")->get_where("fdm_va_roles",["id"=>$rdata->role])->row()->role_name;;
				$nData1["ref_number"] =$rdata->mobile_number;
				$nData1["sap_code"] =  $item_code;
				$nData1["item_name"] = $pdata->product_name;
				$nData1["qty"] = $tqty;
				$nData1["uom"] =  "EA";

				$jsonData[] = $nData1;

				$i++;
				
			}
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);

	}		
	

	public function getfiltered_success_orders($referee_id,$cdate,$referer_id,$stdate,$endate){
		
		$sdate = date("Y-m-d",strtotime($stdate));
		$edate = date("Y-m-d",strtotime($endate));
		
		if($stdate){
			
			$dfilter = "and sdate between '$sdate' and '$edate'";
			
		}else{
			
			$dfilter = "";
			
		}
		
		$orders = $this->db->query("SELECT location, user_id, user_data, order_id, order_type, sdate, edate, date_of_order,renewal_status, is_renew FROM orders WHERE payment_status = 'Success' AND user_id = '$referee_id' $dfilter AND order_type = 'subscribe' AND date_of_order >= '$cdate'")->result();

		$pqty = [];
		$fqty = [];
		
		foreach($orders as $o){
			
			$oop = $this->db->select("product_id,qty,category")->get_where("order_products",array("order_id"=>$o->order_id))->result();
			
			$this->db->where(["order_id"=>$o->order_id,"pause_status"=>"Inactive","delivery_date <="=>date("Y-m-d")]);
			
			if($stdate){
				
				$this->db->where("delivery_date between '$sdate' and '$edate'");
				
			}
			$sd = $this->db->get("tbl_subscribed_deliveries")->num_rows();
			
			foreach($oop as $op){
								
				if(in_array($op->product_id."-".$referer_id."-".$op->category,$pqty)){
					
					$fqty[$op->product_id."-".$referer_id."-".$op->category] = $fqty[$op->product_id]+$op->qty."-".$sd;
					
				}else{
					
					$fqty[$op->product_id."-".$referer_id."-".$op->category] = $op->qty."-".$sd;
					
				}
				
					
				$pqty[] = $op->product_id."-".$referer_id."-".$op->category;
	
			}


		}

		return $fqty;
	}
	
	


}