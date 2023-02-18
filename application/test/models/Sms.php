<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Sms extends CI_Model{
	
	
	
	public function __construct(){
		
		parent::__construct();

		
	}

	public function send_sms($mobile,$message){

		
		$mob = urlencode($mobile);
		$mes = urlencode($message);	
		$sms=fopen("http://www.bulksmsapps.com/api/apismsv2.aspx?apikey=1a155645-2cb8-4fdf-9ef3-c4a84aa904d6&sender=SMMPCL&number=$mob&message=$mes",'r');
		$response = stream_get_contents($sms);
		if(empty ($response))
		{
			//echo " buffer is empty "; 
			log_message("info","buffer is empty");
		}
		else
		{
//			echo $response;
			log_message("info",$response);
		}


			log_message("info",$mobile);
			log_message("info",$message);

	}


	
}