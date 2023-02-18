<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

public function __construct(){
			
		   parent::__construct();

		$page = $this->uri->segment(1);
		   
//		if($page==""){
//			
//			
//
//		}else{	
//			
//		  $pcc = $this->db->get_where("fdm_va_pages",array("page_link"=>$page,"status"=>"Active","deleted"=>0))->num_rows();
//		  
//		  if($pcc == 1){
//			  
//		   $pc = $this->db->get_where("fdm_va_pages",array("page_link"=>$page,"status"=>"Active","deleted"=>0))->row();
//		   if($pc->page_link==$page){
//		   		
//		   }else{
//		   	  redirect("pageerror/noAccess");
//		   }
//		  }
//		}
 }


public function index(){
	
// Website Viewers Count program start	
// 	$ip = $this->input->ip_address();
	
// 	$vchk = $this->db->get_where("fdm_va_website_views",array("ip_address"=>$ip))->num_rows();
	
// 	if($vchk >= 1){
		
// 	}else{
		
// 		$data = array("ip_address"=>$ip);
		
// 		$this->db->insert("fdm_va_website_views",$data);
// 	}
	
// 	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
//     $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
//     // echo "The URL of current page: ".$CurPageURL."<br>"; 
    
//     $domain = $this->get_domain($CurPageURL);

//     $root = base_url();
    
//     if($root == $CurPageURL){
        
//         header("Location: https://$domain/");
//         exit;    
//     }

    
// // Website Viewers Count program End	
	
// 	$this->load->view("Index");

    redirect('/login');

}
	
function get_domain($url)
{
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return false;
}	
	
public function register(){
	
	$this->load->view("registration");
	
	
}


public function selectCity($rid=""){
	
	if($rid){
		
		$this->session->set_userdata("referral_id",$rid);
		
	}
	
	$this->load->view("selectCity");
	
}	
	
public function registration(){
	
	$this->load->view("subscribedRegister");
	
	
}		
	
	
	
public function selectLocation($loc){
	
//	$loc = $this->input->post("location");
	
	if($loc != ""){
		
		$this->session->set_userdata(array("location_id"=>$loc));
		
		redirect("home/registration");
		
	}
	
	
}		



public function sendOtp(){
	
	$mobile = $this->input->post("mobile");
	
	if($mobile != ""){

		$mchk = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile));

//		if($mchk->num_rows() == 1){
//					
//			echo json_encode(array("status"=>"exists"));
//			exit();
//		}
		
			$string = '0123456789';
			$string_shuffled = str_shuffle($string);
			$otp = substr($string_shuffled, 1, 4);
			
			$otpChk = $this->db->get_where("fdm_va_otp",array("mobile_number"=>$mobile))->num_rows();
			
			if($otpChk == 1){
				
				$data = array("otp"=>$otp);
				
				$this->db->set($data);
				$this->db->where("mobile_number",$mobile);
				$mi = $this->db->update("fdm_va_otp");
			}else{

				$data = array("mobile_number"=>$mobile,"otp"=>$otp);

				$mi = $this->db->insert("fdm_va_otp",$data);
				
			}
			if($mi){
				
				if($mchk->num_rows() == 0){
					$this->db->insert("shreeja_users",array("steps_completed"=>2,"user_mobile"=>$mobile));
				}
				$udata = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile))->row();

				$this->session->set_userdata(array("mobile_number"=>$mobile,"steps_completed"=>$udata->steps_completed));

                $uotp = $this->db->get_where("fdm_va_otp",array("mobile_number"=>$mobile))->row();
				$msg = "$uotp->otp (OTP number) is your Shreeja Milk OTP. OTP is confidential for security reasons do not share with any one.";

                if($udata->steps_completed == 3 || $udata->steps_completed == 4){
                    
                }else{
                    
				    $this->sms->send_sms($mobile,$msg);

                }
				echo json_encode(array("status"=>"success","steps_completed"=>$udata->steps_completed));
			}else{
				
				echo json_encode(array("status"=>"error"));
			}
			
		
		
	}else{
		
		echo "error";
	}
	
	
}
	
public function otpConfirm(){
	
	$mobile = $this->session->userdata("mobile_number");
	
	
	$otp = $this->input->post("otp", true);
	
	$otpChk = $this->db->get_where("fdm_va_otp",array("otp"=>$otp,"mobile_number"=>$mobile))->num_rows();
	if($otpChk == 1){
		
//		$this->db->where("user_mobile",$mobile)->update("shreeja_users",array("steps_completed"=>3));
		
		$this->db->delete("fdm_va_otp",array("mobile_number"=>$mobile));
		echo "success";
		
	}else{
		
		echo "error";
	}
	
}	

	
	
public function resendOtp(){
	
	$mobile = $this->input->post("mobile");

	$otpChk = $this->db->get_where("fdm_va_otp",array("mobile_number"=>$mobile))->row();
	
	$otp = $otpChk->otp;
	
//	echo($otp);
			if($otpChk){
				$msg = "$otp (OTP number) is your Shreeja Milk OTP. OTP is confidential for security reasons do not share with any one.";

				$this->sms->send_sms($mobile,$msg);

				echo "success";	
			}else{
				
				echo("error");
			}

	
}	
	

public function insertUser(){
	
	$name = $this->input->post("username");
	$mobile = $this->input->post("mobile");
	$email = $this->input->post("email");
	
	$city = $this->input->post("city");

	$area = $this->input->post("area");
	$locality = $this->input->post("locality");
	$address = $this->input->post("address");
	$house_no = $this->input->post("house_no");	
	$landmark = $this->input->post("landmark");
	$cpassword = $this->input->post("password");
	$referral_id = $this->input->post("referral_id");
	
	$password =$this->secure->encrypt($cpassword);
	
	$areanotlisted = $this->input->post("areanotlisted");
	if($areanotlisted != ""){
		
		$areadeliverystatus = "Inactive";
		$area = "";
		
	}else{
		
		$areadeliverystatus = "Active";
	}
	
		
	$mchk = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile))->row();
//	
//	if($mchk == 1){
//		
//		$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">Mobile Number Already Registered</div>';
//		$this->session->set_flashdata("err",$msg);
//		redirect("register");
//		
//	}
	
	$echk = $this->db->get_where("shreeja_users",array("user_email"=>$email))->num_rows();
	
	if($echk == 1){
		
		$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">Email Already Registered</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("register");
		
	}
	
	if($cpassword == $name){
		
		$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">Password & User name should not be same.</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("register");
		
	}
	
	$ref_id = $this->input->post("referral_id");
	if($ref_id){

		$rfdata = $this->db->where("user_mobile",$mobile)->get("shreeja_users")->row();
		$r = $this->admin->getReferrers($ref_id,$rfdata->userid);	
		if(!$r["status"]){

//			return $r;
			$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">'.$r["message"].'</div>';
			$this->session->set_flashdata("err",$msg);
			redirect("register");

		}

	}
	
	$string = '0123456789';
	$string_shuffled = str_shuffle($string);
	$otp = substr($string_shuffled, 1, 4);

	
	$data = array(
	
//		"user_mobile" => $mobile,
		"user_location" => $city,
		"user_name" => $name,
		"user_email" => $email,
		"user_area" => $area,
		"user_locality" => $locality,
		"user_current_address" => $address,
		"landmark" => $landmark,
		"house_no" => $house_no,
		"user_otp" => $otp,
		"areanotlisted" => $areanotlisted,
		"password" => $password,
		"area_delivery_status" => $areadeliverystatus,
		"steps_completed"=>4,
		"referral_id" => $this->admin->generateReferralid()
	
	);
	
	$ui = $this->db->where("user_mobile",$mobile)->update("shreeja_users",$data);
	
//	$uid = $this->db->insert_id();
	if($ui){
		
		$this->session->unset_userdata("referral_id");
		$msg = "You have successfully registered with us.";
		
		$this->sms->send_sms($mobile,$msg);
		
		
		
	if($areanotlisted != ""){
		
		$msg = "Thanks for showing the interest, will communicate shortly";
		$this->sms->send_sms($mobile,$msg);
		
		
	}

		$this->session->set_userdata(array("user_mobile"=>$mobile,"user_id"=>$mchk->userid));
		
		
		if($this->session->userdata("reg_status") == "freeSample"){
			
			redirect("products/sampleOrder");
		}else{
		
			redirect("products");
		}
			
	}else{
		
		$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">Error Occured Please Try Again</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("register");
		
	}
	
	
}	
	
	
public function enterOtp(){
	
	$this->load->view("otp");
	
}	

public function checkOtp(){
	
	$mobile = $this->session->userdata("user_mobile");
	
	$otp = $this->input->post("otp");
	
	$otpChk = $this->db->get_where("shreeja_users",array("user_otp"=>$otp,"user_mobile"=>$mobile))->num_rows();
	
	if($otpChk == 1){
		
		$udata = $this->db->get_where("shreeja_users",array("user_otp"=>$otp,"user_mobile"=>$mobile))->row();
		
		$this->session->set_userdata(array("user_id"=>$udata->userid));
		
		redirect("products");
		
	}else{
		
		$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">Please Enter Valid OTP</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("enterOtp");
		
	}
	
}
	
	
public function do_login(){
	
	
	$mobile = $this->input->post("mobile");
	$password = $this->input->post("password");
	
	$mchk = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile,"user_status"=>0,"steps_completed"=>4))->num_rows();
	
	if($mchk == 1){

		$pchk = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile,"user_status"=>0,"steps_completed"=>4))->row();
		
//		if($pchk->steps_completed == 1 || $pchk->steps_completed == 2){
//			
//			redirect('home/selectCity');
//			
//		}elseif($pchk->steps_completed == 3){
//			
//			redirect('register');
//			
//		}
		

		$cpass = $this->secure->decrypt($pchk->password);
	
		
		if($cpass == $password){
			
//			$msg = "$otp (OTP number) is your Shreeja Milk OTP. OTP is confidential for security reasons do not share with any one.";
//		
//			$this->sms->send_sms($mobile,$msg);
			
			$this->session->set_userdata(array("user_mobile"=>$mobile,"user_id"=>$pchk->userid));
	
			redirect("products");
			
		}else{
			
			$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">Password is Wrong</div>';
			$this->session->set_flashdata("err",$msg);
			redirect("login");
		}

		
	}else{
		
		$msg = '<div class="alert alert-danger" align="center" style="margin: 20px">You are not registered with us. Please sign up with us.</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("login");
		
	}
	
}

	
// Forgot password	
	
public function forgotPassword(){
	
	$this->load->view("forgot-password");
}

public function changePassword(){
	
	$this->load->view("change-password");
}	
	
public function checkMobilenumber(){
	
	$mobile = $this->input->post("mobile");
	
	$mchk = $this->db->get_where("shreeja_users",array("user_mobile"=>$mobile,"user_status"=>0,"steps_completed"=>4))->num_rows();

	if($mchk == 1){
		
		$string = '0123456789';
		$string_shuffled = str_shuffle($string);
		$otp = substr($string_shuffled, 1, 4);
			
			$otpChk = $this->db->get_where("fdm_va_otp",array("mobile_number"=>$mobile))->num_rows();
			
			if($otpChk == 1){
				
				$data = array("otp"=>$otp);
				
				$this->db->set($data);
				$this->db->where("mobile_number",$mobile);
				$mi = $this->db->update("fdm_va_otp");
			}else{

				$data = array("mobile_number"=>$mobile,"otp"=>$otp);

				$mi = $this->db->insert("fdm_va_otp",$data);
				
			}
			if($mi){

				$this->session->set_userdata(array("mobile_number"=>$mobile));

				$msg = "$otp (OTP number) is your Shreeja Milk OTP. OTP is confidential for security reasons do not share with any one.";

				$this->sms->send_sms($mobile,$msg);

				echo "success";	
			}else{
				
				echo("oerror");
			}
		
		
	}else{
		
		echo "error";
	}
}
	
	
public function updatePassword(){
	
	$npass = $this->input->post("npass");
//	$cpass = $this->input->post("cpass");
	
//	if($npass == $cpass){
		
		$data = array("password"=>$this->secure->encrypt($npass));
		
		$this->db->set($data);
		$this->db->where("user_mobile",$this->session->userdata("mobile_number"));
		$u = $this->db->update("shreeja_users");
		
		if($u){
			
			$msg = '<div class="alert alert-success" align="center" style="margin: 20px">Password Updated Successfully</div>';
			$this->session->set_flashdata("err",$msg);
			redirect("login");
		}else{
			
			$msg = '<div class="alert alert-danger">Error Occured Please Try Again</div>';
			$this->session->set_flashdata("err",$msg);
			redirect("home/changePassword");
		}
		
//	}else{
//		
//		$msg = '<div class="alert alert-danger">Password Not Matched</div>';
//		$this->session->set_flashdata("err",$msg);
//		redirect("home/changePassword");
//	}
	
	
}	
	


	
public function profile(){
	
	$uid = $this->session->userdata("user_id");
	
	if(!$uid){
		
		redirect("login");
	}
	
	$this->load->view("profile");
}
	
	
public function updateProfile(){
	
	$uid = $this->session->userdata("user_id");
	
	if(!$uid){
		
		redirect("login");
	}
	
	$name = $this->input->post("username");
	$mobile = $this->input->post("mobile");
	$email = $this->input->post("email");
	$city = $this->input->post("city");
	$area = $this->input->post("area");
	$locality = $this->input->post("locality");
	$address = $this->input->post("address");
	$house_no = $this->input->post("house_no");	
	$landmark = $this->input->post("landmark");
	
	$mchk = $this->db->query("select * from shreeja_users where user_mobile='$mobile' and user_status=0 and userid != '$uid'")->num_rows();
	
	if($mchk == 1){
		
		$msg = '<div class="alert alert-danger" align="center">Mobile Number Already Registered</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("home/profile");
		
	}
	
	$echk = $this->db->query("select * from shreeja_users where user_email='$email' and user_status=0 and userid != '$uid'")->num_rows();
	
	if($echk == 1){
		
		$msg = '<div class="alert alert-danger" align="center">Email Already Registered</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("home/profile");
		
	}

	
	$data = array(
	
//		"user_mobile" => $mobile,
		"user_location" => $city,
		"user_name" => $name,
		"user_email" => $email,
		"user_area" => $area,
		"user_locality" => $locality,
		"user_current_address" => $address,
		"landmark" => $landmark,
		"house_no" => $house_no,
	);
	
	
	$this->db->set($data);
	$this->db->where("userid",$uid);
	$ui = $this->db->update("shreeja_users");
	
	if($ui){
		$msg = '<div class="alert alert-success" align="center">Profile Successfully Updated</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("home/profile");
		
	}else{
		
		$msg = '<div class="alert alert-danger" align="center">Error Occured Please Try Again</div>';
		$this->session->set_flashdata("err",$msg);
		redirect("home/profile");
		
	}
	
	

	
	
	
}	
	
	
public function logout(){
	
	$this->session->unset_userdata("user_id");
	$this->session->unset_userdata("mobile_number");
	$this->session->unset_userdata("user_mobile");
	$this->session->unset_userdata("location_id");
	$this->session->unset_userdata("reg_status");
	redirect("https://shreejamilk.com/");
	
}
	
	
public function regfsStatus(){
	
	$regChk = $this->session->userdata("reg_status");
	
	if($regChk){
		
		redirect("home/selectCity");
		
//		$this->session->unset_userdata("reg_status");
	}else{
		
		$this->session->set_userdata(array("reg_status"=>"freeSample"));
		
		redirect("home/selectCity");
		
	}
	
}	

public function regStatus(){
	
	$regChk = $this->session->userdata("reg_status");
	
	if($regChk){
		
		$this->session->unset_userdata("reg_status");
		redirect("home/selectCity");
		
	}else{
		redirect("home/selectCity");
		
//		$this->session->set_userdata(array("reg_status"=>"freeSample"));
	}
	
}	
	
	public function updateAccountdetails(){
		
		$uid = $this->input->post("uid");
		$udata = $this->db->get_where("shreeja_users",["userid"=>$uid])->row();
		
		$account_number = $this->input->post("account_number");
		$confirm_account_number = $this->input->post("confirm_account_number");
		$ifsc_code = $this->input->post("ifsc_code");
		$account_holder_name = $this->input->post("account_holder_name");
		$account_mobile_number = $this->input->post("account_mobile_number");
		$account_nick_name = $this->input->post("account_bank_name");
		$branch_name = $this->input->post("branch_name");
		$bank_city = $this->input->post("bank_city");
		$ref = $this->input->post("ref");
		
		if($ref != "web"){
			if($account_number != $confirm_account_number){

				$ndata = array("status"=>false, "data"=>"Account Number Not Matched");
				echo json_encode($ndata);
				exit();

			}
		}
		
			if($_FILES['bank_passbook']['size']!='0'){
				$config['upload_path']          = "admin/uploads/user_bank_details/";
				$config['allowed_types']        = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if($this->upload->do_upload("bank_passbook")){

					$d=$this->upload->data();
					$icon = "uploads/user_bank_details/".$d['file_name'];
					unlink($udata->bank_passbook);
					
				}else{

					$ndata = array("status"=>false, "data"=>"Please select valid image");
					echo json_encode($ndata);
					exit();

				}

			}else{
				$icon = $udata->bank_passbook;
			}
		
		$data = [
			"account_number" => $account_number,
			"ifsc_code" => $ifsc_code,
			"account_holder_name" => $account_holder_name,
			"account_mobile_number" => $account_mobile_number,
			"account_bank_name" => $account_nick_name,
			"bank_city" => $bank_city,
			"branch_name" => $branch_name,
			"bank_passbook" => $icon,
			"bank_details_updated_date" => date("Y-m-d H:i:s")
		];
		
		$data = $this->db->where("userid",$uid)->update("shreeja_users",$data);
		
		if($data)
		{
			$ndata = array("status"=>true, "data"=>"Account details updated");
			echo json_encode($ndata);
		}else
		{
			$ndata = array("status"=>false, "data"=>"");
			echo json_encode($ndata);
		}
		
	}
	


}