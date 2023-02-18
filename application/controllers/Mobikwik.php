<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobikwik extends CI_Controller {

public function __construct(){
			
		   parent::__construct();
	
 }

public function index(){

	$this->load->view("mobikwik/test_merchant_input");

}

public function posttozaakpay(){

	$this->load->view("mobikwik/posttozaakpay");

}

public function response(){

	$this->load->view("mobikwik/response");

}

}