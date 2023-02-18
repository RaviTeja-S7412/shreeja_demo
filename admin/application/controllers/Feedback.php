<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Feedback extends CI_Controller {
	
public function __construct(){
			
	parent::__construct();
	
	$this->secure->loginCheck();
	
}

public function index(){

	$data["users"] = $this->db->query("select * from tbl_feedback order by id desc")->result();
	$this->load->view("feedback/allfeedback",$data);
}

public function anl(){

	$data["users"] = $this->db->query("select * from shreeja_users where area_delivery_status='Inactive' order by userid desc")->result();
	$this->load->view("users/anlUsers",$data);
}	
	
public function editUser($id){

	$data["u"] = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row();
	$this->load->view("users/editUser",$data);
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
	

public function insertUser(){

	$eid = $this->input->post("emp_id",true);
	$name = $this->input->post("user_name",true);
	$email = $this->input->post("user_email",true);
	$designation = $this->input->post("user_designation",true);
	$role = $this->input->post("user_role",true);
	$mobile = $this->input->post("user_mobile_number",true);
	$password = $this->input->post("user_password",true);
	$status = $this->input->post("user_status",true);
	$date = date("Y-m-d H:i:s");

	$epass = $this->secure->encrypt($password);

	$chk = $this->db->get_where("fdm_va_auths",array("emp_id"=>$eid))->num_rows();
	
	$chk = $this->db->get_where("fdm_va_auths",array("email"=>$email,"deleted"=>0))->num_rows();
	if($chk>=1){

			$this->alert->pnotify("error","Email Already Registered","error");
			redirect("users/create-user");
	}
	$chk1 = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"deleted"=>0))->num_rows();
	if($chk1>=1){

			
			$this->alert->pnotify("error","Mobile Number Already Registered","error");
			redirect("users/create-user");
	}
	$chk2 = $this->db->get_where("fdm_va_auths",array("emp_id"=>$eid,"deleted"=>0))->num_rows();
	if($chk2>=1){

			
			$this->alert->pnotify("error","Employee ID Already Registered","error");
			redirect("users/create-user");
	}
	
			$msg = '<html>
			<head>

			</head>
			<body>
			<table style="width:100%;border:3px solid #363636;border-bottom:0px;">
				<tr style="background-color: #002F47;">
					<td>
					<center><img src="'.base_url().'assets/images/logo.jpg" width="40%"/></center>
					</td>
				</tr>
				
			
			</table>
			<br>
			<table style="width:100%;border:3px solid #363636;border-top:0px;">
			<thead>
			 <tr>
				<th>Emp ID</th>
				<th>Username</th>
				<th>Password</th>
			 </tr>	
			</thead>
			<tbody>
				<tr style="background-color: #D4D4D4">
				 <td style="text-align:center">'.$eid.'</td>
				 <td style="text-align:center">'.$email.'</td>
				 <td style="text-align:center">'.$password.'</td>
				</tr>
			</tbody>
			</table>
			
				
				
			
			</body>
			</html>';
	

	if($role==3){
				$data = array(

				"name" => $name,
				"email" => $email,
				"designation" => $designation,
				"role" => $role,
				"mobile_number" => $mobile,
				"password" => $epass,
				"status" => $status,
				"registered_date" => $date,
				"emp_id" => $eid

			);

			$u = $this->db->insert("fdm_va_auths",$data);
			$uid = $this->db->insert_id();
		

			if($u){
				
				
		
				
			$from = new SendGrid\Email("Freedom Bank", "info@freedombankva.com");
			$subject = "Enquiry : Freedom Bank Admin Login Details";
			$to = new SendGrid\Email("FBANK",$email);

			$content = new SendGrid\Content("text/html",$msg);
			$mail = new SendGrid\Mail($from, $subject, $to, $content);
			$sg = new \SendGrid('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');
			$response = $sg->client->mail()->send()->post($mail);	
				
				
				
					$data = array("user_id"=>$uid,"module_id"=>4);
					$ra = $this->db->insert("fdm_va_admin_role_access",$data);
					if($ra){
					$this->alert->pnotify("success","User Successfully Registered","success");
					redirect("users/all-users");
					}else{
					
					$this->alert->pnotify("error","Error Occured While Registering User","error");
					redirect("users/create-user");
					}
			}else{
					
					$this->alert->pnotify("error","Error Occured While Registering User","error");
					redirect("users/create-user");
			}
	}else{
	$data = array(

		"name" => $name,
		"email" => $email,
		"designation" => $designation,
		"role" => $role,
		"mobile_number" => $mobile,
		"password" => $epass,
		"status" => $status,
		"registered_date" => $date,
		"emp_id" => $eid

	);

	$uu = $this->db->insert("fdm_va_auths",$data);

	if($uu){
		
		
			$from = new SendGrid\Email("Freedom Bank", "info@freedombankva.com");
			$subject = "Freedom Bank Admin Login Details";
			$to = new SendGrid\Email("FBANK",$email);

			$content = new SendGrid\Content("text/html",$msg);
			$mail = new SendGrid\Mail($from, $subject, $to, $content);
			$sg = new \SendGrid('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');
			$response = $sg->client->mail()->send()->post($mail);	
//			

			$this->alert->pnotify("success","User Successfully Registered","success");
			redirect("users/all-users");
	}else{
			
			$this->alert->pnotify("error","Error Occured While Registering User","error");
			redirect("users/create-user");
	}
}
}

public function updateUser(){

	$name = $this->input->post("user_name",true);
	$email = $this->input->post("user_email",true);
	$designation = $this->input->post("user_designation",true);
	$role = $this->input->post("user_role",true);
	$mobile = $this->input->post("user_mobile_number",true);
	$status = $this->input->post("user_status",true);
	$date = date("Y-m-d H:i:s");
	$id = $this->input->post("id",true);
	$eid = $this->input->post("emp_id",true);

	

$echk = $this->db->get_where("fdm_va_auths",array("email"=>$email,"id"=>$id))->row()->email;

	if($echk==$email){

		$data = array("email" => $email);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");

	}else{
		$echk1 = $this->db->get_where("fdm_va_auths",array("email"=>$email,"deleted"=>0))->num_rows();	
		if($echk1>=1){
			$this->alert->pnotify("error","Email Already Registered","error");
			redirect("users/update-user/".$id);
		}else{	
		$data = array("email" => $email);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");
		}
	}
$mchk = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"id"=>$id))->row()->mobile_number;

	if($mchk==$mobile){

		$data = array("mobile_number" => $mobile);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");

	}else{
		$mchk1 = $this->db->get_where("fdm_va_auths",array("mobile_number"=>$mobile,"deleted"=>0))->num_rows();	
		if($mchk1>=1){
			$this->alert->pnotify("error","Mobile Number Already Registered","error");
			redirect("users/update-user/".$id);

		}else{	
		$data = array("mobile_number" => $mobile);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");
		}
	}
$emchk = $this->db->get_where("fdm_va_auths",array("emp_id"=>$eid,"id"=>$id))->row()->emp_id;

	if($emchk==$eid){

		$data = array("emp_id" => $eid);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");

	}else{
		$emchk1 = $this->db->get_where("fdm_va_auths",array("emp_id"=>$eid,"deleted"=>0))->num_rows();	
		if($emchk1>=1){
			$this->alert->pnotify("error","Employee ID Already Exists","error");
			redirect("users/update-user/".$id);

		}else{	
		$data = array("emp_id" => $eid);

		 $this->db->set($data);
		 $this->db->where("id",$id);
		 $this->db->update("fdm_va_auths");
		}		
	}
	$data = array(

		"name" => $name,
		"designation" => $designation,
		"role" => $role,
		"status" => $status,

	);

		 $this->db->set($data);
		 $this->db->where("id",$id);
	$u = $this->db->update("fdm_va_auths");


	if($u){
		
	$er = $this->db->get_where("fdm_va_auths",array("id"=>$id,"role"=>3))->num_rows();
    if($er==0){	
		
		$module_id = $this->input->post("module_id",true);
		$datee = date("Y-m-d H:i:s");
		//print_r($module_id);

		$coun = count($module_id);

	
		$d = $this->admin->get_module($id);

		//print_r($d);
// Comparing diff b/w posted data and exist module for user
		$delmod = array_diff($d, $module_id);


		if($coun>0){

// Inserting Module If Not Exists For This User
		foreach ($module_id as $mm) {

  		$mod1 = in_array($mm, $d);
				
					if($mod1){

					}else{

						
						$data=array("user_id"=>$id,'module_id'=>$mm,"date"=>$datee);
				
						$d=$this->db->insert("fdm_va_admin_role_access",$data);
					}

					

				}
// Deleting module if module is unchecked
	if(count($delmod)>0){
			
			foreach ($delmod as $m_id) {
					
					
				$this->db->delete("fdm_va_admin_role_access",array("user_id"=>$id,"module_id"=>$m_id));

						
					 }
				}	
			
			}else{
// deleting all modules for user
				$data = array("user_id"=>$id);
				$this->db->delete("fdm_va_admin_role_access",$data);
			}


	}else{
		
		$dm = $this->db->delete("fdm_va_admin_role_access",array("user_id"=>$id));
		
		if($dm){
			
			$data = array("user_id"=>$id,"module_id"=>4);
			$this->db->insert('fdm_va_admin_role_access',$data);
		}
	}
		
			$this->alert->pnotify("success","User Details Updated Successfully","success");
		
			redirect("users/all-users");
		
	}else{
			
			$this->alert->pnotify("error","Error Occured While Updating User","error");
			redirect("users/update-user/".$id);
	}
}


public function deleteUser($id){

	$u = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row();
	$data = array("deleted"=>1,"status"=>"Inactive");
	$this->db->set($data);
	$this->db->where("id",$id);
	$du = $this->db->update("fdm_va_auths");
	if($du){
		$this->alert->pnotify("success","User Details Deleted Successfully","success");
			redirect("users/all-users");
		}else{
			
			$this->alert->pnotify("error","Error Occured While Deleting User","error");
			redirect("users/all-users");
		}
}


public function user_access(){

	$this->load->view("users/useraccess");
}

}