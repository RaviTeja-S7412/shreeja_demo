<?php 
error_reporting(E_ERROR | E_PARSE);
ob_clean();

require_once(APPPATH.'libraries/mpdf/mpdf.php');
//date_default_timezone_set('Asia/Kolkata');

if(json_decode($o->user_data)){
											   
	   $udata = json_decode($o->user_data);

   }else{

	  $udata = $this->db->get_where("shreeja_users",array("userid"=>$o->user_id,"user_status"=>0))->row();	   

   }
   
$loc_data = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location))->row();   
$opdata = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result(); 

$disAmountt = ($o->discount_amount != 0) ? $o->discount_amount : 0;

$inDate = isset($o->order_date) ? $o->order_date : $o->date_of_order;
$totalAmount = isset($o->total_amount) ? ($o->total_amount) : 0;


$totalWords = ($this->admin->getNumberinwords($totalAmount) != "") ? ($this->admin->getNumberinwords($totalAmount)) : "zero rupees";	

define('_MPDF_TTFONTPATH', __DIR__ . '/fonts');

$mpdf = new \mPDF('UTF-8', 'A4',30, 'dejavuserif');


$html = '<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	
<style type="text/css">

*
{
	margin: 0px;
	padding: 0px;
	font-family: hind-medium;
	font-size: 10px;
}

.container
{
	width:100%;
	height:auto;
	margin:auto;
	font-size: 12px;
}
h3
{
	text-align: center;
	text-decoration: underline;
	padding: 2px;
	letter-spacing: 0.5px;
	margin-top:50px;
	
}
.top-details
{
	display: flex;
	margin-top:20px;
	
}
.supplier
{
	width:50%;
	height: auto;
	float:left;
	
}
.supplier ul li
{
	list-style: none;
	
}
.supplier p
{
	font-weight: bold;
	letter-spacing: 0.5px;
	
}
.supplier span
{
	font-weight: bold;
	
}
.details
{
	width:50%;
	height: auto;
	float:right;
	
	
}
.details p
{
	text-align: right;
	font-weight: bold;
	letter-spacing: 0.5px;
	
}
.details ul li
{
	list-style: none;
	text-align: right;
}
.billing 
{
	margin-top:50px;
	
}
.nmbr
{
	font-weight: bold;
	
}
.billing ul li
{
	list-style: none;
	
}
.billing p
{
	font-weight: bold;
	letter-spacing: 0.5px;
	
}
table
{
	margin: auto;
	margin-top:10px;
	border-collapse: collapse;
	margin-top: 20px;
	width:100%;
	font-size: 12px;
}
td, th {
	text-align: center;
	padding: 2px;
	border:1px solid black;
	
  }
.total li
{
	list-style: none;
	padding-top: 20px;
	font-weight: bold;
	word-spacing: 2px;
	
}
.footer li
{
	list-style: none;
	color: #969696;
	padding-top: 20px;
	
}

</style>
	
	
</head>
<body>
		<div class="container">
		
			<img src="assets/Logo-shreeja.png" style="width:25%">
		
			<h3 style="font-size:20px;">Invoice</h3>
			<div class="top-details">
					<div class="supplier">
							<p>Details of the supplier:</p>
						    <p style="font-weight: normal;">'.nl2br($loc_data->address).'<br>
						        GST Number: <span style="font-weight: bold;">'.$loc_data->gst_number.'</span><br>
						        PAN Number: <span style="font-weight: bold;">'.$loc_data->pan_number.'</span><br>
						    </p>
					</div>
		
					<div class="details">
						<p>Invoice Details:</p>
						<ul>
							<li>Invoice Number: '.$o->invoice_number.'</li>
							<li>Invoice Date: '.date("d-m-Y",strtotime($inDate)).'</li>
						</ul>
					</div>
			</div>

			<div class="billing">
					<p>Billing/Shipping Address:</p>
					<ul>
							<li>'.$udata->user_name.'</li>
							<li>'.nl2br($o->shipping_address).'</li>
							<li>GST Number: <span class="nmbr"></span> </li>
							<li>PAN: <span class="nmbr"></span> </li>
							<li>Mobile: <span class="nmbr">'.$udata->user_mobile.'</span> </li>
						</ul>
			</div>

				<table>

					<tr>
						<th>S. No</th>
						<th>Product</th>
						<th>HSN Code</th>
						<th>Rate</th>
						<th>UOM</th>
						<th>Qty.</th>
						<th>Product Value</th>
						<th>SGST %</th>
						<th>CGST %</th>
						<th>IGST %</th>
					</tr>';
?>


 <?php 


$fsOrder = ($o->order_type == "freesample") ? "true" : "false";

if($fsOrder == "false"){
	
  $i=1;	
  foreach($opdata as $op){
      
      $oref = "";
	  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row();
	  
	  $gst = $op->gst/2 ;
	  $gst1 = ($o->order_type == "subscribe") ? $op->gst*30 : $op->gst;	  
		  
		  
	  $orderTypeamt = ($o->order_type == "subscribe") ? $op->qty * 30 : $op->qty;
	  
	  $totalPrice = ($o->order_type == "subscribe") ? $op->qty*30 : $op->qty;
	  $stotalPrice = ($o->order_type == "subscribe") ? $op->price*$op->qty*30 : $op->price*$op->qty;
	  
	 
        $iData = json_decode($this->products_model->getinvoiceData($o->order_id));
        
        $orderType = ($o->order_type == "subscribe") ? 30 : 1;
        
        
        
        $tgst = $iData->twelve/2 * $orderType;
        $egst = $iData->eighteen/2 * $orderType;
        $fgst = $iData->five/2 * $orderType;
        
        $five = ($iData->tfive * $orderType) + ($iData->five * $orderType);
        $twelve = ($iData->ttwelve * $orderType) + ($iData->twelve * $orderType);
        $eighteen = ($iData->teighteen * $orderType) + ($iData->eighteen * $orderType); 
	  
	  
	  if($op->gst != 0){
	      
	        $gstCharges = $this->admin->gst_total($totalPrice,$gst1);	  
	        $sgstCharges = $this->admin->gst_total($op->price,$op->gst);	  
	        
	        $oPrice = $op->price -$sgstCharges;
	        
	        if($iData->five != 0){
	            
	            $tPrice = $iData->tfive * $orderType;
	            
	        }
	        
	        if($iData->twelve != 0){
	            
	            $tPrice = $iData->ttwelve * $orderType;
	            
	        }

	        if($iData->eighteen != 0){
	            
	            $tPrice = $iData->teighteen * $orderType;
	            
	        }
	      
	  }else{
	      
	        $tPrice = $stotalPrice;
	        $oPrice = $op->price;
	      
	  }
	  
	  	  
	  $tQty = ($op->orderRef == "offer") ? $op->qty : $orderTypeamt;
	  
	  $tPrice = ($op->orderRef == "offer") ? 0 : $tPrice;
	  $gst = ($op->orderRef == "offer") ? 0 : $gst;
	  $oref = ($op->orderRef == "offer") ? '(Free)' : '';
	  	  
?> 
   
 <?php $html .=  '<tr>';  ?>
 <?php $html .=  '<td>'.$i.'</td>'; ?>
 <?php $html .=  '<td> '.$pdata->product_name.' '.$op->category.' '.$oref.'</td>'; ?>
 <?php $html .=  '<td>'.$pdata->hsn_code.'</td>'; ?>
 <?php $html .=  '<td>'.$oPrice.'</td>'; ?>
 <?php $html .=  '<td>EA</td>'; ?>
 <?php $html .=  '<td>'.$tQty.'</td>'; ?>
 <?php $html .=  '<td>'.$tPrice.'</td>'; ?>
 <?php $html .=  '<td>'.$gst.'</td>'; ?>
 <?php $html .=  '<td>'.$gst.'</td>'; ?>
 <?php $html .=  '<td></td>'; ?>
 <?php $html .=  '</tr>';  ?>
    
    
  <?php  
		$i++;
		}}

else{

	$pdata = $this->db->get_where("tbl_products",array("id"=>$o->product_id))->row();


?> 
	<?php $html .=  '<tr>';  ?>
 <?php $html .=  '<td>1</td>'; ?>
 <?php $html .=  '<td> '.$pdata->product_name.' '.$o->qty.'</td>'; ?>
 <?php $html .=  '<td>'.$pdata->hsn_code.'</td>'; ?>
 <?php $html .=  '<td>0.00</td>'; ?>
 <?php $html .=  '<td>EA</td>'; ?>
 <?php $html .=  '<td>1</td>'; ?>
 <?php $html .=  '<td>0.00</td>'; ?>
 <?php $html .=  '<td></td>'; ?>
 <?php $html .=  '<td></td>'; ?>
 <?php $html .=  '<td></td>'; ?>
 <?php $html .=  '</tr>';  ?>	
		
		
		
		
			
<?php }	$html .=	'</table>


				<table>

					<tr>
						<th>Tax rate</th>
						<th>Product value</th>
						<th>SGST Amount</th>
						<th>CGST Amount</th>
						<th>IGST Amount</th>
						<th>Total Amount in Rs</th>
					</tr>';
?>
				
<?php



$html .=			'<tr>
							<td>0%</td>
							<td>'.$iData->zero * $orderType.'</td>
							<td></td>
							<td></td>
							<td></td>
							<td>'.$iData->zero * $orderType.'</td>
					</tr>';
if($iData->five != 0){
					
$html .=				'<tr>
							<td>5%</td>
							<td>'.$iData->tfive * $orderType.'</td>
							<td>'.$fgst.'</td>
							<td>'.$fgst.'</td>
							<td></td>
							<td>'.$five.'</td>
					</tr>';
}

if($iData->twelve != 0){
					
$html .=
					'<tr>
							<td>12%</td>
							<td>'.$iData->ttwelve * $orderType.'</td>
							<td>'.$tgst.'</td>
							<td>'.$tgst.'</td>
							<td></td>
							<td>'.$twelve.'</td>
					</tr>';

}

if($iData->eighteen != 0){
					
$html .=

					'<tr>
							<td>18%</td>
							<td>'.$iData->teighteen * $orderType.'</td>
							<td>'.$egst.'</td>
							<td>'.$egst.'</td>
							<td></td>
							<td>'.$eighteen.'</td>
					</tr>';

}

if($o->discount_amount != 0){
					
$html .=
					'<tr>
							<td>Discount</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>'.$o->discount_amount.'</td>
					</tr>';
	
}

if($o->deliveryCharges != 0){
					
$html .=
					'<tr>
							<td>Delivery Charges</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>'.$o->deliveryCharges.'</td>
					</tr>';
	
}
$html .=			'<tr>
							<td colspan="5">Total</td>
							<td style="font-weight: bold;">'.$totalAmount.'</td>
					</tr>

				</table>
				<div class="total"><li>Total Invoice value: '.$totalWords.' </li></div>

				<div class="footer"><li>*Invoice is generated electronically hence does not require signature.</li></div>
		</div>
</body>
</html>';


//echo $html;
	$mpdf->WriteHTML($html);
	$mpdf->Output($o->order_id.".pdf","I");

// 	$mpdf->Output("","I");

exit;
?>
