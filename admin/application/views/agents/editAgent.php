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
       

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />       
       
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice{

		background-color: #4798e8;
	}					
</style>        
       
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <div class="d-flex no-block justify-content align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>agents/all-agents">Agents</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Agent</li>
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
            <div class="container-fluid">
            <!-- ============================================================== -->
              <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                   	  <div class="col-md-8">
                    	<i class="fa fa-user"></i> Update Agent
                      </div>
                      <div class="col-md-3" style="text-align: right">
                       <a href="<?php echo base_url() ?>agents/create-agent">	
                    	<button class="btn btn-success waves-effect waves-light">Create Agent</button>
                       </a>	
                      </div>
                      <div class="col-md-1" style="text-align: right">
                       <a href="<?php echo base_url() ?>agents/all-agents">	
                    	<button class="btn btn-success waves-effect waves-light">All Agents</button>
                       </a>	
                      </div>	
                   </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>agents/updateAgent">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                       
                                       <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Agent ID
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="ti-user"></i></span></div>
                                                    <input type="text" name="agent_id" class="form-control" placeholder="Agent ID" required="" value="<?php echo $u->agent_id ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Name
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="ti-user"></i></span></div>
                                                    <input type="text" name="agent_name" class="form-control" id="name" placeholder="Name" required="" value="<?php echo $u->name ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Email
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="ti-email"></i></span></div>
                                                    <input type="email" class="form-control" name="agent_email" id="email" placeholder="Email" required="" value="<?php echo $u->email ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Mobile Number
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="m-r-10 mdi mdi-cellphone"></i></span></div>
                                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile_number" required="" value="<?php echo $u->mobile_number ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                      
                                        


                                    </div>

                                     <div class="row">
                                        
										 <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                City
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-location-arrow"></i></span></div>

                                                   <select class="form-control" id="city" name="city" required>
                                                       <option value="">Select City</option>
                                                    <?php $rr = $this->locations_model->getAgentcities(); 
                                                          foreach ($rr as $r) {
                                                               
                                                    ?>  
                                                    <option value="<?php echo $r->id ?>" <?php echo ($r->id == $u->city) ? "selected" : "" ?>><?php echo $r->location ?></option>
                                                   <?php } ?>
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Area
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-location-arrow"></i></span></div>

                                                   <select class="form-control" id="area" name="area" required>
                                                       <option value="<?php echo $u->area ?>"><?php echo $this->db->get_where("tbl_areas",array("status"=>"Active","deleted"=>0,"id"=>$u->area))->row()->area_name ?></option>
                                                    
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
										  
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Password
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
                                                    <input type="text" class="form-control" id="password" placeholder="Password" name="password" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $this->secure->decrypt($u->password) ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                         
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Status
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-info-circle"></i></span></div>
                                                    
                                                    <select class="form-control" id="status" name="status" required>
                                                       <option value="<?php echo $u->status ?>" selected><?php echo $u->status ?></option>
                                                       <?php if($u->status=="Active"){ ?>
                                                            <option value="Inactive">In Active</option>
                                                       <?php }else{ ?> 
                                                            <option value="Active">Active</option>
                                                       <?php } ?>      
                                                       
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                     

                                    </div>    
      								
                                    <div class="row">
                                      
                                      
                                       <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Role
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-info-circle"></i></span></div>
                                                    
                                                    <select class="form-control" id="role" name="role" required>
                                                       <option value="">Select Role</option>
                                                       
                                                       <?php 
														
														$roles = $this->db->get_where("fdm_va_roles",array("id !="=>1))->result();
														
														foreach($roles as $r){
														
														?>
                                                      
                                                      <option value="<?php echo $r->id ?>" <?php echo ($u->role == $r->id) ? 'selected' : '' ?>><?php echo $r->role_name ?></option>
                                                      
                                                        <?php } ?>
                                                       
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>  
                                          
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Morning Route
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="m-r-10 fa fa-map-marker"></i></span></div>
                                                    <input type="text" class="form-control" id="" placeholder="Morning Route" name="route" value="<?php echo $u->route ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Evening Route
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="m-r-10 fa fa-map-marker"></i></span></div>
                                                    <input type="text" class="form-control" id="" placeholder="Evening Route" name="eroute" value="<?php echo $u->eroute ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                      
                                      
                                       <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Address
                                                <div class="input-group">
<!--                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="m-r-10 mdi mdi-cellphone"></i></span></div>-->
                                                    <textarea class="form-control" placeholder="Address" name="address" required rows="3"><?php echo $u->address ?></textarea>
                                                </div>

                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 20px;">
                                                
                                               <!--  <div class="input-group">
                                                    <div class="input-group-prepend"> -->
                                        <input type="hidden" name="id" value="<?php echo $u->id ?>">    
                                                    <button type="submit" class="btn btn-info waves-effect waves-light" style="width: 100%">Update</button>
                                                  
                                                <!--   </div>
                                                    
                                                    
                                                </div> -->

                                                </div>
                                            </div>
                                        </div>        

									</div>
                              
                              
                              		<div class="row">
										
										<div class="col-sm-12 col-md-3" id="tincharge" style="display: none">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Teritary Incharge
                                                <div class="input-group m-t-10">
                                                   
                                                	<select class="form-control" name="tincharge[]" id='tinch' multiple='multiple' style="width: 100%;height: 36px;" data-live-search="true">
<!--														<option value="">Select Teritary Incharge</option>-->
														<?php 
														
														foreach($tis as $r){
														
														?>
                                                      
                                                      		<option value="<?php echo $r->id ?>"><?php echo $r->name ?></option>
                                                      
                                                        <?php } ?>
														
												    </select>

                                                </div>

                                                </div>
                                            </div>
                                        </div>
										
										
										<div class="col-sm-12 col-md-3" id="salesemployees" style="display: none">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Sales Employees (BDA)
                                                <div class="input-group m-t-10">
                                                   
                                                	<select class="form-control" name="salesemployees[]" id='salesemp' multiple='multiple' style="width: 100%;height: 36px;" data-live-search="true">
<!--														<option value="">Select Sales Employees</option>-->
														<?php 
														
														
															foreach($bda as $a){

																echo '<option value="'.$a->id.'">'.$a->name.'</option>';

															}

														?>
														
												    </select>

                                                </div>

                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-sm-12 col-md-3" id="agents" style="display: none">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Agents
                                                <div class="input-group m-t-10">
                                                   
                                                	<select class="form-control" name="agents[]" id="agts" multiple='multiple' style="width: 100%;height: 36px;" data-live-search="true">
														
														<?php 
														
														foreach($uagents as $r){
															
															$role = $this->db->get_where("fdm_va_roles",array("id"=>$r->role))->row()->role_name;
														
														?>
                                                      
                                                      		<option value="<?php echo $r->id ?>"><?php echo $r->name." ($role)" ?></option>
                                                      
                                                        <?php } ?>
														
												    </select>

                                                </div>

                                                </div>
                                            </div>
                                        </div>
										
									</div>
                              
                               
                               
                            </form>

                         

                </div>
            </div>

            <!-- End Card  -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

            <!-- End footer -->


 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
 <script>
	 

<?php

	
	$agt = isset($u->assigned_agents) ? json_decode($u->assigned_agents) : [] ; 
	 
?>	 

$('#agts').selectpicker();

$('#select-all').click(function(){
$('#agts').multiSelect('select_all');
return false;
});
	 
$('#deselect-all').click(function(){
$('#agts').multiSelect('deselect_all');
return false;
});		 
	 
$('#salesemp').selectpicker();

$('#seselect-all').click(function(){
$('#salesemp').multiSelect('select_all');
return false;
});
	 
$('#sedeselect-all').click(function(){
$('#salesemp').multiSelect('deselect_all');
return false;
});
	 
	 
$('#tinch').selectpicker();

$('#tiselect-all').click(function(){
$('#tinch').multiSelect('select_all');
return false;
});
	 
$('#tideselect-all').click(function(){
$('#tinch').multiSelect('deselect_all');
return false;
});	 
	 
	 
//$(document).ready(function(){
	
	
	
	<? if($u->role == 7){ 
	
		$agents = $agt->agents;
	
	?>
		
		$("#agents").show();
		$("#agts").attr("required","required");
	
		$('#agts').val(<?php echo json_encode($agents) ?>).trigger('change');

		
//		return false;
		
	<? }elseif($u->role == 12){ 
	
		$salesemployees = $agt->salesemployees;
	?>

		
		$("#salesemployees").show();
		$("#salesemp").attr("required","required");
	
		$('#salesemp').val(<?php echo json_encode($salesemployees) ?>).trigger('change');
	
		
//		return false;
		
	<? }elseif($u->role == 11){ 
	
		$salesemployees = $agt->salesemployees;
		$tincharge = $agt->tincharge;
	
	?>

		
		$("#salesemployees").show();
		$("#salesemp").attr("required","required");
		
		$("#tincharge").show();
		$("#tinch").attr("required","required");

		$('#salesemp').val(<?php echo json_encode($salesemployees) ?>).trigger('change');
		$('#tinch').val(<?php echo json_encode($tincharge) ?>).trigger('change');
	
	<? } ?>
	
	
	
	
	
//})	 

	 
$("#role").change(function(){

	var role = $("#role").val();
	
	if(role == 7){
		
		$("#agents").show();
		$("#agts").attr("required","required");
		
		$("#salesemployees").hide();
		$("#salesemp").removeAttr("required","required");
		
		$("#tincharge").hide();
		$("#tinch").removeAttr("required","required");

		
	}else if(role == 12){

		
		$("#agents").hide();
		$("#agts").removeAttr("required","required");
		
		$("#salesemployees").show();
		$("#salesemp").attr("required","required");
		
		$("#tincharge").hide();
		$("#tinch").removeAttr("required","required");
		
//		return false;
		
	}else if(role == 11){
		
		
		$("#agents").hide();
		$("#agts").removeAttr("required","required");
		
		$("#salesemployees").show();
		$("#salesemp").attr("required","required");
		
		$("#tincharge").show();
		$("#tinch").attr("required","required");
		
//		return false;
		
	}else{
		
		$("#agents").hide();
		$("#agts").removeAttr("required","required");
		
		$("#salesemployees").hide();
		$("#salesemp").removeAttr("required","required");
		
		$("#tincharge").hide();
		$("#tinch").removeAttr("required","required");
		
//		return false;
	}
	
	
});
	 
	
$("#salesemp").change(function(){
	
	var selected=[];
	$('#salesemp :selected').each(function(){
		selected.push($(this).val());
	});
	

	$.ajax({
		url:"<?php echo base_url();?>ajax/getAgents",
		data:{id:selected},
		type:"GET",
//		dataType : "json",
		success:function(data){
			
			$('#agts').html(data);
			$("#agts").selectpicker('refresh');		
//			console.log(data);
			
		},error:function(data){
			
//			console.log(data);
		}
	})
});
	 
	 
$("#tinch").change(function(){
	
	var selected=[];
	$('#tinch :selected').each(function(){
		selected.push($(this).val());
	});
	var city = $("#city").val();

	$.ajax({
		url:"<?php echo base_url();?>ajax/alluamtisemp",
		data:{id:selected,aid:"<? echo $this->uri->segment(3) ?>",city:city},
		type:"GET",
//		dataType : "json",
		success:function(data){
			
			$('#salesemp').html(data);
			$("#salesemp").selectpicker('refresh');		
			console.log(data);
			
		},error:function(data){
			
			console.log(data);
		}
	})
}); 

$("#city").change(function(){


	var i=$("#city").val();

	$.ajax({
		url:"<?php echo base_url();?>ajax/getAreas",
		data:{id:i},
		type:"GET",
		success:function(data){

			$("#area").html(data);
			
			$.ajax({
				url:"<?php echo base_url();?>ajax/bindAgents",
				data:{city:i},
				type:"GET",
				dataType : "json",
				success:function(data){

					console.log(data)
					$("#tinch").html(data.tis);
					$("#tinch").selectpicker('refresh');	
					
					$("#salesemp").html(data.semp);
					$("#salesemp").selectpicker('refresh');	
					
					$("#agts").html(data.agents);
					$("#agts").selectpicker('refresh');	
					
				},
				error:function(data){

					console.log(data)
				}
			})
			
		}
	})
});	
</script>           