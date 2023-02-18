<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pageerror extends CI_Controller {

public function __construct(){
			
		   parent::__construct();

		   
	
 }


public function noAccess(){
	$this->load->view("error-404");
}



}