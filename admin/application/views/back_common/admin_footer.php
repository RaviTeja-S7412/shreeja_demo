<?php $d  = &get_instance(); ?> 
<style type="text/css">
.footer {
  bottom: -60px;
  height: 100px;
  left: 0;
  position: absolute;
  right: 0;
}

</style>

            <footer class="footer text-center">
                All Rights Reserved by Shreeja Milk.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    
    <!-- <div class="chat-windows"></div> -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/summernote/dist/summernote-lite.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?php echo base_url() ?>dist/js/app.min.js"></script>
    <script src="<?php echo base_url() ?>dist/js/app.init.js"></script>
    <script src="<?php echo base_url() ?>dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url() ?>dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>dist/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

    <script src="<?php echo base_url() ?>assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="<?php echo base_url() ?>dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/toastr/build/toastr.min.js"></script>
    <script src="<?php echo base_url() ?>assets/extra-libs/toastr/toastr-init.js"></script>
    <script src="<?php echo base_url() ?>assets/pnotify/pnotify.custom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/libs/sweetalert2/sweet-alert.init.js"></script> -->
    <script src="<?php echo base_url() ?>assets/extra-libs/c3/d3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/extra-libs/c3/c3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/chart.js/dist/chart.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/gaugeJS/dist/gauge.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/flot/excanvas.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>

    <!-- <script src="<?php echo base_url() ?>assets/libs/jvectormap/jquery-jvectormap.min.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url() ?>dist/js/pages/dashboards/dashboard2.js"></script>

    <script src="<?php echo base_url() ?>assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
    <script src="<?php echo base_url() ?>assets/gridly/js/jquery.gridly.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/@claviska/jquery-minicolors/jquery.minicolors.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/dragula.js"></script>
	<script src="<?php echo base_url() ?>assets/js/example.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


    <script src="<?php echo base_url() ?>assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/select2/dist/js/select2.min.js"></script>



    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!--    <script src="<?php echo base_url() ?>dist/js/pages/datatable/datatable-advanced.init.js"></script>-->




    <script>
    // Date Picker
    
    </script>


</body>

</html>

<script type="text/javascript">
<?php    
if($d->session->flashdata("msg")){
        ?>
    
$(function(){

new PNotify({
    title: '<?php echo $d->session->flashdata("title");?>',
    text: '<?php echo $d->session->flashdata("msg");?>',
    type:'<?php echo $d->session->flashdata("type");?>',
    animate: {
        animate: true,
        in_class: 'bounceInDown',
        out_class: 'fadeOut'
    }
});     
});

<?php
    }
    ?>

$('.form-control').on('blur', function() {
if($.trim($(this).val())=='')
{
$(this).val(''); 
return false;
}
    
});
	
	
$("#msubmit").click(function(){
	
//document.getElementById('link').addEventListener('input', function (){
	
var link = $("#link").val();	
    if(link.match(' ')){
		
		Swal(
		  'Error!',
		  'Spaces Are Not Allowed For Link.',
		  'error'
		);
        return false;
	}
//});	
	
	
});		
	
$("#bsubmit").click(function(){
	
//document.getElementById('link').addEventListener('input', function (){
	
var link = $("#link1").val();	
    if(link.match(' ')){
		
		Swal(
		  'Error!',
		  'Spaces Are Not Allowed For Link.',
		  'error'
		);
        return false;
	}
//});	
	
	
});		

</script>

