<?php
/**
* 
*/
class MY_Controller extends MX_Controller
{
	
	function template($data){
       
       $this->load->module('template');


       // if else, if admin do A, else B
       $this->template->admin($data);
	}

}