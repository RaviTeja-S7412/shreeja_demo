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
                                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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
							<div class="form-group">
								<label>Select Shift :</label>
								
								<select class="form-control" name="shift" id="shift">
								    
								    <option value="">Select Shift</option>
								    <option value="morning">Morning</option>
								    <option value="evening">Evening</option>
								    
								</select>
								
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
<!--
                                                <th>Customer Number</th>
                                                <th>Customer Name</th>
-->
                                                <th>Item Code</th>
                                                <th>Product Name</th>
                                                <th>Date</th>
                                                <th>Shift</th>
                                                <th>Quantity</th>
                                                <th>Unit of measurement</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
		   <?php 
		   $i = 0;
		   foreach ($orders as $u) { 

		   $products = json_decode($u->product_id);	    	

		      $cdata = $this->db->get_where("fdm_va_auths",array("id"=>$u->created_by))->row();

		   ?> 

					<tr>
						<td style="padding: 0.5rem;"><?php echo ++$i ?></td>
						<td>   
						   <?php  
							foreach($products as $p){

								echo $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_id."<br>"; 

							}
							?>
						</td>
						<td>   
						   <?php  
							foreach($products as $p){

								echo $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_name." ".$p->category."<br>"; 

							}
							?>
						</td>
						
						<td style="padding: 0.5rem;"><?php echo date("d.m.Y",strtotime($u->delivery_date)) ?></td>
					
						<td style="padding: 0.5rem;"><?php echo $u->order_delivery_time ?></td>
						
						<td style="padding: 0.5rem;">
						<?php  
							foreach($products as $qty){
								
							 	echo $qty->productQty."<br>";
								
							}
							?>
						</td>		
												
						<td style="padding: 0.5rem;">
						<?php  
							foreach($products as $qty){
								
							 	echo $qty->qtyType."<br>";
								
							}
							?>
						</td>
						
						<td style="padding: 0.5rem;"><? echo $cdata->name ." (".$this->db->get_where("fdm_va_roles",array("id"=>$cdata->role))->row()->role_name.")"  ?></td>

						<td style="padding: 0.5rem;" align="center">
							<a href="<?php echo base_url() ?>agent-products/updateOrder/<?php echo $u->order_id ?>" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a>
<!--							<a href="<?php echo base_url() ?>agent-products/delOrder/<?php echo $u->order_id ?>" class="text-inverse p-r-10" onClick="return confirm('Are you sure want to cancel this order')"><i class="fas fa-trash" style="color: black"></i></a>-->

						</td>




					</tr>
			 <?php  

			   }
			 ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                                 <div class="table-responsive zero_config1" style="display: none">

										<table class="table product-overview table-striped" id="zero_config1">
											<thead>
												<tr>
													<th>S.No</th>
	<!--
													<th>Customer Number</th>
													<th>Customer Name</th>
	-->
													<th>Item Code</th>
													<th>Product Name</th>
													<th>Date</th>
													<th>Shift</th>
													<th>Quantity</th>
													<th>Unit of measurement</th>
													<th>Created By</th>
													<th>Action</th>
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
$("#zero_config").dataTable();
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
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("agent-products/filtermyorders") ?>",
			"type": "POST",
			"data" : {sdate : sdate, edate : edate,shift:shift},
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
               { mData: 'product_id' } ,
               { mData: 'product_name' } ,
               { mData: 'delivery_date' } ,
               { mData: 'order_delivery_time' } ,
               { mData: 'productQty' },
               { mData: 'qtyType' },
               { mData: 'cby' },
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

 /*$('#my-example tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        location.href="showTransaction?cid="+data.TxnId;
    } )*/;
	
})	
	
</script>

            <!-- End footer -->