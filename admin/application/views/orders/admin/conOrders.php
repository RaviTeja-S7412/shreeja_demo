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
                                    <li class="breadcrumb-item active" aria-current="page">Consumer Orders</li>
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
						  <div class="col-md-4">   
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
							<div class="form-group">
								<label>City :</label>
								<div class="form-group">
									
									<select name="city" id="city" class="form-control">
										
										<option value="">Select City</option>
										<?php
											$loc = $this->locations_model->getConsumercities();

											if(count($loc) > 0){
												
											foreach($loc as $l){	
										?>	
										
												<option value="<?php echo $l->id ?>"><?php echo $l->location ?></option> 

										<?php }} ?>
										
									</select>
									
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
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>UOM</th>
<!--                                                <th>Order Date</th>-->
                                                <th>Delivery Date</th>
                                                <th>Customer Name</th>
                                                <th>Customer Number</th>
                                                <th>Order ID</th>
                                                <th>Type of Order</th>
                                                <th>Shift</th>
                                                <th>Net Amount</th>
                                                <th>SGST%</th>
                                                <th>CGST%</th>
                                                <th>SGST Amount</th>
                                                <th>CGST Amount</th>
                                                <th>Total Amount</th>
                                                <th>Invoice Number</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                                
                                <div class="table-responsive zero_config1" style="display: none">
                                    <table class="table product-overview table-striped" id="zero_config1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>UOM</th>
<!--                                                <th>Order Date</th>-->
                                                <th>Delivery Date</th>
                                                <th>Customer Name</th>
                                                <th>Customer Number</th>
                                                <th>Order ID</th>
                                                <th>Type of Order</th>
                                                <th>Shift</th>
                                                <th>Net Amount</th>
                                                <th>SGST%</th>
                                                <th>CGST%</th>
                                                <th>SGST Amount</th>
                                                <th>CGST Amount</th>
                                                <th>Total Amount</th>
                                                <th>Invoice Number</th>
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
	
	
$("#filter").click(function(){
	
	$(".zero_config").hide();
	$(".zero_config1").show();

	var sdate = $("#sdate").val();
	var edate = $("#edate").val();
	var shift = $("#shift").val();
	var city = $("#city").val();
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("orders/Consumerorders/filterconsumersOrders") ?>",
			"type": "POST",
			"data" : {sdate : sdate, edate : edate, shift : shift,city:city},
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
               { mData: 'Item_Code' } ,
               { mData: 'Item_name' },
               { mData: 'Quantity' },
               { mData: 'UOM' },
               { mData: 'orderDate' },
               { mData: 'Name' },
               { mData: 'Number' },
               { mData: 'Orderid' },
               { mData: 'ordertype' },
               { mData: 'shift' },
               { mData: 'Amount' },
               { mData: 'SGST' },
               { mData: 'CGST' },
               { mData: 'SGST_amount' },
               { mData: 'CGST_amount' },
               { mData: 'TotalAmount' },
               { mData: 'Invoice' },
			 
             ],
          "aaSorting": [[ 0, "asc" ]],
          "bLengthChange": true,
          "pageLength":10,
		  "destroy" : 'true',
		  "dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf','pageLength'
		  ]	
      });
	
})	
	
	
	var table = $('#zero_config').dataTable({
//         "bProcessing": true,
//         "ajax": {
//			"url": "<?php //echo base_url("orders/Consumerorders/consumersOrders") ?>",
// 
//  		  },
//         "aoColumns": [
//			 
//               { mData: 'sno' } ,
//               { mData: 'Item_Code' } ,
//               { mData: 'Item_name' },
//               { mData: 'Quantity' },
//               { mData: 'UOM' },
//               { mData: 'orderDate' },
//               { mData: 'Name' },
//               { mData: 'Number' },
//               { mData: 'Orderid' },
//               { mData: 'ordertype' },
//               { mData: 'shift' },
//               { mData: 'Amount' },
//               { mData: 'SGST' },
//               { mData: 'CGST' },
//               { mData: 'SGST_amount' },
//               { mData: 'CGST_amount' },
//               { mData: 'TotalAmount' },
//               { mData: 'Invoice' },
//			 ],
//          "aaSorting": [[ 0, "asc" ]],
//          "bLengthChange": true,
//          "pageLength":10,
//		  "destroy" : 'true',

      });
	
</script>

            <!-- End footer -->