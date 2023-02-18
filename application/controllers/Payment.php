<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/paytm_library/config_paytm.php');
require_once(APPPATH.'libraries/paytm_library/encdec_paytm.php');
class Payment extends CI_Controller {

	public function paytm_pay($id){
		
		$this->session->set_userdata(array("corder_id"=>$id));
		$this->load->view('ccavenue/index');		
	}
	
	public function paytmRequest(){
		
		$this->load->view('ccavenue/ccavRequestHandler');		
		
	}
	
	public function paytmResponse(){
		
		$this->load->view('ccavenue/ccavResponseHandler');		
		
	}
	
	
	public function generateInvoice($oid){
		
        $odata = $this->db->get_where("orders",array("order_id"=>$oid,"payment_status"=>"Success"))->row();
		
		if($odata){
			
			$data["o"] = $odata;
			
		}else{
			
			$data["o"] = $this->db->get_where("tbl_free_sample_orders",array("order_id"=>$oid,"order_status"=>"Success"))->row();
			
		}
		$this->load->view('paytm/invoice',$data);		
		
	}

	public function getrsa(){
	    $this->load->view("ccavenue/mobile/GetRSA");
	}
	
	public function mobileResponse(){
	    $this->load->view("ccavenue/mobile/ccavResponseHandler");
	}
    
	
}
