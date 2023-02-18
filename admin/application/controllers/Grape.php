<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grape extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
public function __construct(){
			
		parent::__construct();

		
		$id = $this->session->userdata("admin_id");
	
		$userstatus = $this->db->get_where("fdm_va_auths",array("id"=>$id))->row()->status;
	
		if($userstatus != "Active"){
			$msg = '<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Login To Access Pages</div>';	
			$this->session->set_flashdata("fmsg",$msg);
			redirect("login");
		}
	
$ar = $this->db->get_where("fdm_va_roles",array("id"=>$id))->row();	
	//$arole = $ar->role_name;
if($id==1){

}else{

	   $url = $this->uri->segment(1);

	   $m = $this->db->get_where("fdm_va_modules",array("module_link"=>$url))->row();
        
   	   $ua = $this->db->get_where("fdm_va_admin_role_access",array("user_id"=>$id,"module_id"=>$m->module_id))->row();
                     
            if($m->module_id==$ua->module_id){
               // echo "yes";
               
            }else{
               //echo "no";
               redirect("dashboard/error_module");
            }


}	

 }
	
	
	public function index()
	{
		$route = $this->input->get("route");
		$playout = $this->input->get("playout");
		

		
		$rchk = $this->db->get_where("pages",array("route"=>$route,"deleted"=>0))->num_rows();
	
		if($rchk >= 1){
			
			$this->alert->pnotify("error","Route Already Exists","error");
			redirect("pages/create-page");
			
		}
		
	
		
		$this->load->view('grape/index');
	}
	
	public function allPages(){
		
		$this->load->view("grape/allPages");
	}
	
	public function createPage(){
		
		$this->load->view("grape/createPage");
		
	}
	
	public function load_template(){
		
		$this->load->view("grape/startTemplate");
	}
	
	
//	public function send(){
//		
//		$pagename = $this->input->post("pname");
//		$route = $this->input->post("route");
//		
//	if (!is_dir('application/views/pages/'))
//    {
//        mkdir('application/views/pages', 0777, true);
//    }
//    $dir_exist = true; // flag for checking the directory exist or not
//    if (!is_dir('application/views/pages/' . $route))
//    {
//        mkdir('application/views/pages/' . $route, 0777, true);
//        $dir_exist = false; // dir not exist
//    }
//    else{
//
//    }
//		
//	
//	if (!is_dir('page_styles/'))
//    {
//        mkdir('page_styles', 0777, true);
//    }
//    $dir_exist = true; // flag for checking the directory exist or not
//    if (!is_dir('page_styles/' . $route))
//    {
//        mkdir('page_styles/' . $route, 0777, true);
//        $dir_exist = false; // dir not exist
//    }
//    else{
//
//    }	
//		
//		$data = $this->input->post("content");
//
//		$js = json_encode($data);
//
//		$jsde = json_decode($js);
//		
////		$html = 'gjs-html';
////		$css = 'gjs-css';
////		$styles = 'gjs-styles';
//		
//		print_r($js);
//		
//		exit();
//		
////		$ht2 = $jsde->$html;
////		
////		$ht = $ht1.$ht2;
////		echo($ht);
////		
////		exit();
//		file_put_contents("application/views/pages/$route/$route.php",$jsde->$html);
//		file_put_contents("page_styles/$route/style.css",$jsde->$css);
//		
//		$data = array("page_name"=>$pagename,"route"=>$route);
//		
//		$p = $this->db->insert("pages",$data);
//		
//		if($p){
//			echo("success");
//		}else{
//			echo("No");
//		}
//		
//
//	}
//	
	
	
	public function insert(){
		
		$pagename = $this->input->post("page_name");
		$route = $this->input->post("route");
		$playout = $this->input->post("playout");
		$html = $this->input->post('html');
		$css = $this->input->post('css');
		
		
		$data = array("html"=>$html,"css"=>$css,"page_name"=>$pagename,"route"=>$route,"page_layout"=>$playout);
		
		$p = $this->db->insert("pages",$data);
		
		if($p){
			
			$this->alert->pnotify("success","Page Created Successfully","success");

		}else{
			
			$this->alert->pnotify("error","Error Occured Please Try Again","error");
		}
	}
	
	public function editPage($id){
		
		$this->db->get_where("pages",array("id"=>$id))->row();
		$this->load->view('grape/updatePage');
		
	}
	
	public function viewPage($route){
		
	$r1 = $this->uri->segment(2);
	$r2 = $this->uri->segment(3);
	$r3 = $this->uri->segment(4);
	

	
	if($r1 && $r2 && $r3){

		$route = "$r1/$r2/$r3";

	}elseif($r1 && $r2){

		$route = "$r1/$r2";

	}else{

		$route = $r1;
			
	}
		
		
		$data["page"] = $this->db->get_where("pages",array("route"=>$route))->row();
		
		$this->load->view("grape/front_common/header");
		
		if($route == "home"){
			
			$this->load->view("grape/front_common/home_slider");
			$this->load->view("grape/front_common/trending_news");

		}
		
		$this->load->view('grape/viewPage',$data);
		$this->load->view("grape/front_common/footer");		
	}
	
	public function updatePage($id){
		
//		$data = $this->db->get_where("pages",array("id"=>$id))->row();
		$html = $this->input->post('html');
		$css = $this->input->post('css');
		$pname = $this->input->post('pname');
		$proute = $this->input->post('route');
		
		$data = array("page_name"=>$pname,"route"=>$proute,"html"=>$html,"css"=>$css);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$u = $this->db->update("pages");
		
		if($u){
			
//			echo(1);
			$this->alert->pnotify("success","Page Updated Successfully","success");

		}else{
			
			$this->alert->pnotify("error","Error Occured Please Try Again","error");
		}
	}
	
	public function load($id){
		
		$data = $this->db->get_where("pages",array("id"=>$id))->row();
		
		echo json_encode(['gjs-html' => $data->html, 'gjs-css' => $data->css, 'gjs-assets' => 'null']);
		
	}
	
	public function delPage($id){
		
	   $del = $this->db->delete("pages",array("id"=>$id));
		
	   if($del){
		   
		   $this->alert->pnotify("success","Page Deleted Successfully","success");
		   
		   redirect("grape/allPages");
	   }else{
		   
  		   $this->alert->pnotify("error","Error Occured Please Try Again","error");
		   redirect("grape/allPages");
	   }
	}
	
	public function view($page){
		
		$data["page_name"] = $page;
		$this->load->view("pages/header",$data);
		$this->load->view("pages/$page/$page");
	}
}
