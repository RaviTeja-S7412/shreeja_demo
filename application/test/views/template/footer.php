<?php $d = &get_instance(); ?>

	<!-- Footer Section Started -->
			<div class="container-fluid footer">
				<div class="col-xl-12 col-lg-12 col-md-11 col-sm-11 col-12 mx-auto footer-headings">
					<div class="row">
					
					<?php
						
					$head = $d->db->get_where("fdm_va_navbar_header_menu",array("status"=>"Active","deleted"=>0))->result();
					
					$i = 0;	
					if(count($head) > 0){
						
						foreach($head as $h){
							
//						if($i == 0){	
					?>	
					
					
						
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 foot-pad">
						<h4><?php echo $h->name ?></h4>
						</div>
								
														
					<?php 
						$i++;
						}} ?>	
					</div>
				</div>
				
				<div class="col-xl-12 col-lg-12 col-md-11 col-sm-11 col-12 mx-auto footer-lists">
					<div class="row">
					<?php
					$ii = 0;
					$mmenu = $d->db->get_where("fdm_va_navbar_header_menu",array("deleted"=>0,"status"=>"Active"))->result();
												 
					if(count($mmenu) > 0){	
					
					foreach($mmenu as $mm){
						
					$smenu = $d->db->get_where("fdm_va_navbar_header_submenu",array("status"=>"Active","deleted"=>0,"menu_type"=>"Footer","menu_name"=>$mm->id))->result();	
								
					if(count($smenu) > 0){
						
//						if($ii = 0){
					?>
						
							
						
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 foot-pad">
						<ul>
						
						<?php foreach($smenu as $sm){ ?>
						
							<li><a href="<?php echo base_url().$sm->sub_menu_link ?>"  target="<?php echo $sm->sub_menu_target ?>"><?php echo $sm->sub_menu_name ?></a></li>
							
						<?php } ?>	
							
						</ul>
						</div>
						
						
					<?php }}} ?>	
						
					</div>
				</div>
				<?php 
						$si = 0;
						$soc = $d->admin->getSociallinks();
						
						if(count($soc) > 0){
							
						?>
					<div class="footer-social">
					 <?php foreach($soc as $sc){ ?>	
						
						<li class="footer-social-icon <?php echo ($si == 0) ? "fbook" : "" ?>"><a href="#"><i class="<?php echo $sc->icon ?>"></i></a></li>
						
					 <?php  $si++;
							} ?>	
					</div>
					
				 <?php } ?>	
				 
					<input type="submit" value="SUBSCRIPTION" class="btn btn-sub" />
			</div>
			
			<div class="container-fluid footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 main-footer-logo">
						    <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/frame.png" alt="" class="ml-0" style="width:18%;" />
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 main-footer-logo">
						    <a href="https://play.google.com/store/apps/details?id=com.sreeja.nadsol&hl=en"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/google-play.png" alt="" /></a>
    						<li><a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Privacy policy-SMMPCL.pdf" target="_blank">Privacy Policy</a>     |    <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Refund policy-SMMPCL.pdf" target="_blank"> Refund Policy </a>     |   <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/TandC-SMMPCL.pdf" target="_blank">  Terms & Conditions</a> </li>
    						<li>© <?php echo date("Y") ?> Shreeja - Mahila Milk Producer Company Limited. All Rights Reserved.</li>
						</div>
					</div>	
				</div>
			</div>
		<!-- Footer Section Ended -->
		
	
	</div>


	
	<!-- Main Content Ended -->
	
	<!-- Script Section -->
	
	<script>
                            function openCity(evt, cityName) {
                              var i, tabcontent, tablinks;
                              tabcontent = document.getElementsByClassName("tabcontent");
                              for (i = 0; i < tabcontent.length; i++) {
                                tabcontent[i].style.display = "none";
                              }
                              tablinks = document.getElementsByClassName("tablinks");
                              for (i = 0; i < tablinks.length; i++) {
                                tablinks[i].className = tablinks[i].className.replace(" active", "");
                              }
                              document.getElementById(cityName).style.display = "block";
                              evt.currentTarget.className += " active";
                            }
                            
                            // Get the element with id="defaultOpen" and click on it
                            document.getElementById("defaultOpen").click();
    </script>
	
<!--	<script type="text/javascript" src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/bootstrap/js/model.js"></script>-->
	
	<script src="<?php echo base_url("admin/assets/front/") ?>assets/bootstrap/js/bootstrap.js"></script>
	
	
	<script src="<?php echo base_url() ?>admin/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/js/jquery.tabs.js"></script>
    
		
</body>
</html>	

<script>
$(document).ready(function(){

<?php if($d->session->userdata("location_id") == ""){ ?>	
	
//$('#myModal').modal('show');
	
<?php } ?>	
});
	
$("myModal").click(function(){
	
//	$('#myModal').modal('show');	
	
});	
	
</script>


<script type="text/javascript">
	
$("#freeSample").on("click",function(){

	$.ajax({
		
		type : "post",
		url : "<?php echo base_url("home/regfsStatus") ?>",
		
	});
	
});
	
	
$("#subscription").on("click",function(){

	$.ajax({
		
		type : "post",
		url : "<?php echo base_url("home/regStatus") ?>",
		
	});
});	
	
</script>	



