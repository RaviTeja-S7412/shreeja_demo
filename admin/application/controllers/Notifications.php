<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Notifications extends CI_Controller {
	
	public function __construct(){

		parent::__construct();


	}
	
	public function index(){
		
		/*$data = $this->db->get_where("tbl_notifications")->result();
		
		foreach($data as $d){
			
			$this->db->where(["id"=>$d->id])->update("tbl_notifications",["sdate"=>date("Y-m-d",strtotime($d->start_date)),"edate"=>date("Y-m-d",strtotime($d->end_date))]);
			
		}
		
		exit();
		*/
		$this->load->view("notifications/allnotifications");
		
	}

	public function create(){
		
		$this->load->view("notifications/createNotification");
		
	}
	public function update($id){
		
		$data["nn"] = $this->db->get_where("tbl_notifications",array("id"=>$id))->row();
		$this->load->view("notifications/createNotification",$data);
		
	}
	
	public function sendNotifications(){
		
		$this->load->view("notifications/sendNotifications");
		
	}
	
	public function insertNotification(){
		
		$notType = $this->input->post("notType");
		$sendType = $this->input->post("sendType");
		$route = $this->input->post("route");
		$notTitle = $this->input->post("notTitle");
		$notMessage = $this->input->post("notMessage");
		$startDate = $this->input->post("startDate");
		$endDate = $this->input->post("endDate");
		$notType = $this->input->post("notType");
		$city = $this->input->post("city");
		
//		$uTokens = $this->db->select("userid,firebase_token")->get_where("shreeja_users",array("user_status"=>0,"steps_completed"=>4,"firebase_token !="=>""))->result();

//		if(count($uTokens) > 0){
//			
//			$tokens = array();
//			$userids = array();
			
//			foreach($uTokens as $u){
//				
//				$tokens[] = $u->firebase_token;
//				$userids[] = $u->userid;
//				
//			}
			
			if($_FILES['notIcon']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/notifications/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
//                $config['encrypt_name']             = TRUE;
//			    $config['max_width']            = 450;
//				$config['max_height']           = 80;		
				$this->load->library('upload', $config);

				$dd=$this->upload->do_upload("notIcon");

					if($dd){  
						$d=$this->upload->data();

						$nimage = "uploads/notifications/".$d['file_name'];

					}else{
						$this->alert->pnotify("error","Please Select Valid Image","error");
						redirect("notifications/create");
					}
				}else{


					$nimage="";

				}
			
			$ndata = array(
			
				"notification_type" => $notType,
//				"user_tokens" => json_encode($tokens),
				"message" => $notMessage,
				"title" => $notTitle,
				"start_date" => $startDate,
				"end_date" => $endDate,
				"sdate" => date("Y-m-d",strtotime($startDate)),
				"edate" => date("Y-m-d",strtotime($endDate)),
				"sendType" => $sendType,
				"route" => $route,
				"image" => $nimage,
				"city" => $city
			
			);
			
			$ni = $this->db->insert("tbl_notifications",$ndata);
			
			if($ni){
				
				$this->alert->pnotify("success","Notification successfully added","success");
				redirect("notifications");
				
			}else{
				
				$this->alert->pnotify("error","Error Occured","error");
				redirect("notifications/create");
				
			}
			
			
//		}else{
//			
//			$this->alert->pnotify("error","Error Occured","error");
//			redirect("notifications/create");
//			
//		}
		
		
		
	}
	
	public function updateNotification(){
		
		$id = $this->input->post("id");
		$notType = $this->input->post("notType");
		$sendType = $this->input->post("sendType");
		$route = $this->input->post("route");
		$notTitle = $this->input->post("notTitle");
		$notMessage = $this->input->post("notMessage");
		$startDate = $this->input->post("startDate");
		$endDate = $this->input->post("endDate");
		$notType = $this->input->post("notType");
		$city = $this->input->post("city");
		
		$nd = $this->db->get_where("tbl_notifications",array("id"=>$id))->row();
		
//		$uTokens = $this->db->select("userid,firebase_token")->get_where("shreeja_users",array("user_status"=>0,"steps_completed"=>4,"firebase_token !="=>""))->result();

//		if(count($uTokens) > 0){
//			
//			$tokens = array();
//			$userids = array();
			
//			foreach($uTokens as $u){
//				
//				$tokens[] = $u->firebase_token;
//				$userids[] = $u->userid;
//				
//			}
			
			if($_FILES['notIcon']['size']!='0'){
			//profile pic uploading
		  		$config['upload_path']          = "uploads/notifications/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
//                $config['encrypt_name']             = TRUE;
//			    $config['max_width']            = 450;
//				$config['max_height']           = 80;		
				$this->load->library('upload', $config);

				$dd=$this->upload->do_upload("notIcon");

					if($dd){  
						$d=$this->upload->data();

						$nimage = "uploads/notifications/".$d['file_name'];

					}else{
						$this->alert->pnotify("error","Please Select Valid Image","error");
						redirect("notifications/create");
					}
				}else{


					$nimage= $nd->image;

				}
			
			$ndata = array(
			
				"notification_type" => $notType,
//				"user_tokens" => json_encode($tokens),
				"message" => $notMessage,
				"title" => $notTitle,
				"start_date" => $startDate,
				"end_date" => $endDate,
				"sdate" => date("Y-m-d",strtotime($startDate)),
				"edate" => date("Y-m-d",strtotime($endDate)),
				"sendType" => $sendType,
				"route" => $route,
				"image" => $nimage,
				"city" => $city
			
			);
			
			$ni = $this->db->where("id",$id)->update("tbl_notifications",$ndata);
			
			if($ni){
				
				$this->alert->pnotify("success","Notification successfully updated","success");
				redirect("notifications");
				
			}else{
				
				$this->alert->pnotify("error","Error Occured","error");
				redirect("notifications/update/".$id);
				
			}
			
			
//		}else{
//			
//			$this->alert->pnotify("error","Error Occured","error");
//			redirect("notifications/create");
//			
//		}
		
		
		
	}
	
	public function delNot($id){
		
		$d = $this->db->delete("tbl_notifications",array("id"=>$id));
		
		if($d){
				
			$this->alert->pnotify("success","Notification successfully deleted","success");
			redirect("notifications");

		}else{

			$this->alert->pnotify("error","Error Occured","error");
			redirect("notifications");

		}
		
	}
	
	public function sendNotification(){
		
// 		echo '<pre>';
		
		$pdate = date("Y-m-d");
		
		$uTokens = $this->db->select("userid,firebase_token,user_city")->get_where("shreeja_users",array("user_status"=>0,"steps_completed"=>4,"firebase_token !="=>""))->result();
		
		$nots = $this->db->query("select * from tbl_notifications where '$pdate' BETWEEN sdate AND edate")->result();
		
		$city = [];
		foreach($nots as $nn){
			
			$city[] = $nn->city;
			
		}
		
		
        	$tokens = array();
			$userids = array();
			
			foreach($uTokens as $u){
				
				if(in_array($u->user_city,$city)){
					
					$tokens[] = $u->firebase_token;
					$userids[] = $u->userid;
					
				}
				
			}
				
		if(count($nots) > 0){
			
			foreach($nots as $u){
				
				if($u->sendType == "alternate"){
					
					$pdate = date("Y-m-d");
					
					$aDays = $this->getAlternatedays($u->start_date,$u->end_date); 
					
					if(in_array($pdate,$aDays)){
						
						
						$message = array(
							"title" =>$u->title,
							"message" =>$u->message,
							"imageUrl" => $u->image
						);
						
						foreach($userids as $k1 => $uid){
//					
							$udata = array(

								"user_id" => $uid,
								"message" => $u->message,
								"title" => $u->title,
								"image" => $u->image,
								// "redirect_to" => $u->route

							);

							$this->db->insert("tbl_user_notifications",$udata);
                            $d = $this->admin->firebase_notification_subscribe($tokens[$k1],$message);
                            // print_r($d);
						}
						
						
					}
							
					
				}else{
					
					$message = array(
						"title" =>$u->title,
						"message" =>$u->message,
						"imageUrl" => $u->image,
						"redirect_to" => $u->route
						
					);
					foreach($userids as $k2 => $uid){
//					
						$udata = array(

							"user_id" => $uid,
							"message" => $u->message,
							"title" => $u->title,
							"image" => $u->image,
				// 			"redirect_to" => $u->route

						);

						$this->db->insert("tbl_user_notifications",$udata);
						$d = $this->admin->firebase_notification_subscribe($tokens[$k2],$message);
                        // print_r($d);

					}
					
				}	
				
			}
			
		}
	
	
		$this->alert->pnotify("success","Notification successfully send","success");
		redirect("notifications/sendNotifications");
				
		
	}

	public function subscribtionCheck(){
		
		$pdate = date("Y-m-d");
		
		$expired = array();
		$notexpired = array();
		
		$sOrders = $this->db->get_where("orders",array("payment_status"=>"Success","order_type"=>"subscribe","is_renew"=>"Inactive"))->result();
		
		if(count($sOrders) > 0){
			
			foreach($sOrders as $so){

// Not expired start
				
				$endDate = date('Y-m-d',(strtotime ( '-3 days' , strtotime ( $so->sub_end_date) ) ));
				
				 $begin = new DateTime( $endDate );
				 $end   = new DateTime( $so->sub_end_date );
				
					for($i = $begin; $i <= $end; $i->modify('+1 day')){
							
						if(($pdate) == ($i->format("Y-m-d"))){
							
							$notexpired[] = array("order_id"=>$so->order_id,"user_id"=>$so->user_id,"status"=>"notExpired","endDate"=>date("d-m-Y",strtotime($so->sub_end_date)));
							
						}
						
					}
				

// not expired end
				
// expired starts				
				
				$expendDate = date('Y-m-d',(strtotime ( '+6 days' , strtotime ( $so->sub_end_date) ) ));
				
				 $st = date("Y-m-d",strtotime("+1 day",strtotime($so->sub_end_date)));
				
				 $expbegin = new DateTime( $expendDate );
				 $expend   = new DateTime( $st );
				

					$ddate1 = array();

					for($i = $expend; $i <=$expbegin ; $i->modify('+1 day')){
													
						if(($pdate) == ($i->format("Y-m-d"))){	
							$expired[] = array("order_id"=>$so->order_id,"user_id"=>$so->user_id,"status"=>"expired","endDate"=>date("d-m-Y",strtotime($so->sub_end_date)));
						}
					}
				
// expired end				
				
			}
			
			
		
// 	not expired send firebase notification
			
			if(count($notexpired) > 0){
				
				foreach($notexpired as $val){
					
					$nudata = $this->db->get_where("shreeja_users",array("userid"=>$val["user_id"]))->row();	
					
					$token = $nudata->firebase_token;
					$exDate = $val["endDate"];
					
					
					$nmsg = "Dear $nudata->user_name your subscription will expire on $exDate, Kindly renew you order. Please ignore if already done.";
					
					$udata = array(

						"user_id" => $val["user_id"],
						"message" => $nmsg,
						"title" => "Subscription renewal",
//						"image" => "",

					);

					$this->db->insert("tbl_user_notifications",$udata);
					
					
					
					$nmessage = array(
						"title" =>"Subscription renewal",
						"message" => $nmsg,
						"imageUrl" => "assets/nimages/sub_renewal.jpg",
						"redirect_to" => "orders",
						"order_id" => $val["order_id"],
						"endDate" => $val["endDate"]

					);
					
				    $this->admin->firebase_notification_subscribe($token,$nmessage);
					
				}
				

			}
	
// 	expired send firebase notification
			
			if(count($expired) > 0){
				
				foreach($expired as $val){
				    
					$nudata = $this->db->get_where("shreeja_users",array("userid"=>$val["user_id"]))->row();	
					
					$token = $nudata->firebase_token;
					$exDate = $val["endDate"];
					
					
					$nmsg = "Dear $nudata->user_name your subscription is expired on $exDate Kindly renew you order. Please ignore if already done.";
					
					$udata = array(

						"user_id" => $val["user_id"],
						"message" => $nmsg,
						"title" => "Subscription renewal",
//						"imageUrl" => base_url().$u->image,

					);

					$this->db->insert("tbl_user_notifications",$udata);
					
					
					
					$nmessage = array(
						"title" =>"Subscription renewal",
						"message" => $nmsg,
						"imageUrl" => "assets/nimages/sub_expired.jpg",
						"redirect_to" => "orders",
						"order_id" => $val["order_id"]

					);
					
					$this->admin->firebase_notification_subscribe($token,$nmessage);
					
				}
				

			}			
			
			
		}
		
		$this->alert->pnotify("success","Notification successfully send","success");
		redirect("notifications/sendNotifications");
		
		
	}
	
	public function newlyRegisteredusers(){
		
		$pdate = date("Y-m-d");		
		
		$users = $this->db->get_where("shreeja_users",array("steps_completed"=>4,"user_status"=>0))->result();
		
		
		foreach($users as $so){
		    
			
			$ordChk = $this->db->get_where("orders",array("payment_status"=>"Success","user_id"=>$so->userid))->num_rows();
			
		
			
					if($ordChk == 0){
							
						$token = $so->firebase_token;
						
						$nmsg = "Dear $so->user_name  kindly avail discounts and gifts by subscribing our milk";

						$nmessage = array(
							"title" =>"Order products",
							"message" => $nmsg,
	//						"imageUrl" => base_url().$u->image,
							"redirect_to" => "products",

						);

						$d = $this->admin->firebase_notification_subscribe($token,$nmessage);
				// 		print_r($d);
					}
//					
////					$ddate1[] =  $i->format("Y-m-d")."<br>";
//				}

//			echo '<pre>';
//			print_r($ddate1);
			
		}
		
		$this->alert->pnotify("success","Notification successfully send","success");
		redirect("notifications/sendNotifications");
		
	}
	
	public function sendAppupdate(){
		
		$pdate = date("Y-m-d");		
		
		$users = $this->db->get_where("shreeja_users",array("steps_completed"=>4,"user_status"=>0))->result();
		
		
		foreach($users as $so){
		    	
			$token = $so->firebase_token;

			$nmsg = "Dear $so->user_name please update Shreeja Milk application from play store to get latest features * SHREEJA MILK *";

			$nmessage = array(
				"title" =>"App Update",
				"message" => $nmsg,
//						"imageUrl" => base_url().$u->image,
				"redirect_to" => "appupdate",

			);

			$d = $this->admin->firebase_notification_subscribe($token,$nmessage);
	 		// print_r($d);

		}
		
		$this->alert->pnotify("success","Notification successfully send","success");
		redirect("notifications/sendNotifications");
		
	}
	
	
    public function getAlternatedays($start_date,$end_date){
		
		 $begin = new DateTime( $start_date );
		 $end   = new DateTime( $end_date );

			$ddate = array();

			for($i = $begin; $i <= $end; $i->modify('+1 day')){


				$ddate[] = $i->format("Y-m-d");


			}

			$odd = array();
			$even = array();
			foreach ($ddate as $k => $v) {
				if ($k % 2 == 0) {
					$even[] = $v;
				}
				else {
					$odd[] = $v;
				}
			}
		
		return $even;
		
	}	
	
	
}