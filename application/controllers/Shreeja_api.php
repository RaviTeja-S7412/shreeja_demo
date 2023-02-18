<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Shreeja_api extends REST_Controller 
{
 public function __construct() 
       {
        parent::__construct();
       
           $this->load->helper(array('form', 'url','date'));
		   $this->load->database();
		   $this->load->model('user_model');
	    }
      
	


	public function step1_post(){
		$num = $this->input->post("mobile");
		
		$data = $this->user_model->insert_number($num);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}
	}
    
    public function resendotp_post(){
        $num = $this->input->post("mobile");
        $data = $this->user_model->resend_otp($num);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}
    }
	public function checkotp_post(){
		$num = $this->input->post("mobile");
		$otp = $this->input->post("otp");

		$data = $this->
		user_model->check_otp($num,$otp);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}
	}
	public function shreejalocations_get(){

		$data = $this->user_model->shreeja_locations();
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}	
	}

	public function locationupdate_post(){
		$userid = $this->input->post("userid");
		$locid = $this->input->post("location");
		$data = $this->user_model->location_update($userid,$locid);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}	
	}

	public function personaldataupdate_post(){

		$data = $this->
		user_model->personal_update($this->input->post());
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}	
	}

	public function userdata_post(){
		$userid = $this->input->post("userid");
		$data = $this->user_model->get_user($userid);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}	
	}
	
	public function shreeja_areas_post(){
		$lid = $this->input->post("location");
		$data = $this->user_model->areas($lid);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}	
	}

	public function products_post(){
		$lid = $this->input->post("location");
		$data = $this->user_model->all_products($lid);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}	
	}

	public function freesample_post(){
		$lid = $this->input->post("location");
		$data = $this->user_model->free_sample($lid);
		if($data['status'])
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}	
	}

	
	/*public function summary_get(){
		$id = $this->uri->segment(3);
		$data['summary'] =$this->db->get_where('professional_summary', array('user_id' => $id))->row_array();
		if ($data)
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}else
			{
				$this->response([
				'status' => FALSE,
				'error' => 'summary not found'
				], REST_Controller::HTTP_NOT_FOUND);
			}
	}

	public function skills_get(){
		$id = $this->uri->segment(3);
		$query=$this->db->get_where('professional_skills', array('user_id' => $id));
		$i=0;
		$data=array();
		foreach($query->result_array() as $row){
			$data[$i]=$row;
			$i++;
		}

		if ($data){
			$skills['skills']=$data;
			$this->response($skills, REST_Controller::HTTP_OK);
		}else
			{
				$this->response([
				'status' => FALSE,
				'error' => 'skills not found'
				], REST_Controller::HTTP_NOT_FOUND);
			}
	}

	function education_get(){
		$id = $this->uri->segment(3);
		$query=$this->db->get_where('professional_education', array('user_id' => $id));
		$i=0;
		$data=array();
		foreach($query->result_array() as $row){
			$data[$i]=$row;
			$i++;
		}

		if ($data){
			$edu['education']=$data;
			$this->response($edu, REST_Controller::HTTP_OK);
		}else
			{
				$this->response([
				'status' => FALSE,
				'error' => 'education not found'
				], REST_Controller::HTTP_NOT_FOUND);
			}	
	}

	function experience_get(){
		$id = $this->uri->segment(3);
		$query=$this->db->get_where('professional_experience', array('user_id' => $id));
		$i=0;
		$data=array();
		foreach($query->result_array() as $row){
			$data[$i]=$row;
			$i++;
		}

		if ($data){
			$exp['experience']=$data;
			$this->response($exp, REST_Controller::HTTP_OK);
		}else
			{
				$this->response([
				'status' => FALSE,
				'error' => 'experience not found'
				], REST_Controller::HTTP_NOT_FOUND);
			}	
	}

	function projects_get(){
		$id = $this->uri->segment(3);
		$query=$this->db->get_where('professional_project', array('user_id' => $id));
		$i=0;
		$data=array();
		foreach($query->result_array() as $row){
			$data[$i]=$row;
			$i++;
		}

		if ($data){
			$project['projects']=$data;
			$this->response($project, REST_Controller::HTTP_OK);
		}else
			{
				$this->response([
				'status' => FALSE,
				'error' => 'project not found'
				], REST_Controller::HTTP_NOT_FOUND);
			}	
	}

	function summaryupdate_post(){
		$user_id=$this->input->post('user_id');
		$summary=$this->input->post('summary');
		$query=$this->db->set('summary',$summary)->where('user_id',$user_id)->update('professional_summary');
		if($query){
			$this->response($query, REST_Controller::HTTP_OK);
		}else{
				$this->response([
				'status' => FALSE,
				'error' => 'Query error'
				], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	function skillupdate_post(){
		$data=array(
			'skill_title'=>$this->input->post('skill_title'),
			'skill_version'=>$this->input->post('skill_version'),
			'skill_exp_year'=>$this->input->post('skill_year'),
			'skill_exp_month'=>$this->input->post('skill_month')
		);
	}

	function addskill_post(){
		$data=array(
			'user_id'=>$this->input->post('user_id'),
			'skill_title'=>$this->input->post('skill_title'),
			'skill_version'=>$this->input->post('skill_version'),
			'skill_exp_year'=>$this->input->post('skill_year'),
			'skill_exp_month'=>$this->input->post('skill_month')
		);
		$query=$this->db->insert('professional_skills',$data);
		if($query){
			$this->response($query, REST_Controller::HTTP_OK);
		}else{
				$this->response([
				'status' => FALSE,
				'error' => 'Query error'
				], REST_Controller::HTTP_NOT_FOUND);
		}
	}*/
}