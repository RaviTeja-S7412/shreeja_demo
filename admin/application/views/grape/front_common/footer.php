<?php $d = &get_instance(); ?>


<div class="foottop">
  <div class="container">
    <div class="col-md-5ths col-sm-4 col-xs-12 soc1" >
   <!--   <h2>Connect with us</h2>-->
      
      <!--    <ul>
	    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	  
	</ul>-->
      
     
      <img  src="<?php echo base_url().$d->admin->getfooterLogo(); ?>" class="img-responsive"> 
      
       <?php 
       // $social = $d->db->get_where("fdm_va_social_networking",array("deleted"=>0,"status"=>"Active"))->result();
		
		$social = $d->db->query("select * from fdm_va_social_networking where deleted=0 and status='Active' order by id desc")->result();

        if(count($social) >= 1){
      ?>
      <ul class="social"><li><span> Follow us! </span></li>
      
      <?php 
          foreach ($social as $ssite) {
      ?>  

        <li><a href="<?php echo $ssite->link ?>"  target="_blank"><img  src="<?php echo base_url().$ssite->icon ?>" width="20px"></a></li>
      
      <?php } ?> 
      </ul>
      
      <?php } ?>
       
       <ul>
        <li><a href="#"> <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?php echo $d->admin->info("mobile") ?></a></li>
        <li> <a href="mailto:<?php echo $d->admin->info("email") ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $d->admin->info("email") ?></a></li>
      </ul>
      
    <select class="form-control2" id="sel1">
        <option>LOCATIONS</option>
      <?php 
        $loc = $d->db->query("select * from fdm_va_locations where deleted=0 and status='Active'")->result();
        if($loc){
        foreach ($loc as $b) {
          
      ?>  

        <option value="<?php echo $b->id ?>"><?php echo $b->branch_name ?></option>
      
      <?php }} ?>  
    </select >
      <?php 
        $loc = $d->db->query("select * from fdm_va_locations where deleted=0 and status='Active'")->result();
        if($loc){
        foreach ($loc as $b) {
          
      ?> 
      <div class="<?php echo $b->id ?> bo">
        <p><?php echo nl2br($b->branch_address); ?>
           <?php echo $b->contact_number1 ?><br>
           <a href="<?php echo base_url().$b->link ?>" target="<?php echo $b->target ?>">Map</a>
        </p>
      </div>

      <?php }} ?> 
      

      
      
      </div>
    <?php  
      $fmenu = $d->db->query("select * from fdm_va_navbar_footer_menu where deleted=0 and status='Active'")->result();
      if($fmenu){
        foreach ($fmenu as $fm) {

          $sfm = $d->db->query("select * from fdm_va_navbar_footer_submenu where deleted=0 and status='Active' and footer_menu_name=$fm->id")->result();
    ?>
    <div class="col-md-5ths col-sm-4 col-xs-12 ">
      <h2><a href="<?php echo base_url().$fm->link ?>"><?php echo strtoupper($fm->name) ?></a></h2>
      <?php if($sfm){ ?>
      <ul>
        <?php foreach ($sfm as $sm) {  ?>

             <li><a href="<?php echo base_url().$sm->footer_submenu_link ?>"><?php echo $sm->footer_submenu_name ?></a></li>
        
        <?php } ?>
      </ul>
    <?php  } ?>
    </div>
   <?php }} ?>
<!--
    <div class="col-md-5ths col-sm-4 col-xs-12 " >
     <h3><span class="sr-only">About Freedom Bank</span></h3>
      <ul style="padding-top:7px;">
       
  	  <?php
//        $minibar = $d->db->query("select * from fdm_va_navbar_minibar where deleted=0 and status='Active' order by id asc")->result();
//        if($minibar){
//          foreach ($minibar as $mb) {
           
      ?>
      
        <li><a href="<?php //echo base_url().$mb->link ?>" target="<?php //echo $mb->target ?>"><?php //echo $mb->name ?></a></li>
      
      <?php //}} ?>       
      </ul>
    
    </div>
-->
  </div>
  </div>
  <section id="footbtm">
    <div class="container">
      <div class="footbtm">
        <div class="col-md-11 col-sm-10 col-xs-12">
          <p>© 2018 Freedom Bank of Virginia. All Rights Reserved. </p>
        </div>
        <div class="col-md-1 col-sm-2 col-xs-12"> <ul><li><a href="<?php echo base_url() ?>assets/pdf/Privacy-Notice.pdf" target="_blank">Disclosures</a></li></ul>
      
    	</div>
      </div>
    </div>
  </section>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
 
<script src="<?php echo base_url() ?>assets/front/js/asmenu.js"></script> 
<script type="text/javascript">
         $(document).ready(function () {
             $("#respMenu").aceResponsiveMenu({
                 resizeWidth: '768', // Set the same in Media query       
                 animationSpeed: 'fast', //slow, medium, fast
                 accoridonExpAll: false //Expands all the accordion menu on click
             });
         });
	</script> 
<script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/marquee.js"></script> 
<script>
      $(function (){

        $('.simple-marquee-container').SimpleMarquee();
        
      });
	
$(window).on('load', function() {
    $('#thanksModal').modal('show');
});

</script>	
</body>
</html>

<!-- thank you Modal -->
<?php

	$id = $d->uri->segment("1");
		
	$wb = $d->db->get_where("fdm_va_welcome_note",array("status"=>"Active"))->row();
	
	if(count($wb) == 1){	
		if($id == "home"){	
	
?>

<div class="modal fade text-center py-5" style="top:30px;" id="thanksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
         <div class=" modal-header custom-modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
               
              </div>
            <div class="modal-body">
               
               <?php echo $wb->description ?>
              
            </div>
        </div>
    </div>
</div>

<?php }} ?>

<script type="text/javascript">

	$(document).ready(function(){
		
		$('a').bind("click", function (e) {
        	
			e.preventDefault();
    	
		});
		
	});

</script>
