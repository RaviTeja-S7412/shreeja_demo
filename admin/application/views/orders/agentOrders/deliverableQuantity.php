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
       
<style>
	/*td .category{
		background-color: black;
	}*/

</style>       
       
       
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
                                    <li class="breadcrumb-item active" aria-current="page">Deliverable Quanity</li>
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
            
         <? $role = $this->admin->get_admin("role");
			 $aagt = json_decode($this->admin->get_admin("assigned_agents"));
		  ?>   
            
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                       <div class="row">
                       
                       <? if($role == 7 || $role == 11 || $role == 12 || $role == 10 || $role == 1){ 
						   
						   if($role == 11 || $role == 10 || $role == 1){
							   
							   if($role == 10 || $role == 1){
							   $ams = $this->db->get_where("fdm_va_auths",["role"=>11,"status"=>"Active","deleted"=>0])->result();
							   
							   
							   
					   ?> 
                         
							  <div class="col-md-3">   
								<div class="form-group">
									<label>Area Manager</label>
									<div class="form-group">

										<select name="am" id="am" class="form-control">

											<option value="">Select AM</option>
											<? foreach($ams as $am){ ?>
											
											<option value="<? echo $am->id ?>"><? echo $am->name; ?></option>
											
											<? } ?>
										</select>

									</div>
								</div>
								
							  </div> 
					<? } ?>		  
							  
							  <div class="col-md-3">   
								<div class="form-group">
									<label>Teritary Incharge</label>
									<div class="form-group">

										<select name="ti" id="ti" class="form-control">

											<option value="">Select TI</option>
											<? foreach($aagt->tincharge as $ti){ ?>
											
											<option value="<? echo $ti ?>"><? echo $this->admin->get_admin("name",$ti); ?></option>
											
											<? } ?>
										</select>

									</div>
								</div>
							  </div>
                        
                        	  <div class="col-md-3">   
								<div class="form-group">
									<label>Sales Employees</label>
									<div class="form-group">

										<select name="bda" id="bda" class="form-control">

											<option value="">Select BDA</option>

										</select>

									</div>
								</div>
							  </div>
                           
                           	  <div class="col-md-3">   
								<div class="form-group">
									<label>Agents</label>
									<div class="form-group">

										<select name="agents" id="agents" class="form-control">

											<option value="">Select Agent</option>
                                            <? if($role != 11){ $allAgents = $this->db->where_in("role",["2","3","4","5","13"])->get_where("fdm_va_auths",["deleted"=>0])->result(); 
											    foreach($allAgents as $agttt){
											        $role1 = $this->db->get_where("fdm_va_roles",array("id"=>$agttt->role))->row()->role_name;
											        
											        echo '<option value="'.$agttt->id.'">'.$agttt->name.' ('.$role1.')'.'</option>';
											    }}
											?>
										</select>

									</div>
								</div>
							  </div>	
                            
                        <? }
						   if($role == 12){?> 
                            
                            
                            <div class="col-md-3">   
								<div class="form-group">
									<label>Sales Employees</label>
									<div class="form-group">

										<select name="bda" id="bda" class="form-control">

											<option value="">Select BDA</option>

											<? 
										    $semp = isset($aagt->salesemployees) ? $aagt->salesemployees : []; 
										   	foreach($semp as $agts){  ?>
											
											<option value="<? echo $agts ?>"><? echo $this->admin->get_admin("name",$agts); ?></option>
											
											<? } ?>
									
										</select>

									</div>
								</div>
							  </div>
                           
                           	  <div class="col-md-3">   
								<div class="form-group">
									<label>Agents</label>
									<div class="form-group">

										<select name="agents" id="agents" class="form-control">

											<option value="">Select Agent</option>
											

										</select>

									</div>
								</div>
							  </div>
                            
                             
                       <? }if($role == 7){ ?>
                       
                       		  <div class="col-md-3">   
								<div class="form-group">
									<label>Agents</label>
									<div class="form-group">

										<select name="agents" id="agents" class="form-control">

											<option value="">Select Agent</option>
											
											<? foreach($aagt->agents as $ag){ ?>
											
											<option value="<? echo $ag ?>"><? echo $this->admin->get_admin("name",$ag); ?></option>
											
											<? } ?>

										</select>

									</div>
								</div>
							  </div>

						<? 	}} ?>              
                             
						  <div class="col-md-3">   
							<div class="form-group">
								<label>Select Date :</label>
								<div class="input-daterange input-group" id="date-range">
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
			      
			      	  <? if($role == 1 || $role == 6 || $role == 10){ ?>  	
				      
				      	<div class="col-md-3">   
							<div class="form-group">
								<label>City :</label>
								<div class="form-group">
									
									<select name="city" id="city" class="form-control">
										
										<option value="">Select City</option>
										<?php
											$loc = $this->locations_model->getAgentcities();

											if(count($loc) > 0){
												
											foreach($loc as $l){	
										?>	
										
												<option value="<?php echo $l->id ?>"><?php echo $l->location ?></option> 

										<?php }} ?>
										
									</select>
									
								</div>
							</div>
						  </div>		
				      
				      <? } ?>
				      
					      <div class="col-md-3">
					      	
					      	<button id="filter" type="button" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>
					      	
					      </div> 
						      
					   </div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive zero_config">
                                    <table class="table product-overview" id="zero_config">
                                        <thead>
                                            <tr>
<!--                                                <th>S.No</th>-->
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>UOM</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                                
                                
                                 <div class="table-responsive zero_config1" style="display: none">
                                    <table class="table product-overview" id="zero_config1">
                                        <thead>
                                            <tr>
<!--                                                <th>S.No</th>-->
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>UOM</th>
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
	
$(document).ready(function(){	
//var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());	
	
//jQuery('#date-range').datepicker({
//        toggleActive: true,
//		minDate: 0,
//		dateFormat: "dd-mm-yy",
////		setDate : today
//
// });
	
	$("#sdate").datepicker();
	
});	
	
$("#filter").click(function(){
	
	$(".zero_config").hide();
	$(".zero_config1").show();

	var am = $("#am").val();
	var ti = $("#ti").val();
	var bda = $("#bda").val();
	var agents = $("#agents").val();
	var sdate = $("#sdate").val();
	var shift = $("#shift").val();
	var city = $("#city").val();
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("orders/agent-orders/allProductquantity") ?>",
			"type": "POST",
			"data" : {am : am,ti : ti ,bda : bda , agent : agents,sdate : sdate, shift : shift,city:city},
// 			"success" : function(data){
				
// 				console.log(data);
				
// 			},
// 			"error" : function(data){
				
// 				console.log(data);
				
// 			} 
  		  },
         "aoColumns": [
			 
//               { mData: 'sno' } ,
               { mData: 'pcode' },
               { mData: 'pname' },
               { mData: 'packets' },
               { mData: 'uom' },
			 
             ],
          "aaSorting": false,
          "bLengthChange": true,
          "pageLength":50,
		  "destroy" : 'true',
		  "dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf'
		  ]	
      });
	
})	
	
$(document).ready(function(){

<? if($role == 11 || $role == 10 || $role == 1){ ?>	
	
	$('#zero_config').dataTable();
	
<? }else{ ?>	
	var table = $('#zero_config').dataTable({
         "bProcessing": true,
//		"type": "POST",
//		"data" : {sdate : "1234"},
         "ajax": {
			"url": "<?php echo base_url("orders/agent-orders/allProductquantity") ?>",
// 			"success" : function(data){
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
			 
//               { mData: 'sno' } ,
               { mData: 'pcode' },
               { mData: 'pname' },
               { mData: 'packets' },
               { mData: 'uom' },
			 ],
          "aaSorting": false,
          "bLengthChange": true,
          "pageLength":50,
		  "destroy" : 'true',
		"dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf'
		  ]	

      });
	
<? } ?>	
	
});
	
// filter agents

	$("#city").change(function(){


		var i=$("#city").val();

		$.ajax({
			url:"<?php echo base_url();?>orders/agent-orders/getfilterams",
			data:{id:i},
			type:"GET",
			success:function(data){

				$("#am").html(data);
			}
		})
	});
	
	$("#am").change(function(){


		var i=$("#am").val();

		$.ajax({
			url:"<?php echo base_url();?>orders/agent-orders/getdqTi",
			data:{id:i},
			type:"GET",
			success:function(data){

				$("#ti").html(data);
			}
		})
	});
	
	$("#ti").change(function(){


		var i=$("#ti").val();

		$.ajax({
			url:"<?php echo base_url();?>orders/agent-orders/getdqBDA",
			data:{id:i},
			type:"GET",
			success:function(data){

				$("#bda").html(data);
			}
		})
	});
	
	
	$("#bda").change(function(){


		var i=$("#bda").val();

		$.ajax({
			url:"<?php echo base_url();?>orders/agent-orders/getdqAgents",
			data:{id:i},
			type:"GET",
			success:function(data){

				$("#agents").html(data);
			}
		})
	});
	
</script>

            <!-- End footer -->