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
       
   <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Edit Main Menu</h4>
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
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>menus/main-menu">Main Menus</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit <?php echo $n->name ?></li>
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
                <!-- Edit Navbar Menu Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form action="<?php echo base_url() ?>navbar/navbar_menu/editNavbar" method="post">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Menu Name</label>
                                                    <input type="text" class="form-control" placeholder="Menu Name" name="name" required="" value="<?php echo $n->name ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Select Menu Link</label>

                                                     <input type="text" name="link" class="form-control" id="link" placeholder="Menu Link" value="<?php echo $n->link ?>" required>
                                                     
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Link Target</label>
                                                    <select class="form-control" required name="target">
 <option value="_blank" <?php if($n->target == '_blank') { ?>  selected="selected"<?php } ?>>Blank</option>
 <option value="_self" <?php if($n->target == '_self') { ?> selected="selected"<?php } ?>>Self</option>

                                                    </select>
                                                </div>
                                            </div>

                                           
											<div class="col-md-3" style="margin-top: 5px">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit" style="width: 100%"> <i class="fa fa-check"></i> Update</button>
                                                             
                                                        </div>
                                                </div>
                                            </div> 
   
                                         
                                        </div>


                                       <input type="hidden" name="id" value="<?php echo $n->id ?>">
                                   
                                </div>
                            </form>
                            
                            </div>   

            



              </div>

        <!-- End Navbar Edit   -->
        
            </div>









            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

<script>
	

	
   
$(".menu_icon").on("change",function(){

  var menu_id = $(this).attr("menu_id");
  $("#menu_icon").val(menu_id);


});

$(".main_icon").on("change",function(){

  var main_id = $(this).attr("main_id");
  $("#main_icon").val(main_id);


});




$("#submit").click(function(){
    var sml = document.getElementById('sml');
    var lt = document.getElementById('lt');
    var invalidsml = sml.value == "0";
    var invalidlt = lt.value == "0";
    
    if(invalidsml){
        $("#error").html('<div class="alert alert-danger alert-dismissable">Please Select Sub Menu Link</div>')
        return false;
    }
    if(invalidlt){
        $("#error").html('<div class="alert alert-danger alert-dismissable">Please Select Link Target</div>')
        return false;
    }
});
 
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
$('#zero_config').DataTable();

    $('#zero_config').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
        
          var nav_id = $(this).attr("nav_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>navbar/navbar_menu/navbarSubmenustatus",
                        data:{id:nav_id,status:status},
                        success:function (data){
                            
                            location.reload();
                        }

                    });  
        });

</script>

<script type="text/javascript">


function archiveFunction(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected sub menu!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Sub Menu has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>navbar/navbar_menu/delNavbarSubmenu/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Sub Menu is safe :)',
      'success',
      
    )
  }
})
    }
</script>



            <!-- End footer -->