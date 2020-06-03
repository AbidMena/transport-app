<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller
{
 public function index(){
 	$template['page_title'] = "About Us";
	$template['page_name'] = "about";
   $this->load->view('template', $template);

 }
}