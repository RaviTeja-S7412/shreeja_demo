<?php include('checksum.php'); ?>

<?php
	$secret = '5e34f8f47d704088b3ade2fd82f20e2f';

	$all = Checksum::getAllParamsCheckandUpdate();
	
	error_log("AllParams:".$all);
	error_log("Secret Key : ".$secret);
	$checksum = Checksum::calculateChecksum($secret, $all);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zaakpay</title>
<script type="text/javascript">
function submitForm(){
			var form = document.forms[0];
			form.submit();
		}
</script>
</head>
<body onload="javascript:submitForm()">
<center>
<table width="500px;">
	<tr>
		<td align="center" valign="middle">Do Not Refresh or Press Back <br/> Redirecting to Zaakpay</td>
	</tr>
	<tr>
		<td align="center" valign="middle">
			<form action="http://zaakpaystaging.centralindia.cloudapp.azure.com:8080/checktransaction?v=5" method="post">
				<?php
				Checksum::outputForm($checksum);
				?>
			</form>
		</td>

	</tr>

</table>

</center>
</body>
</html>
