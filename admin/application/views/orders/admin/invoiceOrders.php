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
                                    <li class="breadcrumb-item active" aria-current="page">Invoice Orders</li>
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
                       
                       
<!--
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
						 
				      	  <div class="col-md-3">   
							<div class="form-group">
								<label>Shift :</label>
								<div class="form-group">
									
									<select name="shift" id="shift" class="form-control">
										
										<option value="">Select Shift</option>
										<option value="morning">Morning</option>
										<option value="evening">Evening</option>
										
									</select>
									
								</div>
							</div>
						  </div>	
				      
					      <div class="col-md-3">
					      	
					      	<button id="filter" type="button" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>
					      	
					      </div> 
						      
					   </div>
-->
                       
                       
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive zero_config">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Delivery Address</th>
                                                <th>Consumer Address</th>
                                                <th>Delivery Date</th>
                                                <th>Type of Order</th>
                                                <th>Shift</th>
                                                <th>Assigned To</th>
                                                <th>Delivery Status</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                                
<!--
                                <div class="table-responsive zero_config1" style="display: none">
                                    <table class="table product-overview table-striped" id="zero_config1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Delivery Address</th>
                                                <th>Consumer Address</th>
                                                <th>Delivery Date</th>
                                                <th>Type of Order</th>
                                                <th>Shift</th>
                                                <th>Assigned To</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
-->
                                
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                
                
           <div id="myModal<?php //echo $i; ?>" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<h4 class="modal-title" align="center">Update Status</h4>
							  </div>
							  <div class="modal-body">
							  
								<div class="danger"></div>
								<form method="post" action="<?php echo base_url("orders/Invoiceorders/updateDeliverystatus") ?>">

									<div class="form-group">

										<select class="form-control dstatus" name="deliveryStatus" id="" required>

											<option value="">Select Delivery Status</option>
											<option value="Pending">Pending</option>
											<option value="Success">Success</option>
<!--											<option value="Cancelled">Cancelled</option>-->
<!--											<option value="other">Other</option>-->

										</select>

									</div>

<!--
									<div class="form-group ostatus" id="" style="display: none">

										<input type="text" name="ostatus" placeholder="Delivery Status" class="form-control">

									</div>
-->

									<div class="form-group">
                                       <input type="hidden" name="oid" class="ordid">           
                                       <input type="hidden" name="orderType" class="orderType">           
                                       <button type="submit" class="btn btn-success submit" style="margin-top: 5px; width: 50%">Update</button>
										
									</div>
								</form>	

							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						  </div>
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

$("#zero_config").on("click",".getOid",function(){
	
	$("#myModal").modal("show");
	
	var oid = $(this).attr("id");
	var oType = $(this).attr("orderType");
	
	$(".ordid").val(oid);
	$(".orderType").val(oType);
	
});	
	
	
 jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",

 });	
	
//	
//$("#filter").click(function(){
//	
//	$(".zero_config").hide();
//	$(".zero_config1").show();
//
//	var sdate = $("#sdate").val();
//	var edate = $("#edate").val();
//	var shift = $("#shift").val();
//	
//	var table = $('#zero_config1').dataTable({
//         "bProcessing": true,
//         "ajax": {
//			"url": "<?php echo base_url("orders/Consumerorders/filterallOrders") ?>",
//			"type": "POST",
//			"data" : {sdate : sdate, edate : edate, shift : shift},
////			"success" : function(data){
////				
////				console.log(data);
////				
////			},
////			"error" : function(data){
////				
////				console.log(data);
////				
////			} 
//  		  },
//         "aoColumns": [
//			 
//               { mData: 'sno' } ,
//               { mData: 'Date' } ,
//               { mData: 'Order_ID' },
//               { mData: 'Name' },
//               { mData: 'Mobile' },
//               { mData: 'Address' },
//               { mData: 'cAddress' },
//               { mData: 'Delivery_Date' },
//               { mData: 'Type_of_Order' },
//               { mData: 'shift' },
//               { mData: 'Assigned_To' },
//               { mData: 'Status' },
//			 
//             ],
//          "aaSorting": [[ 0, "asc" ]],
//          "bLengthChange": true,
//          "pageLength":10,
//		  "destroy" : 'true',
//		  "dom": 'Bfrtip',
//		  "buttons": [
//			 'csv', 'excel', 'pdf'
//		  ]	
//      });
//	
//})	
	
	
	var table = $('#zero_config').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("orders/Invoiceorders/allOrders") ?>",
 
  		  },
         "aoColumns": [
			 
               { mData: 'sno' } ,
               { mData: 'Date' } ,
               { mData: 'Order_ID' },
               { mData: 'Name' },
               { mData: 'Mobile' },
               { mData: 'Address' },
               { mData: 'cAddress' },
               { mData: 'Delivery_Date' },
               { mData: 'Type_of_Order' },
               { mData: 'shift' },
               { mData: 'Assigned_To' },
               { mData: 'Status' },
               { mData: 'oStatus' },
               { mData: 'action' },
             ],
          "aaSorting": [[ 0, "asc" ]],
          "bLengthChange": true,
          "pageLength":10,
		  "destroy" : 'true',
		  "dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf'
		  ]	
      });
	
</script>

            <!-- End footer -->