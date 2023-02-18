<?php
	admin_header();

?>


<?php admin_sidebar(); ?>

<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Create Page</h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Create Page</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

<div class="container-fluid">
		<div class="row">
			
		
		<div class="col-lg-12">
                      <div class="card" style="margin-bottom: 0px !important">
						<form action="<?php echo base_url() ?>grape" method="get">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Page Name</label>
													<input type="text" required="" placeholder="Page Name" value="" name="pname" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Page Route</label>
                                                    <input type="text" required="" placeholder="Page Route" value="" name="route" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Page Layout</label>
                                                    <select class="form-control" name="playout" required> 
                                                    	
                                                    	<option value="">Select Page Layout</option>
                                                    	<option value="1-col">1 Column</option>
                                                    	<option value="2-col">2 Column</option>
                                                    	<option value="3-col">3 Column</option>
                                                    	<option value="icon-layout">Icon Layout</option>
                                                    	
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group has-danger" style="margin-top: 28px">
                                                   
                                                   <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>

                                                </div>
                                            </div>
										 </div>
                       				</div>
								</div>
                        </form>
                      </div> 
		
		</div>
		</div>
	
</div>





<?php admin_footer(); ?>