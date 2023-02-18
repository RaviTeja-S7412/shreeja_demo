<?php

defined("BASEPATH") OR exit("No direct script access allow");


class Locations_model extends CI_Model{


	public function getAgentcities(){
		
		return $this->db->get_where("tbl_locations",array("status"=>1,"deleted"=>0,"assign_to"=>"agents"))->result();
		
	}
	
	public function getConsumercities(){
		
		return $this->db->get_where("tbl_locations",array("status"=>1,"deleted"=>0,"assign_to"=>"consumers"))->result();
		
	}
	
}