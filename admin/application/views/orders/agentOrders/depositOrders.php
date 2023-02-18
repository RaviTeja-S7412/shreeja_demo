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
                                    <li class="breadcrumb-item active" aria-current="page">Deposit Orders</li>
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
						  <div class="col-md-6">   
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
                                                <th>Customer Number</th>
                                                <th>Customer Name</th>
                                                <th>Deposit Date</th>
                                                <th>Bank Name</th>
                                                <th>Transaction ID</th>
                                                <th>Transaction amount</th>
                                                <th>Image</th>
<!--                                                <th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
		   <?php 
		   $i = 0;
		   foreach ($orders as $u) { 

		   $products = json_decode($u->product_id);	    	

		     $aData = $this->db->get_where("fdm_va_auths",array("id"=>$u->agent_id))->row();
		 

		   ?> 

					<tr>
						<td style="padding: 0.5rem;"><?php echo ++$i ?></td>
						<td>   
						   <?php  
								echo $this->db->get_where("tbl_locations",["id"=>$u->city])->row()->location;
							?>
						</td>
					   <td>   
						   <?php  
								echo $aData->agent_id; 
							?>
						</td>
						<td>   
						   <?php  
							
								echo $aData->name; 
							?>
						</td>
						
						<td style="padding: 0.5rem;"><?php echo ($u->transaction_date != "") ? date("d.m.Y",strtotime($u->transaction_date)) : "" ?></td>
						<td style="padding: 0.5rem;"><?php echo $u->bank_name ?></td>
						<td style="padding: 0.5rem;"><?php echo $u->transaction_number ?></td>
						<td style="padding: 0.5rem;"><?php echo $u->amount ?></td>
						
						<?php $image = ($u->transaction_document != "") ? '<a target="_blank" href="'.base_url('orders/depositOrders/transactiondocuments/').$u->order_id.'" class="btn btn-info waves-effect waves-light">View</a>' : "";  ?>
						
						<td style="padding: 0.5rem;"><?php if($image != ""){ ?><?php echo $image ?><?php } ?></td>
						
						
<!--
						<td style="padding: 0.5rem;" align="center">
							<a href="<?php echo base_url() ?>agent-products/updateOrder/<?php echo $u->order_id ?>" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a>
							<a href="<?php echo base_url() ?>agent-products/delOrder/<?php echo $u->order_id ?>" class="text-inverse p-r-10" onClick="return confirm('Are you sure want to cancel this order')"><i class="fas fa-trash" style="color: black"></i></a>

						</td>
-->




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
                                                <th>City</th>
                                                <th>Customer Number</th>
                                                <th>Customer Name</th>
                                                <th>Deposit Date</th>
                                                <th>Bank Name</th>
                                                <th>Transaction ID</th>
                                                <th>Transaction amount</th>
                                                <th>Image</th>
<!--                                                <th>Action</th>-->
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
	
$("#zero_config").dataTable();

$("#filter").click(function(){
	
	$(".zero_config").hide();
	$(".zero_config1").show();

	var sdate = $("#sdate").val();
	var edate = $("#edate").val();
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("orders/agent-orders/filterdepositOrders") ?>",
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
               { mData: 'mobile_number' } ,
               { mData: 'name' },
               { mData: 'transaction_date' },
               { mData: 'bank_name' },
               { mData: 'transaction_number' },
              { mData: 'amount' },
              { mData: 'image' },
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