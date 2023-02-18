<?php require_once('assets/ccavenue/Crypto.php'); ?>
<?php

	error_reporting(0);
	
	$workingKey='3827A52CEA61B0DDC2C73E46C5EC1C20';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
// 	echo "<center>";

// 	for($i = 0; $i < $dataSize; $i++) 
// 	{
// 		$information=explode('=',$decryptValues[$i]);
// 		if($i==3)	$order_status=$information[1];
// 	}


    $data = [];
    for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
        $data[$information[0]]=$information[1];
	}
	

    log_message('error', json_encode(["data"=>$data]));	
	echo json_encode($data);
	
// 	echo json_encode(["order_status"=>$order_status]);

// 	if($order_status==="Success")
// 	{
// 		echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		
// 	}
// 	else if($order_status==="Aborted")
// 	{
// 		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
// 	}
// 	else if($order_status==="Failure")
// 	{
// 		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
// 	}
// 	else
// 	{
// 		echo "<br>Security Error. Illegal access detected";
	
// 	}

// 	echo "<br><br>";

// 	echo "<table cellspacing=4 cellpadding=4>";
// 	for($i = 0; $i < $dataSize; $i++) 
// 	{
// 		$information=explode('=',$decryptValues[$i]);
// 	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
// 	}

// 	echo "</table><br>";
// 	echo "</center>";
?>
