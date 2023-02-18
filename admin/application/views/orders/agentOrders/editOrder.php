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
                                        <a href="<?php echo base_url() ?>orders/agent-orders">Orders</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Order</li>
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
<!--                    	<i class="fa fa-user"></i>-->
                    	 Update Order
                      </div>	
                   </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>orders/agent-orders/editOrder" enctype="multipart/form-data">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                       
                                       <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Order ID
                                                    <input type="text" name="order_id" class="form-control" placeholder="Order ID" required="" value="<?php echo $u->order_id ?>" readonly>

                                                </div>
                                            </div>
                                        </div>
                                       
                                       <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Agents

                                                   <select class="form-control" name="aid" required>
                                                       <option value="">Select Agent</option>
                                                    <?php $rr = $this->db->get_where("fdm_va_auths",array("deleted"=>0,"status"=>"Active","role"=>2))->result(); 
                                                          foreach ($rr as $r) {
                                                               
                                                    ?>  
                                                    <option value="<?php echo $r->id ?>" <?php echo ($r->id == $u->agent_id) ? "selected" : "" ?>><?php echo $r->name ?></option>
                                                   <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                       
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product Name

                                                   <select class="form-control" id="product_id" name="pid" required>
                                                       <option value="">Select Product</option>
                                                    <?php $rr = $this->db->get_where("tbl_products",array("deleted"=>0,"assigned_to"=>"agents"))->result(); 
                                                          foreach ($rr as $r) {
                                                               
                                                    ?>  
                                                    <option value="<?php echo $r->id ?>" <?php echo ($r->id == $u->product_id) ? "selected" : "" ?>><?php echo $r->product_name ?></option>
                                                   <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Quantity 

                                                   <select class="form-control" id="qty" name="category" required>
                                                       <option value="">Select Quantity</option>
                                                       <option value="<?php echo $u->category ?>" selected><?php echo $u->category ?></option>
                                                    
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        
                                      
                                        


                                    </div>

                                     <div class="row">
                                        
										 <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Qty
                                                    <input type="number" name="qty" class="form-control" placeholder="Qty" required="" value="<?php echo $u->qty ?>">

                                                </div>
                                            </div>
                                        </div>
										  
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Delivery Date
                                                <div class="input-group">
                                                    <input type="text" class="form-control deliveryDate" placeholder="Delivery Date" name="deliveryDate" required="" value="<?php echo ($u->delivery_date) ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                         
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Delivery Time
                                                <div class="input-group">
                                                    
                                                    <select class="form-control" id="" name="deliveryTime" required>
                                                       <option value="<?php echo $u->order_delivery_time ?>" selected><?php echo $u->order_delivery_time ?></option>
                                                       <?php if($u->order_delivery_time=="morning"){ ?>
                                                            <option value="evening">evening</option>
                                                       <?php }else{ ?> 
                                                            <option value="morning">morning</option>
                                                       <?php } ?>      
                                                       
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                     	<div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Transaction Amount
                                                <div class="input-group">
                                                    <input type="number" class="form-control" placeholder="Transaction Amount" name="txnAmount" required="" value="<?php echo ($u->amount) ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                   		
                                        
                                        
                                    </div>    
      								
                                   
                                    <div class="row">
                                      
                                      <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Transaction ID
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Transaction ID" name="txnID" required="" value="<?php echo ($u->transaction_number) ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                      
                                       <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Transaction Date
                                                <div class="input-group">
                                                    <input type="text" class="form-control deliveryDate" placeholder="Transaction Date" name="txnDate" required="" value="<?php echo ($u->transaction_date) ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Payment Receipt
                                                <div class="input-group">
                                                    <input type="file" class="form-control" placeholder="Payment Receipt" name="files">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 20px;">
                                                
                                        <input type="hidden" name="id" value="<?php echo $u->id ?>">    

                                                    <button type="submit" class="btn btn-info waves-effect waves-light" style="width: 100%">Update</button>
                                                  
                                                </div>
                                            </div>
                                        </div>        

									</div>
                               
                               
                            </form>

                         

                </div>
                
                
                <hr>
                
                <div class="container">
                    
                    <label>Payment Receipt</label><br>
                    
                    <img src="<?php echo base_url().$u->transaction_document ?>" class="img-responsive thumbnail" style="width:80%">
                    
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


 <script>
	 
$("#product_id").change(function(){


	var i=$("#product_id").val();

	$.ajax({
		url:"<?php echo base_url();?>ajax/getagentProductquantity",
		data:{id:i},
		type:"GET",
		success:function(data){

			$("#qty").html(data);
		}
	})
});	 
	 
$(document).ready(function(){
	
	$(".deliveryDate").datepicker({
		
		minDate : 0,
		dateFormat : 'dd-mm-yy'
		
	});
	
});	 
	 

$("#city").change(function(){


	var i=$("#city").val();

	$.ajax({
		url:"<?php echo base_url();?>ajax/getAreas",
		data:{id:i},
		type:"GET",
		success:function(data){

			$("#area").html(data);
		}
	})
});	
</script>           