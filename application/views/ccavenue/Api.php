<?php
error_reporting(0);

class CCAvenue_API {


 	/**
     * Execute api call in CCAvenue
     *
     * @return metting detials as xml
     */

 	// Provide working key share by CCAvenues

	private $working_key = '3827A52CEA61B0DDC2C73E46C5EC1C20';

	// Provide access code Shared by CCAVENUES

	private $access_code = 'AVBI09IE19BN38IBNB';
	
	//Version Number
	private $version = '1.1';

	private $URL="https://api.ccavenue.com/apis/servlet/DoWebTrans";

	public function api_call($final_data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$final_data);

		// Get server response ... curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec ($ch);
		curl_close ($ch);

		$information=explode('&',$result);
		$dataSize=sizeof($information);
		$status1=explode('=',$information[0]);
		$status2=explode('=',$information[1]);
		$status3=explode('=',$information[2]);
		
		if($status1[1] == '1'){
			$recorddata=$status2[1];
			return $recorddata." Error Code:".$status3[1];
		}
		else
		{
			$status=self::decrypt($status2[1],$this->working_key);
			print_r($status2[1]);
			return $status;
		}
	}

	public function orderStatusTracker($post_data)
	{
		/*
			function for get order status
		*/
		$merchant_data = json_encode($post_data);

		/*
			sample $post_data after json encode
			{
			   "reference_no": "225013271813",
			   "order_no": "33231644"
			}
		*/

		// Encrypt merchant data with working key shared by ccavenue

		$encrypted_data = self::encrypt($merchant_data, $this->working_key);

		//make final request string for the API call
        $command="orderStatusTracker";
		$final_data ="request_type=JSON&access_code=".$this->access_code."&command=".$command."&response_type=JSON&version=".$this->version."&enc_request=".$encrypted_data;
		$result = $this->api_call($final_data);
		return $result;
	}

	public function getPendingOrders($post_data)
	{
		/*
			function for get pending orders
		*/
		$merchant_data = json_encode($post_data);

		// Encrypt merchant data with working key shared by ccavenue

		$encrypted_data = self::encrypt($merchant_data, $this->working_key);

		//make final request string for the API call
        $command="getPendingOrders";
		$final_data ="request_type=JSON&access_code=".$this->access_code."&command=".$command."&response_type=JSON&version=".$this->version."&enc_request=".$encrypted_data;
		$result = self::api_call($final_data);
		return $result;
	}

	public function confirmOrder($post_data)
	{
		/*
			function for confimorder
		*/
		$merchant_data = json_encode($post_data);

		/*
			sample $post_data after json encode
			{
		   		"order_List": [
		      { "reference_no":"203000099429", "amount": "1.00"},
		      { "reference_no": "203000104640", "amount": "1.00"}
		   		]
			}
		*/

		// Encrypt merchant data with working key shared by ccavenue

		$encrypted_data = self::encrypt($merchant_data, $this->working_key);

		//make final request string for the API call
        $command="confirmOrder";
		$final_data ="request_type=JSON&access_code=".$this->access_code."&command=".$command."&response_type=JSON&version=".$this->version."&enc_request=".$encrypted_data;
		$result = self::api_call($final_data);

		return $result;

	}

	public function refundOrder($post_data)
	{
		/*
			function for refund
		*/
		$merchant_data = json_encode($post_data);

		/* sample $post_data after json encode
			{
   				"reference_no":"1236547",
   				"refund_amount":"1.0",
   				"refund_ref_no":"API1234"
			}
		*/

		// Encrypt merchant data with working key shared by ccavenue

		$encrypted_data = self::encrypt($merchant_data, $this->working_key);

		//make final request string for the API call
        $command="refundOrder";
		$final_data ="request_type=JSON&access_code=".$this->access_code."&command=".$command."&response_type=JSON&version=".$this->version."&enc_request=".$encrypted_data;
		$result = self::api_call($final_data);

		return $result;
	}

	public function cancelOrder($post_data)
	{
		/*
			function for cancelOrder
		*/

		$merchant_data = json_encode($post_data);

		/* sample $post_data after json encode
			{
			   "order_List": [
			      {"reference_no":"203000099429","amount": "1.00" },
			      {"reference_no":"203000099429","amount": "1.00" }
			   ]
			}
		*/

		// Encrypt merchant data with working key shared by ccavenue

		$encrypted_data = self::encrypt($merchant_data, $this->working_key);

		//make final request string for the API call
        $command="cancelOrder";
		$final_data ="request_type=JSON&access_code=".$this->access_code."&command=".$command."&response_type=JSON&version=".$this->version."&enc_request=".$encrypted_data;
		$result = self::api_call($final_data);

		return $result;
	}

	function encrypt($plainText,$key)
    {
        $encryptionMethod = "AES-128-CBC";
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = openssl_encrypt($plainText, $encryptionMethod, $secretKey, OPENSSL_RAW_DATA, $initVector);
        return bin2hex($encryptedText);
    }

    function decrypt($encryptedText,$key)
    {
        $encryptionMethod     = "AES-128-CBC";
        $secretKey         = $this->hextobin(md5($key));
        $initVector         =  pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText      = $this->hextobin($encryptedText);
        $decryptedText         =  openssl_decrypt($encryptedText, $encryptionMethod, $secretKey, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }

    function pkcs5_pad ($plainText, $blockSize)
    {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

    function hextobin($hexString) 
    { 
        $length = strlen($hexString); 
        $binString="";   
        $count=0; 
        while($count<$length) 
        {       
            $subString =substr($hexString,$count,2);           
            $packedString = pack("H*",$subString); 
            if ($count==0)
            {
                $binString=$packedString;
            } 
                
            else 
            {
                $binString.=$packedString;
            } 
                
            $count+=2; 
        } 
        return $binString; 
    }

}
?>