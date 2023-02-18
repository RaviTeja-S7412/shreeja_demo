<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Notifications_api extends CI_Controller {
	
	public function __construct(){

		parent::__construct();


	}
	
	public function sendNotification(){
		
		
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

					}
					
				}	
				
			}
			
		}
		
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
					
					
					$nmsg = "Dear $nudata->user_name your subscription is going to expire on $exDate Kindly renew you order. Please ignore if already done.";
					
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
		
		
	}
	
	public function newlyRegisteredusers(){
		
		$pdate = date("Y-m-d");		
		
		$users = $this->db->get_where("shreeja_users",array("steps_completed"=>4,"user_status"=>0))->result();
		
		foreach($users as $so){
			
			$ordChk = $this->db->get_where("orders",array("payment_status"=>"Success","user_id"=>$so->userid))->num_rows();
			
//			$expendDate = date('Y-m-d',(strtotime ( '+7 days' , strtotime ( $so->user_created) ) ));
//				
//			 $st = date("Y-m-d",strtotime("+1 day",strtotime($so->user_created)));
//
//			 $expbegin = new DateTime( $expendDate );
//			 $expend   = new DateTime( $st );
//
//
//				$ddate1 = array();
//
//				for($i = $expend; $i <=$expbegin ; $i->modify('+1 day')){

//					if(($pdate) == ($i->format("Y-m-d")) && count($ordChk) == 0){
					if(count($ordChk) == 0){
						
						$nmsg = "Dear $so->user_name kindly avail discounts and gifts by subscribing our milk";
						$token = $so->firebase_token;

						$nmessage = array(
							"title" =>"Order products",
							"message" => $nmsg,
	//						"imageUrl" => base_url().$u->image,
							"redirect_to" => "products",

						);

						$this->admin->firebase_notification_subscribe($token,$nmessage);
						
					}
//					
////					$ddate1[] =  $i->format("Y-m-d")."<br>";
//				}

//			echo '<pre>';
//			print_r($ddate1);
			
		}
		
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
	
	public function sample(){
	    
	    $token = "dWl4iWCzN9Q:APA91bFUP_vSibd4juD6Q4NEX7HWarTNEDXjKNhoVLrmbZP7W-vav4GnLMKi5R2UcxA31JcmCjST6lzx9IQAVb4-YdKMu02GfEjBS2eu07lyERTZdRROTjtCZu1himY3M0r4LMYyhr1E";
	 
    	$nmessage = array(
    		"title" =>"Order products",
    		"message" => "hello",
    		"imageUrl" => base_url(),
    		"redirect_to" => "products",
    
    	);
    
    echo	$this->admin->firebase_notification_subscribe($token,$nmessage);
	    
	}
	
	public function test(){
	    
	    echo $this->admin->gst_total(1,12);
	    
	}
}