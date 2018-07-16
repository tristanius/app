<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}



	public function save($value='')
	{
		$rol = json_decode( file_get_contents('php://input') );
		$this->load->model('rol_db', 'rol');		
		$ret = new stdClass();
		$ret->status = TRUE;
		if(!isset($rol->idrol)){
			$this->rol->start();
			$this->rol->add($rol);
			$ret->status = $this->rol->status();
			$this->rol->end();
		}else{
			$this->rol->start();
			$this->rol->update($rol, $rol->idrol);
			$ret->status = $this->rol->status();
			$this->rol->end();
		}
		echo json_encode($ret);
	}

	public function getAll($value='')
	{
		if($this->sesion_iniciada() ){
			$this->load->model('rol_db', 'rol');
			$roles = $this->rol->getAll();
			$ret = new stdClass();
			$ret->status = TRUE;
			$ret->roles = $roles->result();
			echo json_encode($ret);
		}else{
			echo "NOP. NOP. NOP";
		}
	}

	# Sesion
	private function sesion_iniciada()
	{
		$this->load->library("session");
		if($this->session->userdata("isess")){
			return TRUE;
		}
		return FALSE;
	}


}

/* End of file  */
/* Location: ./application/controllers/ */