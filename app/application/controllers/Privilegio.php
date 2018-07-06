<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilegio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function save($value='')
	{
		$priv = json_decode( file_get_contents('php://input') );
		$this->load->model('privilegio_db', 'priv');		
		$ret = new stdClass();
		$ret->status = TRUE;
		if(!isset($priv->idprivilegio)){
			$this->priv->start();
			$this->priv->add($priv);
			$ret->status = $this->priv->status();
			$this->priv->end();
		}else{
			$this->priv->start();
			$this->priv->update($priv, $priv->idprivilegio);
			$ret->status = $this->priv->status();
			$this->priv->end();
		}
		echo json_encode($ret);
	}

	public function getAll($value='')
	{
		if($this->sesion_iniciada() ){
			$this->load->model('privilegio_db', 'priv');
			$privs = $this->priv->getAll();
			$ret = new stdClass();
			$ret->status = TRUE;
			$ret->privilegios = $privs->result();
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

/* End of file Privilegio.php */
/* Location: ./application/controllers/Privilegio.php */