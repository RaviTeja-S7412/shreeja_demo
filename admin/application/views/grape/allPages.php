<!DOCTYPE html>
<html lang="en">
<?php admin_header(); ?>

<body>
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
                        <h4 class="page-title">Static Pages</h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Static Pages</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border:0px">
                            <div class="card-body">
                               <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Static Pages</strong></p></div>

<!--                               	<a href="<?php echo base_url() ?>pages/create-page" target="_blank"><button type="button" class="btn btn-primary" style="margin-bottom: 10px">Add New Page</button></a>-->
							   		
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                     
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
												<th>Page Name</th>
												<th>Route</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
												$i = 0;
												$pages = $this->db->query("select * from pages order by id desc")->result();
												foreach($pages as $p){
												if($p->deleted==0){	
											?>
                                            <tr>
                                                <td><?php echo ++$i ?></td>
												<td><?php echo $p->page_name ?></td>
												<td><?php echo $p->route ?></td>
												<td>
													<a href="<?php echo base_url() ?>pages/edit-page/<?php echo $p->id ?>" target="_blank"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button></a>
<!--													<a href="<?php echo base_url() ?>page/<?php echo $p->route ?>" target="_blank"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button></a>-->
<!--													<a href="#" id="<?php echo $p->id ?>" onclick="delPage(this.id)"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>	-->
												</td>
                                            </tr>
                                        <?php }} ?>
 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
	</div>

</div>

</body>
</html>
<?php admin_footer(); ?>

<script src="<?php echo base_url() ?>assets/js/mindmup-editabletable.js"></script> <!-- Editable Table Plugin Js --> 

<script type="text/javascript">

$("#zero_config").dataTable();

	
//$(function () {
//    $('#zero_config').editableTableWidget();
//});	

</script>

<script type="text/javascript">




function delPage(id) {
Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected page!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Page has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>grape/delPage/'+id,
        success: function(data) {
            location.reload();
            console.log(data);   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Page is safe :)',
      'success',
      
    )
  }
})

}
</script>

