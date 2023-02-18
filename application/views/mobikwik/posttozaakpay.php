<?php
/*
Template Name: PostToZaakpayPage
*/
?>
<?php include('checksum.php'); ?>
<?php
	//enter your secret key here
	/*$secret = '0678056d96914a8583fb518caf42828a';*/
	$payment_gateway_credentials = json_decode($this->admin->get_option("payment_gateway"));
	$secret = $payment_gateway_credentials->secret_key;

	$all = Checksum::getAllParams();

	$checksum = Checksum::calculateChecksum($secret, $all);
	
?>
<center>
<table width="500px;">
	<tr>
		<td align="center" valign="middle">Do Not Refresh or Press Back <br/> Redirecting to Zaakpay</td>
	</tr>
	<tr>
		<td align="center" valign="middle">
			<form action="https://api.zaakpay.com/api/paymentTransact/V8" method="post">
				<?php
				Checksum::outputForm($checksum);
				?>
			</form>
		</td>

	</tr>

</table>

</center>
<script type="text/javascript">
var form = document.forms[0];
form.submit();
</script>
