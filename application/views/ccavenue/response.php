<? 
include("Api.php");
$ccavenue_api = new CCAvenue_API();

//Get pendingorders list
$pendingorders = array('reference_no' =>"111723714423","order_no"=>"ORD193000012040");

$response=$ccavenue_api->orderStatusTracker($pendingorders);

print_r($response);

?>