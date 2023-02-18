<?php
	
	admin_header();

?>

<?php admin_sidebar() ?> 


       <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Style Manager</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Style Manager</li>
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
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

							 <div class="form-body">
                                 <div class="card-body">
                                     <div class="row">
                                      	
                                      <form method="post" action="<?php echo base_url() ?>superadmin/style_manager/stylemanager/updateStyle">	
                                     	<div class="col-9">
                        
					                     <textarea rows="15" cols="450" class="form-control" style="width:100%" name="style">
										   <?php
											$sty = 'assets/front/css/style.css';
											$myfile = fopen($sty, "r+") or die("Unable to open file!");
											echo fread($myfile,filesize($sty));
											fclose($myfile);
										   ?>
					                     </textarea>                                   
						                                   
						                </div>
						                
						                <div class="form-group" style="margin-left: 10px; margin-top: 10px">
                                   			
                                   			<button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right">Submit</button>
						                	
						                </div>
						                
						              </form>                              
								     </div>
								 </div>
							 </div>
						</div>
					</div>
				</div>
		   </div>
	</div>

<?php
	
	admin_footer();

?>

   
<script type="text/javascript">

		$(document).ready(function(){
		
		
		$("#summernote").summernote({
			height: 300,
			toolbar: [
				[ 'style', [ 'style' ] ],
				[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
				[ 'fontname', [ 'fontname' ] ],
				[ 'fontsize', [ 'fontsize' ] ],
				[ 'color', [ 'color' ] ],
				[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
				[ 'table', [ 'table' ] ],
				[ 'insert', [ 'link'] ],
				[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
			]
    	});

		
	});
		
	
</script> 

   
