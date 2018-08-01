<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Bogota");
	}

	public function index()
	{
		
	}

	public function getAll()
	{
		$this->load->model('usuario_db', 'user');
		$ret = new stdClass();
		$ret->usuarios = $this->user->getAll()->result();
		$ret->status = TRUE;
		echo json_encode($ret);
	}


	public function resetPass($idusuario)
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$this->load->database();
		$users = $this->db->get_where('usuario',array('idusuario'=>$idusuario));
		if ($users->num_rows() > 0) {
			$row = $users->row();
			$this->load->library("encrypt");
			$pass = $this->encrypt->encode($row->persona_identificacion);
			$this->db->update('usuario',array('password'=>$pass, 'estado'=>TRUE), 'idusuario = '.$idusuario);
			redirect(site_url('administracion/usuarios'));
		}else{
			echo 'usuario no encontrado';
		}
	}

	public function invalidarAcceso($idusuario)
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$this->load->database();
		$users = $this->db->get_where('usuario',array('idusuario'=>$idusuario));
		if ($users->num_rows() > 0) {
			$row = $users->row();
			$this->load->library("encrypt");
			$pass = "x";
			$this->db->update('usuario',array('password'=>$pass, 'estado'=>false), 'idusuario = '.$idusuario);
			redirect(site_url('administracion/usuarios'));
		}else{
			echo 'usuario no encontrado';
		}
	}

	public function service_get_users($value='')
	{
		$this->load->database();
		$users = $this->db->get("usuario");
		$data = "";
		foreach ($users->result() as $us) {
			$data = $data."
			<option value='".$us->idusuario."'>".$us->persona_identificacion." - ".$us->nombres." ".$us->apellidos."</option>";
		}
		echo $data;
	}


	# ------------------------------------------------------------------
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