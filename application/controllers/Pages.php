<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once(APPPATH.'libraries/sendgrid/sendgrid-php.php');

class Pages extends CI_Controller {

public function __construct(){
			
	parent::__construct();
	
	

 }
	
public function index(){
	
	$r1 = $this->uri->segment(1);
	
	if($r1 == "" || $r1 == "#"){
		
		redirect(base_url()."home");
		
	}
	
}	


public function page($route){
	
	$r1 = $this->uri->segment(1);
	$r2 = $this->uri->segment(2);
	$r3 = $this->uri->segment(3);
	
	
if($r1 == "home"){	
	
// Website Viewers Count program start	
	$ip = $this->input->ip_address();
	
	$vchk = $this->db->get_where("fdm_va_website_views",array("ip_address"=>$ip))->num_rows();
	
	if($vchk >= 1){
		
	}else{
		
		$data = array("ip_address"=>$ip);
		
		$this->db->insert("fdm_va_website_views",$data);
	}

// Website Viewers Count program End
		
}
	
	

			if($r1 && $r2 && $r3){

				$route = "$r1/$r2/$r3";

			}elseif($r1 && $r2){

				$route = "$r1/$r2";

			}else{

				$route = $r1;
			}
		
//		echo $route;
		
		
	$chk = $this->db->get_where("pages",array("route"=>$route))->num_rows();
	
	if($chk == 1){
		$d = $this->db->get_where("pages",array("route"=>$route))->row();
		
		if($d->route == $route){
			
			$data['page'] = $this->db->get_where("pages",array("route"=>$route))->row();
	
			$this->load->view("template/header",$data);

			$this->load->view("pages/viewPage",$data);
			
			$this->load->view("template/footer");

			
		}
	}
//	else{
//			
//			redirect('home'); 
//		}
	
	
}
	

public function insertForm(){

	$page_id = $this->input->post('page_id');//$this->uri->segment(3);
	
	$date = date("Y-m-d");
	
	$n1 = $this->input->post('num1');

	$n2 = $this->input->post('num2');
	
	$captcha = $this->input->post("captcha");
	
	$count = $n1 + $n2;
	
	if($count != $captcha){
		
		echo 2;
		
		exit();
	}
	
	$data1 = urldecode($this->input->post("val"));
	
	
	$data2 = str_replace(","," ",$data1);
	
	$data = str_replace("'","",$data2);
	
//	echo $data;
//	
//	exit();
	
	
	$d = explode("&",$data);
	
	$i = implode(",",$d);
//	
//	$r = str_replace("=",":",$i);
	
	$ravi = explode(",",$i);
	
	
	
	$ravi1 = array();
	
	foreach($ravi as $val){
		
		
		list($key, $value) = explode('=', $val);
		
		$ravi1[] = $key.'"'.":".'"'.$value; 
	}
	
	$je = json_encode($ravi1);
	
	$ss = stripslashes($je);
	
	$fin = substr($ss, 1, -1);
	
	$fout = "{".$fin."}";
	

	
	
	$fdata = array("page_id"=>$page_id,"form_data"=>$fout,"created_date"=>$date);
	
	$fd = $this->db->insert("fdm_va_contact_you_form",$fdata);
	
	$last_insert_id = $this->db->insert_id();
	
	if($fd){
		
		$cp = $this->db->get_where("fdm_va_contact_you_form",array("id"=>$last_insert_id))->row();
		
		$mchk = $this->db->get_where("fdm_va_contact_emails",array("page_id"=>$page_id,"deleted"=>0))->row();
		
		$fodata = json_decode($cp->form_data);
		
		$cmail = json_decode($mchk->email);
		
		$pid = $this->db->get_where("pages",array("id"=>$page_id,"deleted"=>0))->row();
		
		if($pid->form_ref == "contact"){
			
			$usermsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Welcome</title>
			<style>
			* {
				margin: 0px;
				padding: 0px;
			}
			body {
				font-family: Arial, Helvetica, sans-serif;
			}
			a {
				color: #333!important;
				font-family: Arial, Helvetica, sans-serif;
				text-decoration: none;
			}
			a:hover {
				color: #000;
			}
			
			.container {
				margin: 0px auto;
				width: 650px;
				display: block;
				overflow: hidden;
			}
			.link td a {
				color: #fff!important;
				text-decoration: none !important;
			}
			.link td a:hover {
				color: #fff!important;
			}
			p {
				padding: 0px !important;
				margin: 0px !important;
			}
			.ebord{ border-collapse: collapse;}
			
			.ebord th{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:600; padding:10px; border:solid 1px #eee;}
			.ebord td{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:500; padding:10px; border:solid 1px #eee;}
			</style>
			</head>
			
			<body>
			<div class="container" style="width:650px; border:solid 1px #ccc;">
			   <table width="650px" cellpadding="0" cellspacing="0"  style=" width:650px; overflow:hidden;">
			   <tr>
				  <td aling="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			   
				<tr>
				  <td align="center" bgcolor="#f9f9f9"><table>
					  <tr>
						<td align="center" valign="top" bgcolor="#f9f9f9"><img src="'.base_url().'uploads/general/logo/logo.png" alt="" style="display:block;" height="100%" width="353px"></td>
					  </tr>
					</table></td>
				</tr>
				<tr>
			<td><table>
			<tr>
			<td width="60px"></td>
			 <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;"><p style="font-size:15px; color:#333;  padding-top:0px;"> Hello, <br /><br />
					 Thank you for contacting Freedom Bank. We appreciate your interest. <br>
			
					One of our team members will reach out to you in the next 24 to 48 hours, if not sooner. <br>
			
					We look forward to connecting! <br></p>
					</td>
			</tr>
			</table>
			</td>
			
			</tr>
				<tr><td>&nbsp;</td></tr>
				
				
				
				<tr><td>
			
				</td>
				</tr>
				 <tr><td>&nbsp;</td></tr>
				 <tr> <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;">
			
				 <table><tr>
			<td width="60px;"></td>
			<td ><p style="font-size:15px; color:#333;  padding-top:0px;">Regards,<br/>
			
			Freedom Bank of Virginia </p></td>
			</tr>
			</table>
			
			</td></tr>
			 <tr><td>&nbsp;</td></tr>
				<tr>
				   <td aling="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			  </table>
			</div>
			<br>

			
			</body>
			</html>
			';
			
				$clientmsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Welcome</title>
			<style>
			* {
				margin: 0px;
				padding: 0px;
			}
			body {
				font-family: Arial, Helvetica, sans-serif;
			}
			a {
				color: #333!important;
				font-family: Arial, Helvetica, sans-serif;
				text-decoration: none;
			}
			a:hover {
				color: #000;
			}
			
			.container {
				margin: 0px auto;
				width: 650px;
				display: block;
				overflow: hidden;
			}
			.link td a {
				color: #fff!important;
				text-decoration: none !important;
			}
			.link td a:hover {
				color: #fff!important;
			}
			p {
				padding: 0px !important;
				margin: 0px !important;
			}
			.ebord{ border-collapse: collapse;}
			
			.ebord th{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:600; padding:10px; border:solid 1px #eee;}
			.ebord td{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:500; padding:10px; border:solid 1px #eee;}
			</style>
			</head>
			
			<body>
			<div class="container" style="width:650px; border:solid 1px #ccc;">
			  <table width="650px" cellpadding="0" cellspacing="0"  style=" width:650px; overflow:hidden;">
			   <tr>
				  <td aling="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			   
				<tr>
				  <td align="center" bgcolor="#f9f9f9"><table>
					  <tr>
						<td align="center" valign="top" bgcolor="#f9f9f9"><img src="'.base_url().'uploads/general/logo/logo.png"" alt="" style="display:block;" height="100%" width="353px"></td>
					  </tr>
					</table></td>
				</tr>
				<tr>
				  <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;"><p style="font-size:15px; color:#333;  padding-top:0px; "> 
			
			<table><tr>
			<td width="60px;"></td>
			<td >Hello, <br /><br />
					  Please find below New Website Enquiry details for '.$pid->page_name.'</p></td>
			</tr>
			</table>
			
			
			
				  
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				
				
				
				<tr><td>
				  
				 <table>
				 <tr>
			<td width="60px;"></td>
			
			<td > <table width="500px" cellpadding="0" cellspacing="0"  style=" width:500px; overflow:hidden;" class="ebord">
				<tr>
				<th width="250px" align="right">Name:</th>
				<td>'.$fodata->name.'</td>
				</tr>
				
				 <tr>
			  <th width="250px" align="right">Email:</th>
				<td>'.$fodata->email.'</td>
				</tr>
				
				 <tr>
				<th width="250px" align="right">Subject:</th>
				<td>'.$fodata->subject.'</td>
				</tr>
				
				
				
				  <tr>
				<th width="250px" align="right">Message:</th>
				<td>'.$fodata->message.'</td>
				</tr>
				
				
				</table></td>
			</tr>
				 </table> 
			
			
			
			
			
			
				 
				</td>
				</tr>
				 <tr><td>&nbsp;</td></tr>
				 <tr> <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;">
			
			<table><tr>
			<td width="60px;"></td>
			<td ><p style="font-size:15px; color:#333;  padding-top:0px;">Regards,<br/>
			
			Freedom Bank of Virginia </p></td>
			</tr>
			</table>
			
			
			
				 
			</td></tr>
			 <tr><td>&nbsp;</td></tr>
				<tr>
				   <td align="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			  </table>
			  
			</div>
			
			</body>
			</html>
			';	
			
			
			
		}else{

			
			$usermsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Welcome</title>
			<style>
			* {
				margin: 0px;
				padding: 0px;
			}
			body {
				font-family: Arial, Helvetica, sans-serif;
			}
			a {
				color: #333!important;
				font-family: Arial, Helvetica, sans-serif;
				text-decoration: none;
			}
			a:hover {
				color: #000;
			}
			
			.container {
				margin: 0px auto;
				width: 650px;
				display: block;
				overflow: hidden;
			}
			.link td a {
				color: #fff!important;
				text-decoration: none !important;
			}
			.link td a:hover {
				color: #fff!important;
			}
			p {
				padding: 0px !important;
				margin: 0px !important;
			}
			.ebord{ border-collapse: collapse;}
			
			.ebord th{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:600; padding:10px; border:solid 1px #eee;}
			.ebord td{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:500; padding:10px; border:solid 1px #eee;}
			</style>
			</head>
			
			<body>
			<div class="container" style="width:650px; border:solid 1px #ccc;">
			   <table width="650px" cellpadding="0" cellspacing="0"  style=" width:650px; overflow:hidden;">
			   <tr>
				  <td aling="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			   
				<tr>
				  <td align="center" bgcolor="#f9f9f9"><table>
					  <tr>
						<td align="center" valign="top" bgcolor="#f9f9f9"><img src="'.base_url().'uploads/general/logo/logo.png" alt="" style="display:block;" height="100%" width="353px"></td>
					  </tr>
					</table></td>
				</tr>
				<tr>
			<td><table>
			<tr>
			<td width="60px"></td>
			 <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;"><p style="font-size:15px; color:#333;  padding-top:0px;"> Hello, <br /><br />
					 Thank you for contacting Freedom Bank. We appreciate your interest. <br>
			
					One of our team members will reach out to you in the next 24 to 48 hours, if not sooner. <br>
			
					We look forward to connecting! <br></p>
					</td>
			</tr>
			</table>
			</td>
			
			
			
			
			
			
			
			
				 
				</tr>
				<tr><td>&nbsp;</td></tr>
				
				
				
				<tr><td>
			
				</td>
				</tr>
				 <tr><td>&nbsp;</td></tr>
				 <tr> <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;">
			
				 <table><tr>
			<td width="60px;"></td>
			<td ><p style="font-size:15px; color:#333;  padding-top:0px;">Regards,<br/>
			
			Freedom Bank of Virginia </p></td>
			</tr>
			</table>
			
			</td></tr>
			 <tr><td>&nbsp;</td></tr>
				<tr>
				   <td align="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			  </table>
			</div>
			
			</body>
			</html>
			';

			
					
			
					$clientmsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Welcome</title>
			<style>
			* {
				margin: 0px;
				padding: 0px;
			}
			body {
				font-family: Arial, Helvetica, sans-serif;
			}
			a {
				color: #333!important;
				font-family: Arial, Helvetica, sans-serif;
				text-decoration: none;
			}
			a:hover {
				color: #000;
			}
			
			.container {
				margin: 0px auto;
				width: 650px;
				display: block;
				overflow: hidden;
			}
			.link td a {
				color: #fff!important;
				text-decoration: none !important;
			}
			.link td a:hover {
				color: #fff!important;
			}
			p {
				padding: 0px !important;
				margin: 0px !important;
			}
			.ebord{ border-collapse: collapse;}
			
			.ebord th{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:600; padding:10px; border:solid 1px #eee;}
			.ebord td{ font-family:Arial, Helvetica, sans-serif; color:#041e42; font-size:15px; font-weight:500; padding:10px; border:solid 1px #eee;}
			</style>
			</head>
			
			<body>
			<div class="container" style="width:650px; border:solid 1px #ccc;">
			  <table width="650px" cellpadding="0" cellspacing="0"  style=" width:650px; overflow:hidden;">
			   <tr>
				  <td aling="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			   
				<tr>
				  <td align="center" bgcolor="#f9f9f9"><table>
					  <tr>
						<td align="center" valign="top" bgcolor="#f9f9f9"><img src="'.base_url().'uploads/general/logo/logo.png"" alt="" style="display:block;" height="100%" width="353px"></td>
					  </tr>
					</table></td>
				</tr>
				<tr>
				  <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;"><p style="font-size:15px; color:#333;  padding-top:0px; "> 
			
			<table><tr>
			<td width="60px;"></td>
			<td >Hello, <br /><br />
					  Please find below New Website Enquiry details for '.$pid->page_name.'</p></td>
			</tr>
			</table>
			
			
			
				  
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				
				
				
				<tr><td>
				  
				 <table>
				 <tr>
			<td width="60px;"></td>
			
			<td > <table width="500px" cellpadding="0" cellspacing="0"  style=" width:500px; overflow:hidden;" class="ebord">
				<tr>
				<th width="250px" align="right">Name:</th>
				<td>'.$fodata->name.'</td>
				</tr>
				
				 <tr>
			 <th width="250px" align="right">Company Name:</th>
				<td>'.$fodata->cname.'</td>
				</tr>
				
				 <tr>
			  <th width="250px" align="right">Email:</th>
				<td>'.$fodata->email.'</td>
				</tr>
				
				 <tr>
				<th width="250px" align="right">Phone:</th>
				<td>'.$fodata->phone.'</td>
				</tr>
				
				  <tr>
				<th width="250px" align="right">Best Time To Reach You:</th>
				<td><table>
			
			
			
			
			
			
				<tr><td><strong>Day of Week</strong><br/>'.$fodata->week.'</td> <td><strong>Time of Day</strong><br />'.$fodata->day.'</td></tr>
				
				</table></td>
				</tr>
				
				
				
				  <tr>
				<th width="250px" align="right">Comments:</th>
				<td>'.$fodata->comments.'</td>
				</tr>
				
				
				</table></td>
			</tr>
				 </table> 
			
			
			
			
			
			
				 
				</td>
				</tr>
				 <tr><td>&nbsp;</td></tr>
				 <tr> <td align="left" valign="top" style="padding:15px 15px 0px 15px!important;">
			
			<table><tr>
			<td width="60px;"></td>
			<td ><p style="font-size:15px; color:#333;  padding-top:0px;">Regards,<br/>
			
			Freedom Bank of Virginia </p></td>
			</tr>
			</table>
			
			
			
				 
			</td></tr>
			 <tr><td>&nbsp;</td></tr>
				<tr>
				   <td aling="center" bgcolor="#cca147" width="650px" height="5px"></td>
				</tr>
			  </table>
			  
			</div>
			
			
			</body>
			</html>
			';


			
			



		
		// $usermsg = '<div>Hello,<br><br>

		// 		Thank you for contacting Freedom Bank. We appreciate your interest. <br>

		// 		One of our team members will reach out to you in the next 24 to 48 hours, if not sooner. <br>

		// 		We look forward to connecting!”<br><br> 

		// 		Regards,<br>
		// 		Freedom Bank of Virginia
		// 		</div>';	
		
		
			
		// $clientmsg = '<html>
		// 	<head>
		// 			<style> .bord td{ border:1px #ccc solid;} .bord th{ border:1px #ccc solid;}</style>
		// 	</head>
		// 	<body>
		// 	<table style="width:100%;border:3px solid #363636;border-bottom:0px;">
		// 		<tr style="background-color: #002F47;">
		// 			<td>
		// 			<center><img src="'.base_url().'admin/assets/images/logo.jpg" width="40%"/></center>
		// 			</td>
		// 		</tr>
		// 		<tr>
		// 			<td style="padding:10px;font-family: sans-serif;text-align:center">
		// 	Please find below New Website Enquiry details for '.$pid->page_name.'<br><br>
		// 	</td>
		// 	</tr>
			
		// 	</table>
			
		// 	<table style="width:100%; border:3px solid #363636;border-top:0px;" class="bord">
		// 	<tr>
        //            <th align="right">Name:</th>
                   
		// 		   <td align="left">'.$fodata->name.'</td>
		// 		   <td>&nbsp;</td>
		// 		   <td>&nbsp;</td>
        //         </tr>
		// 		<tr>
        //            <th align="right">Company:</th>
                   
		// 		   <td>'.$fodata->cname.'</td>
		// 		   <td>&nbsp;</td>
		// 		   <td>&nbsp;</td>
        //         </tr>
		// 		<tr>
        //            <th align="right">Email:</th>
                   
		// 		   <td align="left">'.$fodata->email.'</td>
		// 		   <td>&nbsp;</td>
		// 		   <td>&nbsp;</td>
        //         </tr>
		// 		<tr>
        //            <th align="right">Phone:</th>
                   
		// 		   <td align="left">'.$fodata->phone.'</td>
		// 		   <td>&nbsp;</td>
		// 		   <td>&nbsp;</td>
        //         </tr>
		// 		<tr>
        //            <th colspan="4">Best time to reach you:</th>
		// 		</tr>
		// 		   <tr>
        //            <th align="right">Day of Week:</th>
        //            <td align="left">'.$fodata->week.'</td>
				   
		// 		   <th align="right">Time of Day:</th>
        //            <td align="left">'.$fodata->day.'</td>
        //         </tr>
		// 		<tr>
        //            <th align="right">Comments:</th>
                   
		// 		   <td align="left">'.$fodata->comments.'</td>
		// 		   <td>&nbsp;</td>
		// 		   <td>&nbsp;</td>

        //         </tr>
		// 	</table>
			
		// 				<br>	
		// 		<div>
		// 			Regards,<br>
		// 				Freedom Bank of Virginia
		// 		</div>
		// 	</body>
		// 	</html>';	
			
			
			
//		$clientmsg = '<html>
//			<head>
//
//			</head>
//			<body>
//			<table>
//				<tr>
//					<td>
//					Hello,	<br><br>
//					 
//					  Please find below New Website Enquiry details for ('.$pid->page_name.')
//
//					</td>
//				</tr>
//				
//			
//			</table>
//			<br>
//			<table>
//				<tr>
//                   <th>Name:</th>
//                   <td>&nbsp;</td>
//                   <td>'.$fodata->name.'</td>
//                </tr>
//				<tr>
//                   <th>Company:</th>
//                   <td>&nbsp;</td>
//                   <td>'.$fodata->cname.'</td>
//                </tr>
//				<tr>
//                   <th>Email:</th>
//                   <td>&nbsp;</td>
//                   <td>'.$fodata->email.'</td>
//                </tr>
//				<tr>
//                   <th>Phone:</th>
//                   <td>&nbsp;</td>
//                   <td>'.$fodata->phone.'</td>
//                </tr>
//				<tr>
//                   <th>Best time to reach you:</th>
//                   <th>Day of Week:</th>
//                   <td>'.$fodata->week.'</td>
//				   
//				   <th>Day of Week:</th>
//                   <td>'.$fodata->day.'</td>
//                </tr>
//				<tr>
//                   <th>Comments:</th>
//                   <td>&nbsp;</td>
//                   <td>'.$fodata->comments.'</td>
//                </tr>
//				
//
//			</table>
//			<br>	
//				<div>
//					Regards,<br>
//						Freedom Bank of Virginia
//				</div>
//				
//			</body>
//			</html>';
//		
		}
		
		foreach($cmail->email as $key => $cm){
			
		    $from = new SendGrid\Email("Freedom Bank", "info@freedombankva.com");
			$subject = "Website Enquiry for $pid->page_name";
			$to = new SendGrid\Email("Freedom Bank",$cm);

			$content = new SendGrid\Content("text/html",$clientmsg);
			$mail = new SendGrid\Mail($from, $subject, $to, $content);
			$sg = new \SendGrid('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');
			$response = $sg->client->mail()->send()->post($mail);

			
		}
		
			$ufrom = new SendGrid\Email("Freedom Bank", "info@freedombankva.com");
			$usubject = "Freedom Bank: Thank you for your Enquiry";
			$uto = new SendGrid\Email("Freedom Bank",$fodata->email);

			$ucontent = new SendGrid\Content("text/html",$usermsg);
			$umail = new SendGrid\Mail($ufrom, $usubject, $uto, $ucontent);
			$usg = new \SendGrid('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');
			$uresponse = $usg->client->mail()->send()->post($umail);
		
		echo 1;
		exit();
		
	}else{
		
		echo 0;
		exit();
		
	}
	
	
	
} 	
	
	
	
	
//public function urrl($route){
//	
//	$r1 = $this->uri->segment(3);
//	$r2 = $this->uri->segment(4);
//	$r3 = $this->uri->segment(5);
//	
//	
//	$rr = array();
//		$rr[] = $r1;
//		$rr[] = $r2;
//		$rr[] = $r3;
//	if($r1 && $r2 && $r3){
//		
//		$route = (implode("/",$rr));
//	
//	}elseif($r1 && $r2){
//		
//		$route = (implode("/",$rr));
//		
//	}else{
//		
//		$route = $r1;
//	}
//	
//		$d = $this->db->get_where("pages",array("route"=>$route))->row();
//		
//		if($d->route == $route){
//			
//			
//		}else{
//			
//			
//		}
//}	




}