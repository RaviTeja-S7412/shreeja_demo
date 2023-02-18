<div id="banner">
  <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel"> 
   
    <div class="overlay"></div>
    

    <ol class="carousel-indicators">
  <?php
      $id = 0; 
      $img = $this->db->query("select * from fdm_va_home_slider_images where deleted=0 and status='Active' limit 3")->result();
      if($img){ 
      foreach ($img as $i) {
      
  ?>
      <li data-target="#bs-carousel" data-slide-to="<?php echo $id ?>" class="<?php echo ($id==0) ? 'active' : '' ?>"></li>
  <?php 
    $id++;
    }} 
  ?> 
    </ol>
    
  
    <div class="carousel-inner">

    <?php
      $id = 0; 
      $img = $this->db->query("select * from fdm_va_home_slider_images where deleted=0 and status='Active'")->result();
      if($img){ 
      foreach ($img as $i) {
      
    ?>  
      <div class="item slides <?php echo ($id==0) ? 'active' : '' ?>">
        
        <div class="slide-1" style="background-image: url(<?php echo base_url().$i->images ?>);"></div>
       
      </div>
     <?php 
    $id++;
    }} 
  ?>
    </div>
  </div>
</div>