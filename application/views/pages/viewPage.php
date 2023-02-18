
<?php
//$id = $this->uri->segment(3);
//
//$page = $this->db->get_where("pages",array("id"=>$id))->row();

?>

<link href="<?php echo base_url() ?>/admin/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>/admin/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>


<!doctype html>
<html>
<head>

<style type="text/css">

	<?php echo $page->css ?>
	
</style>


</head>

<body>

	<?php echo $page->html ?>
</body>
</html>


<script type="text/javascript">
	
	
	$(".formdata").on('submit', function(e){
	e.preventDefault();
	var fdata = $(".formdata").serialize();
	var id = <?php echo $page->id ?>;
	var num1 = $("#num1").val();
	var num2 = $("#num2").val();
	var captcha = $("#captcha").val();
		
		
	$.ajax({
	
		
		url:"<?php echo base_url() ?>form/insertForm/"+id,
		data:{num1:num1,num2:num2,captcha:captcha,val:fdata,page_id:id},
		type:"post",
//		dataType:'json',
		success: function(data){
			
		//setTimeout(function(){ location.reload(); }, 500);
			console.log(data);
			
			//return false;
			
			if(data==1){
               Swal(
                 'Success!',
                 'Thanks For Conatacting Us We Will Get Back To You Soon.',
                 'success'
               )
			   setTimeout(function(){ location.reload(); }, 2500);
            }
			if(data==2){
				
				Swal(
                 'Error!',
                 'Entered Captcha Is Wrong.',
                 'warning'
               )
				
			}
			if(data==0){
               Swal(
                 'Error!',
                 'Error Occured.',
                 'warning'
               )
//			   setTimeout(function(){ location.reload(); }, 2500);
            }

		},
		error: function(data) { 
			console.log(data);
		}
	});
  });
	

	
	
 $('img').each(function() {
	  var value = $(this).attr('src');


	 $(this).attr('src', value.replace('http://70.182.185.26:2800/freedomv2/',''));
 });
	

$( document ).ready(function() {
	
	 var x = Math.floor((Math.random() * 10) + 1);
   	 $("#num1").val(x);
	
});
	
	
$( document ).ready(function() {
	
	 var y = Math.floor((Math.random() * 10) + 1);
   	 $("#num2").val(y);
	
});	

</script>


