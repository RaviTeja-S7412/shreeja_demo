<?php admin_header(); ?>

<?php

	$id = $this->uri->segment(3);
	$icon = $this->db->get_where("fdm_va_gallery_types",array("id"=>$id,"deleted"=>0))->row();

	$gtypes = $this->db->get_where("fdm_va_gallery_types",array("deleted"=>0))->result();

?>
<style type="text/css">

	.gal{
	
	
	-webkit-column-count: 4; /* Chrome, Safari, Opera */
    -moz-column-count: 4; /* Firefox */
    column-count: 4;
	  
	
	}
	
	.gal img{ width: 100%; padding: 15px 0;}
	@media (max-width: 1500px) {
		
		.gal {


		-webkit-column-count: 1; /* Chrome, Safari, Opera */
		-moz-column-count: 1; /* Firefox */
		column-count: 1;


		}
		
	}

</style>        
        <!-- ============================================================== -->
<?php admin_sidebar() ?> 
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <div class="d-flex no-block justify-content align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">File Manager</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

          

            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
            <!-- ============================================================== -->
          	

          	<div class="card">
                <div class="card-header">
                   <div class="row">
                   	  <div class="col-md-10">
                    	<i class="ti-gallery"></i> Upload Images
                      </div>

                   </div> 	
                </div>
    
                
                <div class="card-body">
                
                
                   <div class="form-horizontal">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                            <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Image Type
                                                <div class="input-group">
                                                   

                                                   <select class="form-control" id="gtype" name="gtype" required>
                                                       <option value="">Select Icon Type</option>
                                                       <?php
															$typ = $this->db->get_where("fdm_va_gallery_types",array("deleted"=>0))->result();
															foreach($typ as $t){
														?>
                                                       <option value="<?php echo $t->id ?>"><?php echo $t->gallery_type ?></option>	
                                                       <?php } ?>
                                                    </select>

                                                </div>
                                                   <?php
														$typ = $this->db->get_where("fdm_va_gallery_types",array("deleted"=>0))->result();
														foreach($typ as $t){
														if($t->gallery_type == "Pdfs"){
														}else{
													?>
                                                   		<small style="color: red">Note: Please select <?php echo $t->width ?>px * <?php echo $t->height ?>px for <?php echo $t->gallery_type ?></small><br>

                                                   		
                                                   	<?php }} ?>	
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Images
                                                <div class="input-group">
                                                    
														<input type="file" class="form-control" id="files"  name="files" accept="image/png, image/jpeg, image/jpg" required="" multiple>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                  
                                        
                                         <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 25px;">
                                                  <div id="uploading">
                                                   <button id="submit" class="btn btn-info waves-effect waves-light" style="width: 100%">Save</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                              </div>
                              
                   </div>
                   

                </div>
            </div>
          	
          	
          	
          	
            
            <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Nav Pills Tabs</h4> -->
                                <ul class="nav nav-pills m-b-30">
					   	
                                <?php
									$i = 1;
									if($id != ""){
										
									foreach($gtypes as $gt){	
								?>		
								     
								    <li class="nav-item"> <a href="#navpills-<?php echo $i ?>" class="nav-link" data-toggle="tab" aria-expanded="false"><?php echo $gt->gallery_type ?></a> </li>
		
								<?php		
									$i++;	
									}
									}else{
										
									$i = 1;	
									foreach($gtypes as $gt){
									if($i == 1){
								?>		
									
									<li class="nav-item"> <a href="#navpills-<?php echo $i ?>" class="nav-link active" data-toggle="tab" aria-expanded="false"><?php echo $gt->gallery_type; ?></a> </li>
									
								<?php
									}else{
								?>		
									<li class="nav-item"> <a href="#navpills-<?php echo $i ?>" class="nav-link" data-toggle="tab" aria-expanded="false"><?php echo $gt->gallery_type ?></a> </li>
										
								<?php
									}
									$i++;	
									}
									}
								?>
                                    
                                    
                                <?php 
									if($id != ""){
								?>                  
                                    <li class="nav-item"> <a href="#navpills-8" class="nav-link active" data-toggle="tab" aria-expanded="false">Gallery Types</a> </li> 
                                <?php		
									}else{
								?>           
                                    <li class="nav-item"> <a href="#navpills-8" class="nav-link" data-toggle="tab" aria-expanded="false">Gallery Types</a> </li> 
								<?php						
									}
								?>
                                            
                                </ul>
                <div class="tab-content br-n pn">
                
                
                
<!--  If block starts       -->
			
			
				<?php 
					$ig = 1;
					if($id != ""){
										
					foreach($gtypes as $gtt){
						
					if($gtt->gallery_type == "Pdfs"){
						
				?>		
				<div id="navpills-<?php echo $ig ?>" class="tab-pane">
              
					<div class="row el-element-overlay">
					
					
		  <?php 


			$img = $this->db->query("select * from fdm_va_gallery where gallery_type='$gtt->id' order by id desc")->result();
			if(count($img) >= 1){ 
			foreach ($img as $i) {
				
		  ?>
                     
                   <div class="col-md-2" id="contents" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px;">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url() ?>assets/images/pdf.ico" alt="user" style="width: 100%;text-align: center; height: 120px">
                                   <p align="center"><strong><?php echo basename($i->img_name) ?></strong></p>
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php echo $i->id; ?>" onclick="getPdflink(this.id)"><i class="fa fa-eye"></i></a>
                                            </li>
                                            <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php echo $i->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
               
    <?php }} ?>
				 </div>
               </div>	
						
				<?php						
						
					}else{	
						
				?>
    			  <div id="navpills-<?php echo $ig ?>" class="tab-pane">
              
					
					<div class="row el-element-overlay">
					
					<?php if($gtt->coldiv == "col-md-3"){ ?>
		  <?php 


			$img = $this->db->query("select * from fdm_va_gallery where gallery_type='$gtt->id' order by id desc")->result();
			if(count($img) >= 1){ 
			foreach ($img as $i) {
				if($i->gallery_type == 4){
						
				}else{
		  ?>
                     
                   <div class="col-md-3" id="contents" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px;">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url().$i->img_name ?>" alt="user" style="width: 100%;text-align: center; height: 120px">
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php echo $i->id; ?>" onclick="editImg(this.id)"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php echo $i->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
               
    <?php }}} ?>
    
    
      <?php }else{  ?>
                   
                 <?php 


			$img = $this->db->query("select * from fdm_va_gallery where gallery_type='$gtt->id' order by id desc")->result();
			if(count($img) >= 1){ 
			foreach ($img as $i) {
				if($i->gallery_type == 4){
						
				}else{	
		  ?>
                     
                   <div class="col-md-2" id="contents" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px;">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url().$i->img_name ?>" alt="user" style="width: 100%;text-align: center; height: 120px">
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php echo $i->id; ?>" onclick="editImg(this.id)"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php echo $i->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
               
    <?php }}} ?>       
                         
                            
                               
      <?php } ?> 
   
                  </div>
					
				 </div>
				<?php
					$ig++;
					}
					}
				?>	   
<!--  If block Ends       -->
<!--  Else block starts       -->
				  
				<?php	
					}else{
					
					$igs = 1;	
					foreach($gtypes as $gt){
					if($igs == 1){	
						
				?>  
    			  <div id="navpills-<?php echo $igs ?>" class="tab-pane active">
               
               		<div class="row el-element-overlay">
		  <?php 


			$img = $this->db->query("select * from fdm_va_gallery where gallery_type='$gt->id' order by id desc")->result();
			if(count($img) >= 1){ 
			foreach ($img as $i) { 
		  ?>
                     
                    <div class="col-md-2" id="contents" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px;">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url().$i->img_name ?>" alt="user" style="width: 100%;text-align: center; height: 120px">
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php echo $i->id; ?>" onclick="editImg(this.id)"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php echo $i->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

    <?php }} ?>
   
			    </div>  
            </div>    				
                <?php
					}else{
				
					if($gt->gallery_type != "Pdfs"){		
				?>
				
				
		<div id="navpills-<?php echo $igs ?>" class="tab-pane">
    			  
    			  <div class="row el-element-overlay">
		  <?php if($gt->coldiv == "col-md-3"){ ?>
		  <?php 


			$img = $this->db->query("select * from fdm_va_gallery where gallery_type='$gt->id' order by id desc")->result();
			if(count($img) >= 1){ 
			foreach ($img as $i) { 
		  ?>
                     
                   <div class="col-md-3" id="contents" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px;">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url().$i->img_name ?>" alt="user" style="width: 100%;text-align: center; height: 120px">
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php echo $i->id; ?>" onclick="editImg(this.id)"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php echo $i->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
               
    <?php }} ?>
    
    
      <?php }else{  ?>
            
                   
                                 
          <?php 
			$img = $this->db->query("select * from fdm_va_gallery where gallery_type='$gt->id' order by id desc")->result();
			if(count($img) >= 1){ 
			foreach ($img as $i) { 
		  ?>
                     
                   <div class="col-md-2" id="contents" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px;">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url().$i->img_name ?>" alt="user" style="width: 100%;text-align: center; height: 120px">
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php echo $i->id; ?>" onclick="editImg(this.id)"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php echo $i->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
               
    <?php }} ?>       
                         
                            
                               
      <?php } ?> 
                  </div>
    			  
    	
    	   	
		</div>		
			
			
																																		
		<?php		  
					}else{
						
				?>		
				<div id="navpills-<?php echo $igs ?>" class="tab-pane">
              
					<div class="row el-element-overlay">
					
					
		  <?php 


			$img = $this->db->query("select * from fdm_va_gallery where gallery_type='$gt->id' order by id desc")->result();
			if(count($img) >= 1){ 
			foreach ($img as $i) {
				
		  ?>
                     
                   <div class="col-md-2" id="contents" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px;">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url() ?>assets/images/pdf.ico" alt="user" style="width: 100%;text-align: center; height: 120px">
                                   <p align="center"><strong><?php echo basename($i->img_name) ?></strong></p>
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php echo $i->id; ?>" onclick="getPdflink(this.id)"><i class="fa fa-eye"></i></a>
                                            </li>
                                            <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php echo $i->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
               
    <?php }} ?>
				 </div>
               </div>	
						
				<?php						
						
					}}
						
				?> 																									
				<?php							
						
					$igs++;	
					}
					}
				?>      
     			  
<!--  Else block ends       -->
		  
                  
		          
     
  							
      			 
 					
                <?php if($id != ""){ ?>    
                    <div id="navpills-8" class="tab-pane active">
				<?php }else{ ?>
                    <div id="navpills-8" class="tab-pane">
				<?php } ?>
					<div class="row">
					<?php
						
						if($id != ""){
					?>	
						<div class="col-lg-4">
							<div class="card-header" style="margin-bottom: 10px">Update Icon Type</div>
							<form method="post" action="<?php echo base_url() ?>file_manager/file_manager/updateGallerytype">
								
								<div class="form-group">
									<label>Name:</label><br>

									<input type="text" class="form-control" name="name" value="<?php echo $icon->gallery_type ?>">
									
								</div>
								
							<div class="row">
							  <div class="col-6">
							  	<div class="form-group">
									<label>Min Height:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="minheight" value="<?php echo $icon->minheight ?>" placeholder="Image Height In px" required>
									
								</div>
							  </div>	
							  <div class="col-6">
								
								<div class="form-group">
									<label>Min Width:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="minwidth" value="<?php echo $icon->minwidth ?>" placeholder="Image Width In px" required>
									
								</div>
							  </div>
							</div>
							
							<div class="row">
							  <div class="col-6">		
								<div class="form-group">
									<label>Height:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="height" value="<?php echo $icon->height ?>" placeholder="Image Height In px" required>
									
								</div>
							  </div>	
							  <div class="col-6">		
								<div class="form-group">
									<label>Width:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="width" value="<?php echo $icon->width ?>" placeholder="Image Width In px" required>
									
								</div>
							  </div>	
							</div>	
								<div class="form-group">
									
									<input type="hidden" name="id" value="<?php echo $icon->id ?>">
									
									<button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
									
								</div>
								
							</form>
							
						</div>
					<?php }else{ ?>	
						<div class="col-lg-4">
							<div class="card-header" style="margin-bottom: 10px">Create Gallery Type</div>
							<form method="post" action="<?php echo base_url() ?>file_manager/file_manager/insertGallerytype">
								
								<div class="form-group">
									<label>Name:</label><br>

									<input type="text" class="form-control" name="name" placeholder="Gallery Type Name">
									
								</div>
							<div class="row">
							  <div class="col-6">
							  	<div class="form-group">
									<label>Min Height:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="minheight" placeholder="Image Height In px" required>
									
								</div>
							  </div>	
							  <div class="col-6">
								
								<div class="form-group">
									<label>Min Width:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="minwidth" placeholder="Image Width In px" required>
									
								</div>
							  </div>
							</div>
							
							
							<div class="row">
							  <div class="col-6">
							  	<div class="form-group">
									<label>Max Height:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="height" placeholder="Image Height In px" required>
									
								</div>
							  </div>	
							  <div class="col-6">
								
								<div class="form-group">
									<label>Max Width:</label><br>

									<input type="number" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="width" placeholder="Image Width In px" required>
									
								</div>
							  </div>
							</div>
								<div class="form-group">
									
									<button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
									
								</div>
								
							</form>
							
						</div>
					<?php } ?>	
						<div class="col-lg-8">
                        <div class="card" style="border:0px">
                          <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Gallery Types</strong></p></div>
                             <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped mainmenu" id="gtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                        $i = 0;
										$opt = $this->db->query("select * from fdm_va_gallery_types where deleted=0 order by id desc")->result();       	
                                           foreach ($opt as $u) {  
										   if($u->gallery_type == "Pdfs"){
											   
										   }else{		
										?> 
                                            <tr>
                                                <td style="vertical-align: middle;"><?php echo ++$i ?></td>
                                                <td style="vertical-align: middle;"><?php echo $u->gallery_type ?></td>
                                                
                                                <td style="vertical-align: middle; padding: 0px">
                                             
                                                    <a href="<?php echo base_url() ?>file-manager/gallery-type/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
     
                                                    <a href="#" name="delete" value="<?php //echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="delGallerytype(this.id)"><i class="ti-trash"></i></a>
    

                                                </td>
                                                    
                                            </tr>
                                        <?php }} ?> 
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
						
				  </div>
							
     
                              
                                          
				 </div>
				 
                    
                    
                   
				</div>     
			</div> 
			
		</div>        
      </div> 
   </div>        
                        
                
<!--   End trending Bar             -->         
               

                
                

            

            <!-- End Card  -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

            <!-- End footer -->

<script type="text/javascript">

$("#gtable").dataTable();


function delGallerytype(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected gallery type!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected gallery type has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>file_manager/File_manager/delGallerytype/'+id,
        success: function(data) {
       //     location.reload();
			
			window.location = "<?php echo base_url() ?>file-manager"
            console.log(data);   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected gallery type is safe :)',
      'success',
      
    )
  }
})
    }
</script>

 <script>
 	
 $('#submit').click(function(){
  var files = $('#files')[0].files;
  var gtype = $('#gtype').val();
  var err = $("#files").val();

 if(gtype==""){
   Swal(
      'Error',
      'Please Select Gallery Type :)',
      'error'
    );
     return false;
  }
	 
 if(err==""){
   Swal(
      'Error',
      'Please Select File :)',
      'error'
    );
     return false;
  }
  var error = '';
  var form_data = new FormData();
  for(var count = 0; count<files.length; count++)
  {
   var name = files[count].name;
   var extension = name.split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)
   {
     Swal(
      'Error',
      'Please Select Valid Image File :)',
      'error'
    );
     return false;
   }
   else
   {
    form_data.append("files[]", files[count]);
	form_data.append("gtype",gtype);   
   }
  }
  if(error == '')
  {
   $.ajax({
    beforeSend:function()
    {
     $('#uploading').html('<button class="btn btn-info waves-effect waves-light" style="width: 100%">Uploading</button>');
    },
    url:"<?php echo base_url(); ?>file_manager/File_manager/insertImages", //base_url() return http://localhost/tutorial/codeigniter/
    method:"POST",
    data:form_data,
    contentType:false,
    cache:false,
    processData:false,
   
    success:function(data)
    {
       //$('#uploaded_images').html(data);
    //$('#files').val('');
        Swal(
              'success!',
              'Successfully Uploaded.',
              'success'
            )
         //$("#load").html('<div class="alert alert-success">Successfully Uploaded</div>');
         setTimeout(function(){ location.reload(); }, 2000);
    },
    error:function(data){
        console.log(data);
         //$("#load").html('<div class="alert alert-danger">Error Occured While Uploading Images</div>');
         Swal(
              'Error',
              'Error Occured While Uploading Images :)',
              'error'
            );
         return false;
    }   
   })
  }
  else
  {
   alert(error);
  }
 });
	 
	 
 function editImg(id) {
       Swal({
  title: 'Are you sure?',
  text: 'Selected Changes Will Be Reflected At Front End!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Update it!',
  cancelButtonText: 'No, Leave it'
}).then((result) => {
  if (result.value) {

    
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>file_manager/File_manager/updateImg',
        success: function(data) {
          if(data==1){
            Swal(
              'Disabled!',
              'Your Selected Image has been Successfully Disabled.',
              'success'
            )
            setTimeout(function(){ location.reload(); }, 2000);
            console.log(data);
            return false;
           }
           if(data==2){
            Swal(
              'Enabled!',
              'Your Selected Image has been Successfully Enabled.',
              'success'
            )
            setTimeout(function(){ location.reload(); }, 2000);
            console.log(data);
            return false;
           } 
               
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Image Is Not Updated :)',
      'error'
    )
    console.log(data);
  }
})
    }

function delImg(id) {
       Swal({
  title: 'Are you sure?',
  text: 'Selected Image Will Be Permanently Deleted!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Delete it!',
  cancelButtonText: 'No, Leave it'
}).then((result) => {
  if (result.value) {

    
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>file_manager/File_manager/delImg',
        success: function(data) {
          console.log(data);
          if(data==1){
            Swal(
              'Deleted!',
              'Your Selected Image has been Successfully Deleted.',
              'success'
            )
            setTimeout(function(){ location.reload(); }, 2000);

            console.log(data);
            return false;
           }
           if(data==0){
            Swal(
              'Error!',
              'Error Occured While Deleting File.',
              'error'
            )
            console.log(data);
            return false;
           } 
               
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Image Is Not Deleted :)',
      'error'
    )
  }
})
    }    

	 
function getPdflink(id) {
	
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>file_manager/File_manager/getPdflink',
        success: function(data) {
          
           if(data==0){
            Swal(
              'Error!',
              'Pdf Not Found.',
              'error'
            )
            return false;
           }else{
			   
			Swal(
              'PDF Path',
               data,
              'success'
            ) 
			   
		   } 
               
        }
    });

    } 	 
	 		 
</script>          