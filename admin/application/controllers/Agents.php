<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Agents extends CI_Controller {
	
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
	
}

public function createAgent(){

//	echo '<pre>';
//	print_r($this->admin->allunAssndsemp());
//	exit();
	
	$this->load->view("agents/createAgent");

}

public function index(){

	$data["agents"] = $this->db->query("select * from fdm_va_auths where deleted=0 order by id desc")->result();
	$this->load->view("agents/allAgents",$data);
}

public function editAgent($id){
	
	$adata = $this->db->get_where("fdm_va_auths",array("id"=>$id,"deleted"=>0))->row();
	
	$data["u"] = $adata;
	
	$uagts = $this->admin->getAllunassdagents();
	$uati = $this->admin->allunAssndti();

	if($adata->role == 11){
	
		$uasemp = [];
		
	}else{
		
		$uasemp = $this->admin->allunAssndsemp();
	
	}
		
	$asAgts = json_decode($adata->assigned_agents)->agents;
	$asBdas = json_decode($adata->assigned_agents)->salesemployees;
	$asTis = json_decode($adata->assigned_agents)->tincharge;
	
	$asAgt = [];
	$asBda = [];
	$asTi = [];
	if(count($asAgts) > 0){
		
		foreach($asAgts as $ag){
			
			$asAgt[] = $this->db->get_where("fdm_va_auths",array("id"=>$ag,"deleted"=>0))->row();
			
		}
		
	}
	
	if(count($asBdas) > 0){
		
		foreach($asBdas as $bda){
			
			$asBda[] = $this->db->get_where("fdm_va_auths",array("id"=>$bda,"deleted"=>0))->row();
			
		}
		
	}
	
	if(count($asTis) > 0){
		
		foreach($asTis as $ti){
			
			$asTi[] = $this->db->get_where("fdm_va_auths",array("id"=>$ti,"deleted"=>0))->row();
			
		}
		
	}
	
	$data["uagents"] = array_merge($asAgt,$uagts);
	$data["bda"] = array_merge($asBda,$uasemp);
	$data["tis"] = array_merge($asTi,$uati);
	
//	echo '<pre>';
////	print_r($data["agents"]);
////	print_r($data["bda"]);
//	print_r($asAgts);
//	exit();
	
	
	$this->load->view("agents/editAgent",$data);
}
	
	
public function userstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('user_status'=>$status);
		
		$this->db->set($data);
		$this->db->where("userid",$id);
		$d=$this->db->update("shreeja_users");
		
		if($d){
			if($status==0){
				echo 1;
				//echo $this->alert->pnotify("Success","Successfully News Enabled","success");
			}else{
				echo 0;
				//echo $this->alert->pnotify("Success","Successfully News Disabled","success");	
			}

		}else{
			if($status==1){
				echo 2;
				echo $this->alert->pnotify("Error","Error Occured While Enabling News","error");
			}else{
				echo 3;
				echo $this->alert->pnotify("Error","Error Occured While Disabling News","error");
			}	
		}
		
}  		
	

public function insertAgent(){

	$name = $this->input->post("agent_name",true);
	$aid = $this->input->post("agent_id",true);
	$email = $this->input->post("agent_email",true);
	$mobile = $this->input->post("mobile_number",true);
	$password = $this->input->post("password",true);
	$status = $this->input->post("status",true);
	$city = $this->input->post("city",true);
	$area = $this->input->post("area",true);
	$address = $this->input->post("address",true);
	$route = $this->input->post("route",true);
	$eroute = $this->input->post("eroute",true);
	$role = $this->input->post("role",true);
	
	$agents = $this->input->post("agents",true);
	$salesemployees = $this->input->post("salesemployees",true);
	$tincharge = $this->input->post("tincharge",true);
	$date = date("Y-m-d H:i:s");
	
	
	$epass = $this->secure->encrypt($password);

	
	$chk = $this->db->get_where("fdm_va_auths",array("email"=>$email,"role"=>$role,"deleted"=>0))->num_rows();
	if($chk>=1){

			$this->alert->pnotify("error","Email Already Registered","error");
			redirect("agents/create-agent");
	}
	$chk1 = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"role"=>$role,"deleted"=>0))->num_rows();
	if($chk1>=1){

			
			$this->alert->pnotify("error","Mobile Number Already Registered","error");
			redirect("agents/create-agent");
	}
	
	$aChk = $this->db->get_where("fdm_va_auths",array("agent_id"=>$aid,"deleted"=>0))->num_rows();
	if($aChk>=1){

			
			$this->alert->pnotify("error","Agent ID Already Exists","error");
			redirect("agents/create-agent");
	}
	

			$data = array(

				"agent_id" => $aid,	
				"name" => $name,
				"email" => $email,
				"role" => $role,
				"mobile_number" => $mobile,
				"password" => $epass,
				"status" => $status,
				"city" => $city,
				"area" => $area,
				"address" => $address,
				"registered_date" => $date,
				"route" => $route,
				"eroute" => $eroute,
				"referral_id" => $this->admin->generateReferralid()

			);

			$u = $this->db->insert("fdm_va_auths",$data);
			$uid = $this->db->insert_id();
	
			if($u){
		
				
				if($role == 7){
					if(count($agents) > 0){

					   $this->db->where("id",$uid)->update("fdm_va_auths",array("assigned_agents"=>json_encode(array("agents"=>$agents))));	

					}
				}
				
				if($role == 12){
					
					   $this->db->where("id",$uid)->update("fdm_va_auths",array("assigned_agents"=>json_encode(array("salesemployees"=>$salesemployees))));	

				}
				
				if($role == 11){
					
					   $this->db->where("id",$uid)->update("fdm_va_auths",array("assigned_agents"=>json_encode(array("tincharge"=>$tincharge,"salesemployees"=>$salesemployees))));	

				}
					
				$this->alert->pnotify("success","Agent Successfully Registered","success");
				redirect("agents/create-agent");

			}else{
					
					$this->alert->pnotify("error","Error Occured While Registering Agent","error");
					redirect("agents/create-agent");
			}
	
}

public function updateAgent(){

	$aid = $this->input->post("agent_id",true);
	$name = $this->input->post("agent_name",true);
	$email = $this->input->post("agent_email",true);
	$mobile = $this->input->post("mobile_number",true);
	$password = $this->input->post("password",true);
	$status = $this->input->post("status",true);
	$city = $this->input->post("city",true);
	$area = $this->input->post("area",true);
	$address = $this->input->post("address",true);
	$date = date("Y-m-d H:i:s");
	$id = $this->input->post("id",true);
	
	$route = $this->input->post("route",true);
	$eroute = $this->input->post("eroute",true);
	$role = $this->input->post("role",true);
	
	$agents = $this->input->post("agents",true);
	$salesemployees = $this->input->post("salesemployees",true);
	$tincharge = $this->input->post("tincharge",true);
	
	$epass = $this->secure->encrypt($password);

$echk = $this->db->get_where("fdm_va_auths",array("email"=>$email,"id"=>$id,"role"=>$role))->row()->email;

	if($echk==$email){

		$data = array("email" => $email);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");

	}else{
		$echk1 = $this->db->get_where("fdm_va_auths",array("email"=>$email,"deleted"=>0,"role"=>$role))->num_rows();	
		if($echk1>=1){
			$this->alert->pnotify("error","Email Already Registered","error");
			redirect("agents/update-agent/".$id);
		}else{	
		$data = array("email" => $email);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");
		}
	}
$mchk = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"id"=>$id,"role"=>$role))->row()->mobile_number;

	if($mchk==$mobile){

		$data = array("mobile_number" => $mobile);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");

	}else{
		$mchk1 = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"deleted"=>0,"role"=>$role))->num_rows();	
		if($mchk1>=1){
			$this->alert->pnotify("error","Mobile Number Already Registered","error");
			redirect("agents/update-agent/".$id);

		}else{	
		$data = array("mobile_number" => $mobile);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");
		}
	}

$achk = $this->db->get_where("fdm_va_auths",array("agent_id"=>$aid,"id"=>$id))->row()->agent_id;

	if($achk==$aid){

		$data = array("agent_id" => $aid);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");

	}else{
		$achk1 = $this->db->get_where("fdm_va_auths",array("agent_id"=>$aid,"deleted"=>0))->num_rows();	
		if($achk1>=1){
			$this->alert->pnotify("error","Agent ID Already Exists","error");
			redirect("agents/update-agent/".$id);

		}else{	
		$data = array("agent_id" => $aid);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");
		}
	}	
	

	$data = array(
			"name" => $name,
			"password" => $epass,
			"status" => $status,
			"city" => $city,
			"area" => $area,
			"address" => $address,
			"route" => $route,
			"role" => $role,
			"eroute" => $eroute
	);

		 $this->db->set($data);
		 $this->db->where("id",$id);
	$u = $this->db->update("fdm_va_auths");


	if($u){
		
			if($role == 7){
				if(count($agents) > 0){

				   $this->db->where("id",$id)->update("fdm_va_auths",array("assigned_agents"=>json_encode(array("agents"=>$agents))));	

				}
			}

			if($role == 12){

				   $this->db->where("id",$id)->update("fdm_va_auths",array("assigned_agents"=>json_encode(array("salesemployees"=>$salesemployees))));	

			}

			if($role == 11){

				   $this->db->where("id",$id)->update("fdm_va_auths",array("assigned_agents"=>json_encode(array("tincharge"=>$tincharge,"salesemployees"=>$salesemployees))));	

			}
			
		
			$this->alert->pnotify("success","Agent Details Updated Successfully","success");
		
			redirect("agents/all-agents");
		
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating Agent","error");
			redirect("agents/update-agent/".$id);
	}
}


public function deleteUser($id){

//	$u = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row();
//	$data = array("deleted"=>1,"status"=>"Inactive");
//	$this->db->set($data);
//	$this->db->where("id",$id);
	$du = $this->db->delete("fdm_va_auths",array("id"=>$id));
	if($du){
		$this->alert->pnotify("success","Agent Deleted Successfully","success");
//			redirect("users/all-users");
	}else{

		$this->alert->pnotify("error","Error Occured While Deleting Agent","error");
//			redirect("users/all-users");
	}
}


public function user_access(){

	$this->load->view("users/useraccess");
}
	
	
public function getAreas(){
		
		$id=$this->input->get("id",true);
		
		$d=$this->products_model->getProduct($id);
	
		echo '<option value="">Select Quantity</option>';
	
		foreach($qty->quantity as $q){
			
			echo '<option value="'.$q.'">'.$q.'</option>';
		}
		
}	

}