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
                                    <li class="breadcrumb-item active" aria-current="page">All Delivered Orders</li>
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
						  <div class="col-md-3">   
							<div class="form-group">
								<label>Select Date :</label>
								<div class="input-group">
									<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Select Date" autocomplete="off"  required>
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
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
                                                <th>Shift</th>
                                                <th>Delivery Address</th>
                                                <th>Consumer Address</th>
                                                <th>Order Type</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Status</th>
<!--                                                <th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
			   <?php 
			   $i = 1;

			   foreach ($doo as $u) {

				   
				   if(json_decode($u->user_data)){
											   
						$udata = json_decode($u->user_data);

				   }else{

					   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id))->row();	   

				   }
				   
				$orderpro =	$this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();

				if(($u->order_type == "deliveryonce" && $u->delivery_status == "Success") || $u->order_type == "freesample"){


			   ?> 

								<tr>
									<td style="padding: 0.5rem;"><?php echo $i ?></td>
									<td style="padding: 0.5rem;"><?php echo $u->order_id ?></td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_name ?></td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_mobile ?></td>

							   <?php

								   if($u->order_type == "freesample"){
								?>	   

									<td style="padding: 0.5rem;"><?php 
									   
									   if(json_decode($u->product_data)){

											$pdata1 = json_decode($u->product_data);

										}else{

											$pdata1 = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row();

										}

									   echo $pdata1->product_name." ".$u->qty." (Free)<br>";  ?>

								   </td>
									<td style="padding: 0.5rem;">1</td>

								<?	   
								   }else{
								   ?>

									<td style="padding: 0.5rem;">

										<?php 

											foreach($orderpro as $op){

												if(json_decode($op->product_data)){

													$pdata = json_decode($op->product_data);

												}else{

													$pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"assigned_to"=>"consumers"))->row();

												}
												
												echo $pdata->product_name." ".$op->category."<br>"; 

											}

										?>

									</td>

									<td style="padding: 0.5rem;">

										<?php 

											foreach($orderpro as $op){

												echo $op->qty."<br>"; 

											}

										?>

									</td>
								<? } ?>   
									<td style="padding: 0.5rem;"><?php echo $u->deliveryShift ?></td>
									<td style="padding: 0.5rem;"><?php echo nl2br($u->shipping_address) ?></td>
                                    <td style="padding: 0.5rem;"><?php echo $udata->user_current_address; ?></td>
									<td style="padding: 0.5rem;"><?php echo $u->order_type ?></td>
									<td style="padding: 0.5rem;"><?php echo $u->deliverydate ?></td>

									<td style="padding: 0.5rem;" align="center">
									<?php	

										if($u->delivery_status == "Success"){

											echo '<span class="badge badge-success" style="color:white">Success</span>';
										}elseif($u->delivery_status == "Pending"){

											echo '<span class="badge badge-warning" style="color:white">Pending</span>';
										}else{
											echo '<span class="badge badge-danger" style="color:white">Failed</span>';
										}

									?>
								   </td>


								</tr>

		<? }elseif($u->order_type == "subscribe"){
					
				$sdata = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u->order_id,"deliver_status"=>'Success',"pause_status"=>"Inactive"))->result();
											
				$oop =	$this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();	
					
					
				foreach($sdata as $sd){ 	
			?>		        

					<tr>
									<td style="padding: 0.5rem;"><?php echo $i ?></td>
									<td style="padding: 0.5rem;"><?php echo $u->order_id ?></td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_name ?></td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_mobile ?></td>


									<td style="padding: 0.5rem;">

										<?php 

											foreach($orderpro as $op){

												if($op->orderRef != "offer"){
												
													if(json_decode($op->product_data)){

														$pdata = json_decode($op->product_data);

													}else{

														$pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id,"assigned_to"=>"consumers"))->row();

													}


													echo $pdata->product_name." ".$op->category."<br>"; 
													
												}

											}
					
											if(json_decode($oop->product_data)){

												$pdata = json_decode($oop->product_data);

											}else{

												$pdata = $this->db->get_where("tbl_products",array("id"=>$oop->product_id,"assigned_to"=>"consumers"))->row();

											}
			  												
											if(strtotime($sd->delivery_date) == strtotime($u->sub_start_date)){

												echo $pdata->product_name." ".$oop->category." (Free), <br>";
											}

										?>

									</td>

									<td style="padding: 0.5rem;">

										<?php 

											foreach($orderpro as $op){
												if($op->orderRef != "offer"){	
													echo $op->qty."<br>"; 
												}
											}
					
											if(strtotime($sd->delivery_date) == strtotime($u->sub_start_date)){

												echo $oop->qty.", <br>";
											}

										?>

									</td>
									<td style="padding: 0.5rem;"><?php echo $u->deliveryShift ?></td>
									<td style="padding: 0.5rem;"><?php echo nl2br($u->shipping_address) ?></td>
                                    <td style="padding: 0.5rem;"><?php echo $udata->user_current_address; ?></td>
									<td style="padding: 0.5rem;"><?php echo $u->order_type ?></td>
									<td style="padding: 0.5rem;"><?php echo $sd->delivery_date ?></td>

									<td style="padding: 0.5rem;" align="center">
									<?php	

								   if($u->order_type == "subscribe"){

										$sstatus = isset($sd->deliver_status) ? $sd->deliver_status : ""; 
										if($sstatus == "Success"){

											echo '<span class="badge badge-success" style="color:white">Success</span>';
										}elseif($sstatus == "Pending"){

											echo '<span class="badge badge-warning" style="color:white">Pending</span>';
										}else{
											echo '<span class="badge badge-danger" style="color:white">Failed</span>';
										}

								   }

									?>
								   </td>


								</tr>
					 
					 
					 
					 
					 
					 
						 <?php  
						$i++;
						   }}}
						 ?> 

							</tbody>
						</table>
					</div>
					
					
					<div class="table-responsive zero_config1" style="display: none">
					   <table class="table product-overview table-striped" id="zero_config1">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Order ID</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Item Name</th>
									<th>Item Qty</th>
									<th>Delivery Address</th>
									<th>Consumer Address</th>
									<th>Order Type</th>
									<th>Shift</th>
									<th>Delivery Date</th>
									<th>Delivery Status</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
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
$(document).ready(function(){	
	var date = new Date();
	date.setDate(date.getDate());

	jQuery('#sdate').datepicker({
		autoclose: true,
		todayHighlight: true,
//		startDate: date
	});
});	
	
$("#filter").click(function(){
	
	$(".zero_config").hide();
	$(".zero_config1").show();

	var sdate = $("#sdate").val();
//	var edate = $("#edate").val();
	var shift = $("#shift").val();
	var city = $("#city").val();
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("agent-orders/filterallDeliveredorders") ?>",
			"type": "POST",
			"data" : {sdate : sdate, shift : shift,city:city},
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
               { mData: 'Order_ID' },
               { mData: 'Name' },
               { mData: 'Mobile' },
               { mData: 'itemName' },
               { mData: 'qty' },
               { mData: 'Address' },
               { mData: 'cAddress' },
               { mData: 'orderType' },
               { mData: 'shift' },
               { mData: 'Delivery_Date' },
               { mData: 'Status' },
			 
             ],
          "aaSorting": [[ 0, "asc" ]],
          "bLengthChange": true,
          "pageLength":10,
		  "destroy" : 'true',
		  "dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf'
		  ],
	
      });
	
})	
	
	
	
	
//$('#zero_config').DataTable({
//    dom: 'Bfrtip',
//    buttons: [
//         'csv', 'excel', 'pdf'
//    ],
//			  exportOptions: {
//    columns: [2, 3, 4, 5, 6, 7, 8, 9],
//    format: {
//        body: function ( data, row, column, node ) {
//               if (column === 3) {
//                    //need to change double quotes to single
//                    data = data.replace( /"/g, "'" );
//                    //split at each new line
//                    splitData = data.split('\n');
//                    data = '';
//                    for (i=0; i < splitData.length; i++) {
//                        //add escaped double quotes around each line
//                        data += '\"' + splitData[i] + '\"';
//                        //if its not the last line add CHAR(13)
//                        if (i + 1 < splitData.length) {
//                            data += ', CHAR(10), ';
//                        }
//                    }
//                    //Add concat function
//                    data = 'CONCATENATE(' + data + ')';
//                    return data;
//                }
//                return data;
//            }
//        }
//    },
//
//});	
	
var fixNewLine = {
        exportOptions: {
            format: {
                body: function ( data, column, row ) {
                    return column === 5 ?
                        data.replace( /<br\s*\/?>/gmi, '\n' ) :
                        data;
                }
            }
        }
    };
 
 
    $('#zero_config').DataTable({
        dom: 'Bfrtip',
        buttons:[
            $.extend( true, {}, fixNewLine, {
                extend: 'copyHtml5'
            } ),
            $.extend( true, {}, fixNewLine, {
                extend: 'excelHtml5'
            } ),
            $.extend( true, {}, fixNewLine, {
                extend: 'pdfHtml5'
            } )
        ]
 
    });
	
$(".dstatus").change(function(){
	
	var dstatus = $(".dstatus").val();
	
	if(dstatus == "other"){
		
		$(".ostatus").show();
		
		$(".ostatus").attr("required","required");
		
	}else{
		
		$(".ostatus").hide();
		$(".ostatus").removeAttr("required","required");		
	}
	
});
	
$("#zero_config").on("click",".getOid",function(){
	
	var oid = $(this).attr("id");
	var soid = $(this).attr("soid");
	var oType = $(this).attr("orderType");
	
	$("."+soid).val(oid);
	$("."+oid).val(oType);
	
});
	
</script>

            <!-- End footer -->