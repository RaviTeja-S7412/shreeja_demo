<?php admin_header(); ?>

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
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
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                   <!--  <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            
            <div class="row clearfix">  
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Download MYSQL Database</div>
					<div class="body" align="right" style="padding:10px;">
						<a href="<?php echo base_url('backup/db_backup');?>" target="_blank">
						  <button type="button" class="btn btn-primary">Download</button>
					  </a>
					</div>

				  <div class="" role="tab">
					<h5 class="mb-0" style="margin-left: 10px">All Database Backups</h5>
				  </div>
				  <div class="card-body">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					  <thead>
						  <tr> 
							  <th>Sl.No.</th>
							  <th>Backup Date</th>
							  <!--<th>Downlaod</th>-->
						  </tr>
					  </thead>
					  <tbody>
						  <?php 
						  $databases = $this->db->get_where("tbl_backups",["type"=>"database"])->result();
						  if($databases){
								  $key=1;
								 foreach($databases as $db):
							  ?>
						 <tr>
							  <td><?php echo $key;?></td>
							  <td><?php echo date("d-m-Y H:i:s",strtotime($db->created_date));?></td>
							  <!--<td><a href="<?php //echo base_url().$db->source_file;?>" class="btn btn-info btn-sm" style="border-radius: 15px">Download</a></td>-->
						  </tr>
						  <?php $key++; endforeach;}?>

					  </tbody>

					</table>
				  </div>
				</div>
			</div>


			<!--<div class="col-md-6">
				<div class="card">
					<div class="card-header">Download Source Code</div>
					<div class="body" align="right" style="padding:10px;">
						<a href="<?php echo base_url('admin/backup/backupsource_code');?>" target="_blank">
						  <button type="button" class="btn btn-primary">Download</button>
						</a>
					</div>

				  <div class="" role="tab">
					<h5 class="mb-0" style="margin-left: 10px">All Source Code Backups</h5>
				  </div>
				  <div class="card-body">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					  <thead>
						  <tr> 
							  <th>Sl.No.</th>
							  <th>Backup Date</th>
							  <th>Downlaod</th>
						  </tr>
					  </thead>
					  <tbody>
						  <?php 
						  $databases = $this->db->get_where("tbl_backups",["type"=>"source"])->result();
						  if($databases){
								  $key=1;
								 foreach($databases as $db):
							  ?>
						 <tr>
							  <td><?php echo $key;?></td>
							  <td><?php echo date("d-m-Y H:i:s",strtotime($db->created_date));?></td>
							  <td><a href="<?php //echo base_url().$db->source_file;?>" class="btn btn-info btn-sm" style="border-radius: 15px">Download</a></td>
						  </tr>
						  <?php $key++; endforeach;}?>

					  </tbody>

					</table>
				  </div>
				</div>
			</div>
			-->
			
		</div>
	</div>	
</div>

<?php admin_footer(); ?>

<script>
    
    $(".dataTable").dataTable();
    
</script>
