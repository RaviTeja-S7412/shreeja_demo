<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrangemenu extends CI_Controller {

   

public function index()
	{
		$this->load->view('navbar/arrangemenus/arrangeMenus');
	}
//public function all_menu(){
//	/*$data = $this->db->join("fdm_va_navbar_header_submenu","fdm_va_navbar_header_menu.id=fdm_va_navbar_header_submenu.menu_name","LEFT")
//					 ->join("fdm_va_navbar_header_subchild_menu","fdm_va_navbar_header_submenu.id=fdm_va_navbar_header_subchild_menu.sub_menu_id","LEFT OUTER")
//
//					->get("fdm_va_navbar_header_menu")->result();*/
//	$data = $this->db->get("fdm_va_navbar_header_menu")->result_array();
//		$second = [];
//		$sub = [];
//		$j=0;
//		$i=0;
//		foreach($data as $row){
//			$sub = $this->db->where("menu_name",$row['id'])->get("fdm_va_navbar_header_submenu")->result_array();
//			foreach ($sub as $smenu) {
//
//				//$row['sub'] = $smenu;
//				$sub[$j] = $smenu;
//				$j++;
//			}
//			$second[$i]= $row;
//			$i++; 
//		}
//	echo json_encode($second);
//}

public function get_submenu(){
	$id = $this->input->post("id");
		$data1 = [];
		$i=0;
		$sub = $this->db->where("menu_name",$id)->where("deleted",0)->where("status","Active")->order_by("sort")->get("fdm_va_navbar_header_submenu")->result_array();

			$key = 1;
            foreach($sub as $row){
                
            echo '<li class="dd-item" data-id='.$key.' data-mid='.$row['id'].'">
                <div class="dd-handle">'.$row['sub_menu_name'].'</div>
            </li>';
            $key++;
			}
	
}

	
public function get_footer_submenu(){
	$id = $this->input->post("id");
		$data1 = [];
		$i=0;
		$sub = $this->db->where("footer_menu_name",$id)->where("deleted",0)->where("status","Active")->order_by("sort")->get("fdm_va_navbar_footer_submenu")->result_array();

			$key = 1;
            foreach($sub as $row){
                
            echo '<li class="dd-item" data-id='.$key.' data-fmid='.$row['id'].'">
                <div class="dd-handle">'.$row['footer_submenu_name'].'</div>
            </li>';
            $key++;
			}
	
}	
	
public function save_menu(){
	$data  = $this->input->post("mdata");

	foreach(json_decode($data) as $key => $row){
		$this->db->where("id",$row->mid)->update("fdm_va_navbar_header_submenu",array("sort"=>$key));
	}
}

	
public function save_footer_menu(){
	$data  = $this->input->post("fmdata");

	foreach(json_decode($data) as $key => $row){
		$this->db->where("id",$row->fmid)->update("fdm_va_navbar_footer_submenu",array("sort"=>$key));
	}
}	
	
}
