<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	# Guadar rol
	public function save($value='')
	{
		$rol = json_decode( file_get_contents('php://input') );
		$this->load->model('rol_db', 'rol');		
		$ret = new stdClass();
		$ret->status = TRUE;
		if(!isset($rol->idrol)){
			$this->rol->start();
			$rol->idrol = $this->rol->add($rol);
			$this->savePrivilegios($rol->privilegios, $rol->idrol);
			$ret->status = $this->rol->status(); # preguntamos el estatus
			$this->rol->end();
		}else{
			$this->rol->start();
			$this->rol->update($rol, $rol->idrol);
			$this->savePrivilegios($rol->privilegios, $rol->idrol);
			$ret->status = $this->rol->status(); # preguntamos el estatus
			$this->rol->end();
		}
		echo json_encode($ret);
	}

	#
	private function savePrivilegios($privilegios, $idrol)
	{
		foreach ($privilegios as $key => $p) {
			if(!isset($p->idprivilegio_has_rol)){
				$this->rol->addPrivRol($p->idprivilegio, $idrol);
			}
		}
	}

	#Eliminar rol
	public function delete($id)
	{
		$ret = new stdClass();
			$this->load->model('rol_db', 'rol');		
			if($this->sesion_iniciada() ){
				$this->rol->start();
				$roles = $this->getRoles($id);
				if(sizeof($roles) > 0){
					$rol = $roles[0];
					foreach ($rol->privilegios as $key => $pr) {
						$this->rol->delPrivRol($pr->idprivilegio_has_rol);
					}
					$this->rol->delete($rol->idrol);
				}
				$this->rol->end();
				$ret->status = TRUE;
				$ret->msj = 'Borrado con exito';
			}else{
				$ret->status = FALSE;
				$ret->msj = 'No se ha podido eliminar el rol, por un fallo en la consultas con la BD';
			}
		echo json_encode($ret);
	}

	# consultas del CRUD

	public function getAll()
	{
		if($this->sesion_iniciada() ){
			$this->load->model('rol_db', 'rol');
			$ret = new stdClass();
			$ret->status = TRUE;
			$ret->roles = $this->getRoles();
			echo json_encode($ret);
		}else{
			echo "NOP. NOP. NOP";
		}
	}

	public function getRoles($id=NULL)
	{
		$roles = $this->rol->get($id)->result();
		foreach ($roles as $key => $rol) {
			$privs = $this->rol->getPrivilegiosRol($rol->idrol);
			$rol->privilegios = $privs->result();
		}
		return $roles;
	}

	# Eliminar un Privilegio de un Rol
	public function del_priv_rol($id)
	{
		$ret = new stdClass();
		if ($this->sesion_iniciada()) {
			$this->load->model('rol_db', 'rol');
			$this->rol->delPrivRol($id);
			$ret->status = TRUE;
		}else{
			$ret->status = FALSE;
		}
		echo json_encode($ret);
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