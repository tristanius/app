<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function save($value='')
	{
		$gest = json_decode( file_get_contents('php://input') );
		$this->load->model('gestion_db', 'gestion');		
		$ret = new stdClass();
		$ret->status = TRUE;
		if(!isset($gest->idgestion)){
			$this->gestion->start();
			$this->gestion->add( $gest );
			$ret->status = $this->gestion->status();
			$this->gestion->end();
		}else{
			$this->gestion->start();
			$this->gestion->update( $gest, $gest->idgestion );
			$ret->status = $this->gestion->status();
			$this->gestion->end();
		}
		echo json_encode($ret);
	}

	public function getAll()
	{
		if($this->sesion_iniciada() ){
			$this->load->model('gestion_db', 'gest');
			$gestiones = $this->gest->getAll();
			$ret = new stdClass();
			$ret->status = TRUE;
			$ret->gestiones = $gestiones->result();
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

	public function getApps()
	{
		$this->load->model('gestion_db', 'gest');
		$apps = $this->gest->getApps();
		$ret = new stdClass();
		$ret->status = TRUE;
		$ret->apps = $apps->result();
		echo json_encode( $ret );
	}
}

/* End of file gestion.php */
/* Location: ./application/controllers/gestion.php */