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

	public function save()
	{
		$post = json_decode( file_get_contents('php://input') );
		$this->load->model('usuario_db', 'user');
		$ret = new stdClass();
		$post->password = password_hash($post->persona_identificacion, PASSWORD_DEFAULT );

		if ( isset($post->idusuario) ) {
			$this->user->mod($post);
			$ret->status = TRUE;
			$ret->msj = 'Usuario creado';
		}else{
			$rows = $this->user->getAll( array('usuario.persona_identificacion'=>$post->persona_identificacion) );
			if( $rows->num_rows() > 0){
				$ret->status = FALSE;
				$ret->msj = 'ya existe no. de identificacion';
			}else{
				$post->idusuario = $this->user->add($post);
				$ret->status = TRUE;
				$ret->msj = 'Usuario modificado';
			}
		}
		$ret->user = $post;
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
			$pass = password_hash($row->persona_identificacion, PASSWORD_DEFAULT);
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
			$pass = "x";
			$this->db->update('usuario',array('password'=>$pass, 'estado'=>false), 'idusuario = '.$idusuario);
			redirect(site_url('administracion/usuarios'));
		}else{
			echo 'usuario no encontrado';
		}
	}


	# =============================================================================
	public function resetPassAll($userID)
	{
		$this->load->database();
		$rows = $this->db->get('usuario');
		$this->load->library('encrypt');
		foreach ($rows->result() as $key => $user ) {
			try {			
				#$pass = $this->encrypt->encode($user->persona_identificacion);					
				$pass = $this->encrypt->decode( $user->password );
				$pass = password_hash($user->persona_identificacion, PASSWORD_DEFAULT);
				$this->db->update('usuario', array( 'password'=>$pass ), 'idusuario = '.$user->idusuario);
			} catch (Exception $e) {

			}
		}
	}

	# =============================================================================

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