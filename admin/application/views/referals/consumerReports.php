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
                        <h4 class="page-title">
<!--
                          <a href="<?php echo base_url() ?>users/create-user">	
							<button class="btn btn-success waves-effect waves-light">Create User</button>
						  </a>	
-->
                        </h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Consumer Referal Reports</li>
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
                    <!-- Column -->
                    <div class="col-lg-12">
                       
                       
                       <div class="row">   
						  <div class="col-md-5">   
							<div class="form-group">
								<label>Select Start & End Date :</label>
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off"  required>
									<div class="input-group-append">
										<span class="input-group-text bg-info b-0 text-white">TO</span>
									</div>
									<input type="text" class="form-control" name="endDate" id="edate" placeholder="End Date" autocomplete="off" required/>
								</div>
							</div>
						  </div>		
				      
					      <div class="col-md-2">
					      	
					      	<button id="filter" type="button" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>
					      	
					      </div> 
						      
					   </div>

                       
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive zero_config">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>City</th>
                                                <th>Order Date</th>
                                                <th>Order ID</th>
                                                <th>Shift</th>
                                                <th>Customer Name</th>
                                                <th>Customer Mobile Number</th>
<!--                                                <th>Registered Date</th>-->
                                                <th>Subscription Start Date</th>
                                                <th>Subscription End Date</th>
                                                <th>Referee Name</th>
                                                <th>Referral Code</th>
                                                <th>Referral Category</th>
                                                <th>Referral Mobile Number</th>
                                                <th>SAP Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Order Category</th>
                                                <th>Renewal Number</th>
                                                <th>UOM</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>City</th>
                                                <th>Order Date</th>
                                                <th>Order ID</th>
                                                <th>Shift</th>
                                                <th>Customer Name</th>
                                                <th>Customer Mobile Number</th>
<!--                                                <th>Registered Date</th>-->
                                                <th>Subscription Start Date</th>
                                                <th>Subscription End Date</th>
                                                <th>Referee Name</th>
                                                <th>Referral Code</th>
                                                <th>Referral Category</th>
                                                <th>Referral Mobile Number</th>
                                                <th>SAP Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Order Category</th>
                                                <th>Renewal Number</th>
                                                <th>UOM</th>
                                            </tr>
                                        </tfoot>
                                        
                                    </table>
                                </div>
                                
                                <div class="table-responsive zero_config1" style="display: none">
                                    <table class="table product-overview table-striped" id="zero_config1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>City</th>
                                                <th>Order Date</th>
                                                <th>Order ID</th>
                                                <th>Shift</th>
                                                <th>Customer Name</th>
                                                <th>Customer Mobile Number</th>
<!--                                                <th>Registered Date</th>-->
                                                <th>Subscription Start Date</th>
                                                <th>Subscription End Date</th>
                                                <th>Referee Name</th>
                                                <th>Referral Code</th>
                                                <th>Referral Category</th>
                                                <th>Referral Mobile Number</th>
                                                <th>SAP Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Order Category</th>
                                                <th>Renewal Number</th>
                                                <th>UOM</th>
                                            </tr>
                                            <tr>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
<!--                                            	<td></td>-->
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            	<td></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>





            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>
<script type="text/javascript">

 jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",

 });	
	
$(".select2").select2();	
	
/*$('#zero_config1 thead tr').clone(true).appendTo( '#zero_config1 thead' );
	$('#zero_config1 thead tr:eq(1) th').each( function (i) {
		var title = $(this).text();
		$(this).html( '<input type="text" placeholder="Search '+title+'" />' );

		$( 'input', this ).on( 'keyup change', function () {
			if ( table.column(i).search() !== this.value ) {
				table
					.column(i)
					.search( this.value )
					.draw();
			}
		} );
	});*/
	
$("#filter").click(function(){
	
	$('#zero_config1 thead tr:eq(1) td').html("");
	var i = 0;
	
	$(".zero_config").hide();
	$(".zero_config1").show();

	var sdate = $("#sdate").val();
	var edate = $("#edate").val();
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("referals/getCustomerreferalreports") ?>",
			"type": "POST",
			"data" : {sdate : sdate, edate : edate},
//			"success" : function(data){
//				
//				console.log(data);
//				
//			},
//			"error" : function(data){
//				
//				console.log(data);
//				
//			} 
  		  },
         "aoColumns": [
			 
               { mData: 'sno' } ,
               { mData: 'city' } ,
               { mData: 'odate' } ,
			   { mData: 'orderid' } ,
               { mData: 'shift' } ,
               { mData: 'cust_name' } ,
               { mData: 'cust_number' } ,
//               { mData: 'reg_date' } ,
               { mData: 'sstdate' },
               { mData: 'ssdate' },
               { mData: 'ref_name' },
               { mData: 'ref_code' },
               { mData: 'ref_cat' },
               { mData: 'ref_number' },
               { mData: 'sap_code' },
               { mData: 'item_name' },
               { mData: 'qty' },
			   { mData: 'ordercat' },
               { mData: 'renewalnumber' },	
               { mData: 'uom' },
               
             ],
          "aaSorting": [[ 0, "asc" ]],
          "bLengthChange": true,
          "pageLength":10,
		  "destroy" : 'true',
		  "dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf','pageLength'
		  ],
		  orderCellsTop: true,
      	  fixedHeader: true	,
		  initComplete: function () {
            this.api().columns().every( function () {
				
//				$("").appendTo( $('#zero_config1 thead tr:eq(1) td').eq( this.index() ) );
				
				
				
                var column = this;
                var colName = (column.context[0].aoColumns[i].sTitle)
				var select = $('<select><option value="">'+colName+'</option></select>')
                    .appendTo( $('#zero_config1 thead tr:eq(1) td').eq( this.index() ) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
				i++;

            } );
        }	
      });
	
})	

 $('#zero_config').DataTable();
	
</script>

            <!-- End footer -->