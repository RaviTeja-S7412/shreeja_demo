<?php

defined("BASEPATH") OR exit("No direct script access allow");


function admin_header(){
	include APPPATH."views/back_common/admin_header.php";
}

function admin_footer(){
	include APPPATH."views/back_common/admin_footer.php";
}

function admin_sidebar(){
	include APPPATH."views/back_common/admin_sidebar.php";
}
// function img_url(){

// 	$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
//     $url = $_SERVER["HTTP_HOST"];

// 	$i_url = $protocol.'://'.$url.'/freedom/';
// 	return $i_url;
// }

?>
