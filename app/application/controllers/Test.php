<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$vista = $this->load->view("test/test","",TRUE);
		$this->load->view("home", array("vista"=>$vista));
	}

}

/* End of file  */
/* Location: ./application/controllers/ */