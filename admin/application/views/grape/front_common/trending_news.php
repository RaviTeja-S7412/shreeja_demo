<?php 
  $d = &get_instance();
?>
    
<div class="content">
  <div class="simple-marquee-container scr">
    <div class="marquee-sibling"> Trending </div>
    
    <div class="marquee">
      <ul class="marquee-content-items">
      <?php   
      $trend = $d->db->query("select * from fdm_va_trending_news where status='Active' and deleted=0 order by id desc")->result(); 
      if(count($trend) >= 1){
        foreach ($trend as $t) {
        
      ?> 
      <li style="line-height: 35px"> <a href="#"><?php echo $t->title ?> </a> </li>
      
      <?php  }} ?> 
      
      </ul>
    </div>
  </div>
  <div class="marquee-sibling-right"></div>
</div>
