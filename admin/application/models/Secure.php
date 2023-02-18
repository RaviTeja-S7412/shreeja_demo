<?php
defined("BASEPATH") OR exit("NO direct script access allow");


class Secure extends CI_Model{
	
	
	
	public function __construct(){
		
		
		
		parent::__construct();
		
	
		
	}
	
	
	public function encrypt($data){
		
			$key="bjvd!@#$%^&*13248*/-/*vjvdf";
			$hmac_key = "kbdkh2365765243";

	
		$e = $this->encryption->initialize(
        array(
                'cipher' => 'blowfish',
                'mode' => 'cbc',
                'key' => $key,
                'hmac_digest' => 'sha256',
				'hmac_key' => $hmac_key
        )
		);
		
		$s=$this->encryption->encrypt($data);	
		
		
		if($s){
		
			return $s;		
			
		}else{
			
			return false;		
		
		}
	}
	
	
	public function encryptWithKey($data,$key){
		
		$this->encryption->initialize(
        array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $key
        )
		);
		
		$s=$this->encryption->encrypt($data);	
		
		
		if($s){
		
		return $s;		
			
		}else{
			
		return false;		
		
		}
	}
	
	public function decrypt($data){
		
			$key="bjvd!@#$%^&*13248*/-/*vjvdf";
			$hmac_key = "kbdkh2365765243";

		$d =$this->encryption->initialize(
        array(
                'cipher' => 'blowfish',
                'mode' => 'cdc',
                'key' => $key,
                'hmac_digest' => 'sha256',
				'hmac_key' => $hmac_key
        )
);
		$s=$this->encryption->decrypt($data);	
		if($s){
		
			return $s;		
			
		}else{
			
			return false;		
		
		}
	}
	
	
	public function loginCheck(){
		
		$id = $this->session->userdata("admin_id");

		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";		
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$route = str_replace(base_url(),"",$url);			
		
		
		if($id){
			
			if($id == 1){
				
				
			}else{

				$rChk = $this->db->get_where("fdm_va_auths",array("deleted"=>0,"status"=>"Active","id"=>$id))->row()->role;
				$exRoles = $this->db->get_where("fdm_va_admin_role_access",array("role_id"=>$rChk))->row();

				$roles = isset($exRoles->modules) ? json_decode($exRoles->modules) : [];

				$mids = array();							   
				$submodules = array();			

				foreach($roles as $rm){

					$mids[] = $rm->module_id;
					$submodules[$rm->module_id] = $rm->sub_module_id;

				}
				
				$fRoutes = array();
				
				 $modules = $this->db->query("select * from fdm_va_modules where status=1 order by sort asc")->result();
				 foreach ($modules as $m) {

					 if(in_array($m->module_id,$mids)){
						 
						 $smodule = $this->db->get_where("fdm_va_sub_modules",array("module_id"=>$m->module_id))->result();
						 
						 if($smodule){ 
						 
							 $ssmids = isset($submodules[$m->module_id]) ? $submodules[$m->module_id] : [];
							
							foreach ($smodule as $sm) {

								if(in_array($sm->sub_module_id,$ssmids)){

									 $fRoutes[] = $sm->sub_module_link;
									
								}
							}
							  $fRoutes[] = $m->module_link;
							 
						 }else{
							 
							
							 
						 }
					 }
				 }
				
//				print_r($fRoutes); exit();
				
				if(in_array($route,$fRoutes)){
					
					
				}else{
					
					$ex = explode("/",$route);
					
					$ex1 = isset($ex[1]) ? "/".$ex[1] : "";
					
					$exroute = $ex[0];
					$exroute1 = $ex[0].$ex1;
					
					if((strpos($route,'?') !== false) || in_array($exroute,$fRoutes) || in_array($exroute1,$fRoutes)){
						
						
					}else{
						
						redirect('error-404');
						
					}
					
					
				}
				
				
			}
			
		}else{
			
			$msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Login To Access Admin</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");

			
		}
		
		
	}
	
	
}