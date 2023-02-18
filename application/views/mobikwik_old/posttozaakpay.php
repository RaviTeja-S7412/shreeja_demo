<?php
/*
Template Name: PostToZaakpayPage
*/
?>
<?php include('checksum.php'); ?>
<?php
	//enter your secret key here
	$secret = '0678056d96914a8583fb518caf42828a';

	$all = 'amount=100&buyerAddress=santhosh nagar&buyerCity=hyderabad&buyerCountry=India&buyerEmail=sakaraviteja.s@gmail.com&buyerFirstName=jhdfvjhv&buyerLastName=jbkdhv&buyerPhoneNumber=07416232629&buyerPincode=500072&buyerState=Telangana&currency=INR&merchantIdentifier=b19e8f103bce406cbd3476431b6b7973&merchantIpAddress=127.0.0.1&mode=0&orderId=ORD85748574&productDescription=Zaakpay subscription fee&purpose=1&returnUrl=http://nadsoltechnolabs.com/shreeja/mobikwik/response&txnDate=2019-3-26&txnType=1&zpPayOption=1&';
	//$all = Checksum::getAllParams();
	$checksum = Checksum::calculateChecksum($secret, $all);
	//print_r($checksum); exit();
?>
<center>
<table width="500px;">
	<tr>
		<td align="center" valign="middle">Do Not Refresh or Press Back <br/> Redirecting to Zaakpay</td>
	</tr>
	<tr>
		<td align="center" valign="middle">
			<form action="https://zaakstaging.zaakpay.com/api/paymentTransact/V8" method="post">
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
