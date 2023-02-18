<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Indentorders extends CI_Controller {
	
	public function __construct(){

		parent::__construct();


	}
	
	public function getOrders($role,$aid,$date="",$sh="",$ti="",$bda="",$agt="",$am="",$city=""){
	
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

				$data["orders"] = $this->db->where_in("agent_id",$sAgts)->get_where("agent_orders",array("delivery_date"=>$ddate))->result_array();

			}else{

				$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",$aagt->agents)->get_where("agent_orders")->result_array();
			}

		}elseif($role == 11 || $role == 12 || $role == 10){

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

				$data["orders"] = $this->db->where_in("agent_id",array_unique($arr))->get_where("agent_orders",array("delivery_date"=>$ddate))->result_array();

			}else{

				$data["orders"] = $this->db->order_by("id","desc")->where_in("agent_id",array_unique($arr))->get_where("agent_orders")->result_array();

			}
		}elseif($role == 2 || $role == 3 || $role == 4 || $role == 5 || $role == 13){

			if($date != ""){
			    
			    if($shift){

				    $shdata = "and order_delivery_time='".$shift."'";

				}else{
				    
				    $shdata = "";
				    
				}

				$data["orders"] = $this->db->query("select * from agent_orders where agent_id=$aid and delivery_date='$ddate' $shdata order by id desc")->result_array();

			}else{

				$data["orders"] = $this->db->query("select * from agent_orders where agent_id=$aid order by id desc")->result_array();

			}
		}else{

			if($date != ""){
			    
			    if($shift){

				    $shdata = "and order_delivery_time='".$shift."'";

				}else{
				    
				    $shdata = "";
				    
				}

				$data["orders"] = $this->db->query("select * from agent_orders where delivery_date='$ddate' $shdata order by id desc")->result_array();

			}else{

				$data["orders"] = $this->db->query("select * from agent_orders order by id desc")->result_array();

			}
		}

		return $data["orders"];

	}	

    public function indentbyorderid($products){
        $pdata = [];
         $i = 0;
        foreach(json_decode($products) as $row2){
                  $pdetails = $this->db->where(array("id"=>$row2->productId,"assigned_to"=>'agents'))->get("tbl_products")->row_array();
                  $new['id'] = $row2->productId;
                  $new['product_name'] = $pdetails['product_name'];
                  $new['product_image'] = $pdetails['product_image'];
                   $new['category'] = $row2->category;
                   $new['productQty'] = $row2->productQty;
                   $new['qty_type'] = $row2->qtyType;
                   $new['qtyType'] = json_decode($pdetails['qty_type'],true);
                $pdata[$i] = $new;
                $i++;    
              }
              return $pdata;
              
    }
	
    public function my_indents(){
		
         $uid = $this->input->post("userid");
         $role = $this->input->post("role");
         $shift = $this->input->post("shift");
         
         $dd = $this->input->post("date");
         
         if($dd != ""){
            $date = date("Y-m-d",strtotime($dd));
         }else{
             $date = "";
         }
         $bulk = $this->getOrders($role,$uid,$date,$shift);
         
         
		 $shift = ['morning','evening'];
         $final = [];
         $j=0;
         if(count($bulk)>0){
         foreach($bulk as $row){
			 
              $products = $row['product_id'];
              $pdata = $this->indentbyorderid($products);
			  $adata = $this->agentorders_model->getAgtdetails($row["agent_id"]);
			 
              if($row['deleted']==1){
                  $row['order_state'] = "Cancelled";
              }else{
                  $row['order_state'] = "Active";
              }
              $row['products'] = $pdata;
              $row['agent_details'] = $adata;
              $row['transaction_documents'] = explode(",",$row['transaction_document']);
              $final[$j]=$row;
             $j++; 
         }
			 
         	echo json_encode(array("status"=>true, "orders"=>$final,"batch"=>$shift));
			 
         }else{
    	    echo json_encode(array("status"=>false, 'message'=>'No order data'));
    	}
         
    }

    public function indent_order(){
		
      $aid = $this->input->post("aid");
      $uid = $this->input->post("userid");
      $products = json_decode($this->input->post("products"),true);
      $ddate = date("Y-m-d",strtotime($this->input->post("deliverydate")));
      $dtime = $this->input->post("deliverytime");
      $tid = $this->input->post("transactionid");
	  $tamount = $this->input->post("transactionamount");
	  $bname = $this->input->post("bankName");
	  $tdate = $this->input->post("transactiondate");
	  $timage = $this->input->post("files");
	  $oid = $this->admin->generateagentOrderId();
      //return $this->input->post();
		
	  $udata = $this->db->get_where("fdm_va_auths",["id"=>$aid])->row();	
		
		$tincharge = $this->input->post("tincharge",true);
		$salesemployees = $this->input->post("salesemployees",true);


		if($tincharge){

		  $assigned_from = array("ti"=>$tincharge,"bda"=>$salesemployees);

		}elseif($salesemployees){

		  $assigned_from = array("bda"=>$salesemployees);

		}else{

		  $assigned_from = [];

		}

		
		$paySlip = [];
         if($_FILES["files"]["name"] != ''){	
            	$config["upload_path"] = 'uploads/agentPayments/';
                $config["allowed_types"] = '*';
            //	$config["encrypt_name"] = TRUE;   
               	$this->load->library('upload', $config);
            	$this->upload->initialize($config);
               
            	for($count = 0; $count<count($_FILES["files"]["name"]); $count++){
            	    
            	   // echo $_FILES["files"]["name"][$count];
            	
            		$_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
            		$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
            		$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
            		$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
            		$_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
            		if($this->upload->do_upload('file')){
            
            			$data1 = $this->upload->data();
            			$paySlip[] = "uploads/agentPayments/".$data1["file_name"];
            
            		}else{
            			$paySlip[] = "";
            			//echo $this->upload->display_errors();
            			
            		}
        	}
        	  
          }else{
                $paySlip[] = ""; 
          }
          $tdocument = implode(",",$paySlip);
		
		
		  $data2 = [];
		  foreach($products as $pr){
			  
			  $pdata = $this->db->get_where("tbl_products",["id"=>$pr["productId"]])->row();
			  $data2[] = array ('productId' => $pr["productId"], 'category' => $pr["category"], 'productQty' =>$pr["productQty"], 'qtyType' => $pr["qtyType"],"pid"=>$pdata->product_id,"product_data"=>json_encode($pdata));
			  
		  }
		
		
		
          $data = array(

				"order_id" => $oid,	
				"product_id" => json_encode($data2),
				"delivery_date" => ($ddate)?$ddate : "",
				"agent_id" => $aid,
				"order_delivery_time" => ($dtime)?$dtime :"",
				"amount" => ($tamount)?$tamount:"",
				"transaction_number" => $tid,
				"bank_name" => ($bname)?$bname:"",
				"transaction_document" => $tdocument,
				"transaction_date" => ($tdate)?$tdate:"",
				"created_by" => $uid,
				"assigned_from" => json_encode($assigned_from),
			  	"city" => $udata->city,

			);
			
// 			echo count($_FILES["files"]["name"]);
// 			echo json_encode($paySlip);
// 			exit;
			
			$u = $this->db->insert("agent_orders",$data);

			if($u){
			    echo json_encode(array("status"=>true, "message"=>"Indent created successfully"));

			}else{
			    echo json_encode(array("status"=>false, "message"=>"Indent not created, please try again"));		
			}
	
      
    }
	
	public function indent_update(){
			 
	  $aid = $this->input->post("aid");
      $uid = $this->input->post("userid");
      $products = json_decode($this->input->post("products"),true);
      $ddate = date("Y-m-d",strtotime($this->input->post("deliverydate")));
      $dtime = $this->input->post("deliverytime");
      $tid = $this->input->post("transactionid");
	  $tamount = $this->input->post("transactionamount");
	  $bname = $this->input->post("bankName");
	  $tdate = $this->input->post("transactiondate");
	  $oid = $this->input->post("orderid");
		
	  $udata = $this->db->get_where("fdm_va_auths",["id"=>$aid])->row();	
		
      //return $this->input->post();
		
		/*$tincharge = $this->input->post("tincharge",true);
		$salesemployees = $this->input->post("salesemployees",true);

		if($tincharge){

		  $assigned_from = array("ti"=>$tincharge,"bda"=>$salesemployees);

		}elseif($salesemployees){

		  $assigned_from = array("bda"=>$salesemployees);

		}else{


		  $assigned_from = [];

		}*/

      $check = $this->db->where(array("order_id"=>$oid))->get("agent_orders");
      if($check->num_rows() ==0){
          return array("status"=>false,"message"=>"indent not found");
      }
      $odata = $check->row();
      
         if($_FILES["files"]["name"][0] != "")
              {	
            	$config["upload_path"] = 'uploads/agentPayments/';
                $config["allowed_types"] = '*';
            //	$config["encrypt_name"] = TRUE;   
               	$this->load->library('upload', $config);
            	$this->upload->initialize($config);
               
               $ppaySlip = [];
               
            	for($count = 0; $count<count($_FILES["files"]["name"]); $count++){
            	
            		$_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
            		$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
            		$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
            		$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
            		$_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
            		if($this->upload->do_upload('file')){
            
            			$data1 = $this->upload->data();
            			$ppaySlip[] = "uploads/agentPayments/".$data1["file_name"];
            
            		}
        		}
				  
			$expaySlip = explode(",",$odata->transaction_document); 
			$paySlip = array_merge($expaySlip,$ppaySlip); 
			
          }else{
              
              $expaySlip = explode(",",$odata->transaction_document); 
              $paySlip = $expaySlip;  
              
          }
          
          $tdoc = implode(",",$paySlip);
		
		  $data2 = [];
		  foreach($products as $pr){
			  
			  $pdata = $this->db->get_where("tbl_products",["id"=>$pr["productId"]])->row();
			  $data2[] = array ('productId' => $pr["productId"], 'category' => $pr["category"], 'productQty' =>$pr["productQty"], 'qtyType' => $pr["qtyType"],"pid"=>$pdata->product_id,"product_data"=>json_encode($pdata));
			  
		  }
          
          $data = array(

				"product_id" => json_encode($data2),
				"delivery_date" => ($ddate)?$ddate : "",
				"agent_id" => $aid,
				"order_delivery_time" => ($dtime)?$dtime :"",
				"amount" => ($tamount)?$tamount:"",
				"transaction_number" => $tid,
				"bank_name" => ($bname)?$bname:"",
				"transaction_document" => $tdoc,
				"transaction_date" => ($tdate)?$tdate:"",
				"updated_by" => $uid,
			  	"city" => $udata->city,
				// "assigned_from" => json_encode($assigned_from),

			);
	
			$u = $this->db->where(array("order_id"=>$oid))->update("agent_orders",$data);

			if($u){
				
				$this->updatehistory_model->agentorderupdateHistory($odata,$oid,$uid,$aid);
				
			    echo json_encode(array("status"=>true, "message"=>"Indent updated successfully"));

			}else{
			    echo json_encode(array("status"=>false, "message"=>"Something went wrong."));		
			}
      
    }
    
    public function deleteIndent(){
        
        $index = $this->input->post("index");
		$tid = $this->input->post("order_id");
		
		$tdata = $this->db->get_where("agent_orders",array("order_id"=>$tid))->row();
		$documents = explode(",",$tdata->transaction_document);
		unset($documents[$index]);
		
		$udoc = implode(",",$documents);
		
		$d = $this->db->where("order_id",$tid)->update("agent_orders",["transaction_document"=>$udoc]);
		
		if($d){
			
			echo json_encode(array("status"=>true, "message"=>"Document Deleted successfully"));

		}else{
		    echo json_encode(array("status"=>false, "message"=>"Something went wrong."));		
		}
   
    
    }
	
	
	public function getcities(){
		
		$d=$this->db->get_where("tbl_locations",array("status"=>1,"deleted"=>0,"assign_to"=>"agents"))->result();
		
		if($d){
		
			echo json_encode(array("status"=>true,"cities"=>$d));
			
		}else{
			
			echo json_encode(array("status"=>false,"cities"=>"No records found"));
			
		}
		
		
    }
	

	public function getAreamanagers(){
		
		$cityid = $this->input->post("city_id");
		
		if($cityid){
			$this->db->where("city",$cityid);
		}
	  	$data=$this->db->get_where("fdm_va_auths",["role"=>11,"deleted"=>0,"status"=>"Active"])->result();
		
		if($data){
		
			echo json_encode(array("status"=>true,"am"=>$data));
			
		}else{
			
			echo json_encode(array("status"=>false,"am"=>"No records found"));
			
		}
		
		
    }
	
	public function getTeritaryincharge(){
		
		$id = $this->input->post("id");
		
		$ti = $this->db->select('assigned_agents')->get_where("fdm_va_auths",array("role"=>11,"id"=>$id))->row();
		
		if($ti){
			
			$this->db->where_in("id",json_decode($ti->assigned_agents)->tincharge);	
			$data = $this->db->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0,"role"=>12))->result();
			
			echo json_encode(array("status"=>true,"ti"=>$data));
			
		}else{
			
			echo json_encode(array("status"=>false,"ti"=>"No records found"));
			
		}
		
	}
	
	public function getSalesemp(){
		
		$id = $this->input->post("id");
		
		$ti = $this->db->select('assigned_agents')->get_where("fdm_va_auths",array("role"=>12,"id"=>$id))->row();
		
		if($ti){
			
			$this->db->where_in("id",json_decode($ti->assigned_agents)->salesemployees);	
			$data = $this->db->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0,"role"=>7))->result();
			
			echo json_encode(array("status"=>true,"semp"=>$data));
			
		}else{
			
			echo json_encode(array("status"=>false,"semp"=>"No records found"));
			
		}
		
	}
	
	public function getAgents(){
		
		$id = $this->input->post("id");
		
		$ti = $this->db->select('assigned_agents')->get_where("fdm_va_auths",array("role"=>7,"id"=>$id))->row();
		
		if($ti){
			
			$this->db->where_in("id",json_decode($ti->assigned_agents)->agents);	
			$data = $this->db->get_where("fdm_va_auths",array("status"=>"Active","deleted"=>0))->result();
			
			echo json_encode(array("status"=>true,"agents"=>$data));
			
		}else{
			
			echo json_encode(array("status"=>false,"agents"=>"No records found"));
			
		}
		
	}	
	
	
// deliverable quantity
	
		
	public function allProductquantity(){
	
		$aid = $this->input->post("userid");
        $role = $this->input->post("role");
		$date = $this->input->post("date");
        $shift = $this->input->post("shift");
        $am = $this->input->post("am");
        $ti = $this->input->post("ti");
        $bda = $this->input->post("bda");
        $agent = $this->input->post("agent");
        $city = $this->input->post("city");

		
		 $i = 0;
		 $data = [];
		
		 $categories = $this->db->get_where("tbl_categories")->result(); 
		
		 foreach($categories as $c){
			 $products = $this->db->select("product_quantity,product_id,id,product_name")->group_by("product_id")->where(array("assigned_to"=>"agents","product_category"=>$c->id))->get("tbl_products")->result_array();
		
			 $cqty = [];
		 	foreach($products as $row1){

				$product_quantity = json_decode($row1['product_quantity']);
			 

				foreach ($product_quantity->quantity as $key => $value) {

					$packets = $this->get_success_orders($row1['product_id'],$value,$aid,$role,$date,$shift,$ti,$bda,$agent,$am,$city,$row1['id']);

					if($packets != "0 "){

						$cqty[] = $packets;
						
						$new['sno'] = $i+1;
						$new['pname'] = $row1['product_name'];
						$new['category'] = "";
						$new['packets'] = $packets;
						$data[$i] = $new;
						$i++;
					
					}
					
//					echo json_encode($packets);
				}

			}
		    	if(round(array_sum($cqty),2) > 0){
					$new['sno'] = ($i+1);
					$new['pname'] = "";
					$new['category'] = $c->category_name;
					$new['packets'] = number_format(array_sum($cqty),2,'.', '');
					$data[$i] = $new; 
					$i++; 
				}
		 }
//			$data_final = $this->final_consolidate($data);

//			$results = ["sEcho" => 1,"iTotalRecords" => count($data_final),"iTotalDisplayRecords" => count($data_final),"aaData" => $data_final ];
//		
			echo json_encode($data);	

		//return array("status"=>true,"data"=>$data_final);
		}	

	public function get_success_orders($pid,$cat,$aid,$role,$date,$shift,$ti,$bda,$agent,$am,$city,$pr_id){

			$orders = $this->getOrders($role,$aid,$date,$shift,$ti,$bda,$agent,$am,$city);

			$pqty = [];
			foreach($orders as $o){

				if($o['deleted']==0){
					
				$opdata = json_decode($o["product_id"]);
				
				foreach($opdata as $op){
					
				// 	if($op->pid){
							
						$product_id = $op->pid;
						$pid = $pid;

				// 	}else{

				// 		$product_id = $op->productId;
				// 		$pid = $pr_id;

				// 	}

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
			

			return round(array_sum($grandTotal),2)." ".implode("",array_unique($grandQty));
//				return ($pqty);
		}
	
	public function depositOrders(){

		$aid = $this->input->post("userid");
        $role = $this->input->post("role");
		
		$orders = $this->getOrders($role,$aid);
		
		$fdata = [];
		
		foreach($orders as $o){
			
			$ndata = [];
			$ndata["order_id"] = $o["order_id"];
			$ndata["delivery_date"] = $o["delivery_date"];
			$ndata["agent_id"] = $this->db->get_where("fdm_va_auths",array("id"=>$o["agent_id"]))->row()->name;
			$ndata["amount"] = $o["amount"];
			$ndata["transaction_number"] = $o["transaction_number"];
			$ndata["bank_name"] = $o["bank_name"];
			$ndata["transaction_document"] = explode(",",$o["transaction_document"]);
			$ndata["transaction_date"] = $o["transaction_date"];
			$ndata["aid"] = $o["agent_id"];
			
			$fdata[] = $ndata;
 		}
		
		echo json_encode($fdata);

//		$this->load->view("orders/agentOrders/depositOrders",$data);

	}	


// sales head consumer deliverable quantity

public function salesheadcdeliverablequantity(){
	
$date = $this->input->post("date");
$shift = $this->input->post("shift");

 $products = $this->db->where_in("assigned_to",["consumers","freeProduct"])->get("tbl_products")->result_array();
 $i = 0;
 $data = [];
 foreach($products as $row1){

		$product_quantity = json_decode($row1['product_quantity']);
		$sap = $product_quantity->sap;

        foreach ($product_quantity->quantity as $key => $value) {
			
			$packets = $this->getfiltered_success_orders($date,$shift,$row1['id'],$value);
			
			if($packets != 0){
				
				$new['sno'] = $i+1;
				$new['product_id'] = $row1['id'];
				$new['pname'] = $row1['product_name']." ".$value;
				$new['sap_code'] = $sap[$key];
				$new['packets'] = $packets;
				$new['uom'] = "EA";
				$data[$i] = $new;
				$i++;
			}
    	}

			
	       	
	   }
	$data_final = $this->final_consolidate($data);
	
	
// 	$results = ["sEcho" => 1,"iTotalRecords" => count($data_final),"iTotalDisplayRecords" => count($data_final),"aaData" => $data_final ];
	echo json_encode(array("status"=>true,"data"=>$data_final));	

	

//return array("status"=>true,"data"=>$data_final);
}	

public function getfiltered_success_orders($date,$shift,$pid,$cat){
	$this->db->select('order_id,order_type,order_status,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","deliveryonce");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
	$this->db->where('deliveryonce_date', date("d-m-Y",strtotime($date)));
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$dorders = $this->db->get()->result();

// subscription orders
	
	$this->db->select('order_id,order_type,sub_start_date,order_status,deliveryonce_date');
	$this->db->from('orders');
	$this->db->where("payment_status","Success");
	$this->db->where("order_type","subscribe");
//	$this->db->where("deliveryonce_date BETWEEN '$sdate' AND '$edate'");
	
	$this->db->where("sdate <='".date("Y-m-d",strtotime($date))."' AND edate >= '".date("Y-m-d",strtotime($date))."'");
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$sorders = $this->db->get()->result();		
	
	$this->db->select('delivery_date');
	$this->db->from('tbl_free_sample_orders');
	$this->db->where("order_status","Success");
	$this->db->where("product_id",$pid);
	$this->db->where("qty",$cat);
	
	if($shift != ""){
		
		$this->db->where("deliveryShift",$shift);
		
	}
	
	$resutset1 = $this->db->get();
	
	$fsorders = $resutset1->result();		

	
	
//	$fsorders = $this->db->query("select * from tbl_free_sample_orders where order_status='Success' and product_id='$pid' and qty='$cat'")->result();
	
	$orders = array_merge($dorders,$sorders);
	
	$pqty = [];
	foreach($orders as $o){
		
//		echo $o->deliveryonce_date;
			
			if($o->order_type == "deliveryonce"){
				
				if($o->order_status == "Success"){
					
					if(strtotime($date) == strtotime($o->deliveryonce_date)){
						$opdata = $this->db->where(array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->get("order_products")->result();
						foreach($opdata as $op){

							$pqty[] = $op->qty;

						}

					}
				}
				
			}elseif($o->order_type == "subscribe"){
				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$o->order_id,"pause_status"=>"Inactive","deliver_status !="=>"Cancelled","delivery_date"=>date("Y-m-d",strtotime($date))))->row();
				
				$oop = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat,"orderRef"=>"offer"))->row();
					
				if(strtotime($date) == strtotime($o->sub_start_date) && $oop){
					$pqty[] = $oop->qty;
				}
				
				// foreach($sdata as $sd){
					
					if($sdata){
						
						$opdata1 = $this->db->get_where("order_products",array("order_id"=>$o->order_id,"product_id"=>$pid,"category"=>$cat))->row();
					
					
//						foreach($opdata1 as $op1){
							
							if($opdata1->orderRef != "offer"){
							
								$pqty[] = $opdata1->qty;
							
//							}
						}
						
					}
					
				// }
				//$pqty[] = $o;
				
			}
			
		}
	   
	    foreach($fsorders as $fs){
			
			if(strtotime($date) == strtotime($fs->delivery_date)){
			
				  $pqty[] = 1;

			}
			
		}
	    
		return array_sum($pqty);
}
	
	
	
	
public function final_consolidate($data){
	$i = 0;
	$array = [];
	foreach ($data as $row) {
		if($row['sap_code']!=""){
			$array[]=$row;
		}else{

		}
		//$i++;
	}
	return $array;
}	

public function insertFeedback(){

	$id = $this->input->post("id");
	$user_id = $this->input->post("user_id");
	$quality_rating = $this->input->post("quality_rating");
	$service_rating = $this->input->post("service_rating");
	$delivery_rating = $this->input->post("delivery_rating");
	$suggestions = $this->input->post("suggestions");
	
	$udata = $this->db->get_where("shreeja_users",["userid"=>$user_id])->row();
	
	$data = [
		"user_id" => $user_id,
		"user_data" => json_encode($udata),
		"quality_rating" => $quality_rating,
		"service_rating" => $service_rating,
		"delivery_rating" => $delivery_rating,
		"suggestions" => $suggestions,
		"cdate" => date("Y-m-d H:i:s")
	];
	
	if($id){
		
		$d = $this->db->where("id",$id)->update("tbl_feedback",$data);
		
	}else{
	
		$d = $this->db->insert("tbl_feedback",$data);
	
	}
		
	if($d){
		
		echo json_encode(["status"=>true,"msg"=>"Thank's you for giving your feedback."]);
		
	}else{
		
		echo json_encode(["status"=>false,"msg"=>"Error Occured."]);
		
	}
	
}
	
public function feedbackinfo(){
	
	$user_id = $this->input->post("user_id");
	$d = $this->db->where("user_id",$user_id)->get("tbl_feedback")->row();
	
	if($d){
		
		echo json_encode(["status"=>true,"feedbackinfo"=>$d]);
		
	}else{
		
		echo json_encode(["status"=>false,"feedbackinfo"=>"No data found"]);
		
	}
	
}	

}