<?php

	front_header();

?>



<div class="container">
  <div class="col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Search</li>
      </ol>
    </nav>
  </div>
</div>
<div class="clearfix"></div>



<section id="customer" >
  <div class="container">
    <div class="col-md-12 col-sm-12 col-xs-12">
<?php
	
	$svalues = $this->db->query("SELECT * FROM pages WHERE html like '%".$search."%'")->result();
								   									   
	?>
   <h1> All Results (<?php echo count($svalues) ?>) </h1>
 
<?php
 
    if(count($svalues) >= 1){

	foreach($svalues as $sv){
	
	$data = strip_tags($sv->html);	
		
	$sdata = substr($data,0,350);	
	
?>
       
 <h2><a href="<?php echo base_url().$sv->route ?>" style="color: #cca147; text-decoration: none"> <?php echo $sv->page_name ?></a></h2>
 <small><a href="<?php echo base_url().$sv->route ?>" style="color: #275798; text-decoration: none"><?php echo base_url().$sv->route ?></a></small>
 <p><?php echo $sdata ?>... <span class="more"><a href="<?php echo base_url().$sv->route ?>">Learn More</a></span>
</p>

<hr>
  
<?php }}else{ ?>
  
    <div class="container" align="left" style="margin-top: 20px; margin-bottom: 100px">No Results Found</div>
      
<?php } ?>          
   
    </div>
   
  </div>
</section>





<?php

	front_footer();

?>
