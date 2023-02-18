<?php front_inner_header(); 
date_default_timezone_set('Asia/Kolkata');

$o = $this->db->get_where("orders",array("order_id"=>$this->uri->segment(3)))->row();


?>

		
<link href="<?php echo base_url("admin/") ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
								
<link rel="stylesheet" type="text/css" href="<?php echo base_url("admin/") ?>assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
		  
			
        <!-- Main Content Started -->
		
<div class="main-content">

<div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>S.No</th>
                                                <th>Order Id</th>
                                                <th>Delivery Date</th>
                                                <th>Pause Order</th>
                                                <th>Delivery Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
	  								

								// 			if($cdate >= 18){
								// 				$date = date("d-m-Y", strtotime("+ 1 day"));
								// 			}else{
								// 				$date = date("d-m-Y");
								// 			}
	  
	  
								   foreach ($ord as $u) { 
									   
									    $odata = $this->db->get_where("orders",array("order_id"=>$u->order_id))->row();
									   

										$cdate = strtotime(date("d-m-Y")); 
									    $tdate = date("d-m-Y", strtotime("+ 1 day"));
										$ddate = strtotime($u->delivery_date);

									    $disable = "";
									   
										if($ddate < $cdate){

											$disable = "true";

										}   
											   
										
									   
									   
										if($cdate == $ddate){

											$pTime = date("d-m-H");
											
											if($odata->deliveryShift == "evening"){

												if($pTime < date("d-m-")."12"){

													$disable = "false";

												}else{

													$disable = "true";

												}
											}else{

    											$disable = "true";
    
    										}

										}
									   
									   if(strtotime($tdate) == $ddate){

											$pTime = date("d-m-H");
											
											if($odata->deliveryShift == "morning"){
											   

												if($pTime < date("d-m-")."17"){

													$disable = "false";

												}else{

													$disable = "true";

												}
											}


										}
										
										if(strtotime($odata->sub_start_date) == $ddate){

											$disable = "true";

										}
                                           ?> 

                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td><? echo $u->pause_status ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->order_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo date("d-M-Y",strtotime($u->delivery_date)); ?></td>
                                                <td style="padding: 0.5rem;">
                                                
                                                <?php if($u->pause_status=="Active"){ ?>
                                                   <input type="checkbox" data-on-color="info" nav_id="<?php echo $u->id ?>" oid="<?php echo $u->order_id ?>" name="switch" data-off-color="success" class="check" checked <?php echo ($disable == "true" || $o->order_status == "Cancelled") ? "disabled" : "" ?>>
                                                   <?php  }elseif($u->pause_status=="Inactive"){ ?>
                                                    <input type="checkbox" nav_id="<?php echo $u->id ?>" oid="<?php echo $u->order_id ?>" data-on-color="info" name="switch" data-off-color="success" class="check" <?php echo ($disable == "true" || $o->order_status == "Cancelled") ? "disabled" : "" ?>>
                                                   <?php } ?>	
                                                </td>
                                                

                                                <td style="padding: 0.5rem;"><?php
											   
											  if($o->order_status == "Cancelled"){
												  
												  $canDate = strtotime($o->cancelledDate);
												  											  
												  if($canDate <= strtotime($ddate)){
													  
													  echo '<span class="badge badge-danger" style="color:white">Cancelled</span>';
												  }else{
													  
													  if($u->deliver_status == "Success"){

															echo '<span class="badge badge-success" style="color:white">Success</span>';
														}elseif($u->deliver_status == "Pending"){

															echo '<span class="badge badge-warning" style="color:white">Pending</span>';
														}else{
															echo $u->deliver_status;
														}
												  }
												  
											  }else{ 
											   
													if($u->deliver_status == "Success"){

														echo '<span class="badge badge-success" style="color:white">Success</span>';
													}elseif($u->deliver_status == "Pending"){

														echo '<span class="badge badge-warning" style="color:white">Pending</span>';
													}else{
														echo $u->deliver_status;
													}
											  }
										?></td>
                                            </tr>
                                     <?php  
                                    
                                       }
                                     ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>



</div>
				
<?php front_inner_footer() ?>

<script src="<?php echo base_url("admin/") ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url("admin/") ?>assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url("admin/") ?>assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

<script type="text/javascript">


$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
$('#zero_config').DataTable({
	"pageLength": 100
});

$('#zero_config').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
	  
var nav_id = $(this).attr("nav_id"); 
var oid = $(this).attr("oid"); 

	var status;

	if ($(this).is(":checked")){
		status = "Active";
	}else{
		status = "Inactive";
	}
	$.ajax({
		type:"POST",
		url:"<?php echo base_url();?>home/pauseOrder",
		data:{id:nav_id,oid:oid,status:status},
		success:function (data){
			console.log(data);
			
			if(data == 1){
				
				 Swal(
				  'Success',
				  'Order Paused Successfully',
				  'success',

				)
			location.reload();	 
			}else if(data == 0){
				
				 Swal(
				  'Success',
				  'Order Unpaused Successfully',
				  'success',

				)
			location.reload();				 
			}else{
				
				Swal(
				  'Error!',
				  data,
				  'error'
				);
			}
			
//			location. reload(true);
		},
		error : function(data){
			
			console.log(data);
		}

	});  
});	
	

</script>


