<?php
defined("BASEPATH") OR exit("No direct script access allow");


function front_header(){
    
    include''.APPPATH.'views/template/header.php';
    
}

function front_footer(){
    
    include''.APPPATH.'views/template/footer.php';
    
}

function front_inner_header(){
    
    include''.APPPATH.'views/template/front_inner_header.php';
    
}


function front_inner_footer(){
    
    include''.APPPATH.'views/template/front_inner_footer.php';
    
}

function shreeja_url(){
	
	return 'https://shreejamilk.com/';
	
}
?>