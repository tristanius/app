<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion_db extends CI_Model {

	protected $idpersona = "persona_idpersona";
	protected $user = "username";
	protected $pass = "password";
	protected $rol = "rol_idrol";
	protected $last_time = "ultimo_incio";
	protected $table = "usuario";


	public function __construct()
	{
		parent::__construct();
		
	}


	public function get_usuario_rol($user = "", $pass = "")
	{
		try {
			return $this->db->from("usuario")->join('rol','rol.idrol = usuario.rol_idrol')->where("username", $user)->get();
		} catch (Exception $e) {
			return FALSE;
		}
	}
	public function cargar_privilegios($idrol)
	{
		try {
			$this->db->select("p.idprivilegio, p.nombre_privilegio");
			$this->db->from("rol AS r");
			$this->db->join("privilegio_has_rol AS p_r", 'r.idrol = p_r.rol_idrol' );
			$this->db->join("privilegio AS p", 'p.idprivilegio = p_r.privilegio_idprivilegio' );
			$this->db->where(array('r.idrol'=>$idrol));
			return $this->db->get();	
		} catch (Exception $e) {
			return FALSE;
		}
	}

	public function cargar_grupo_gestiones_apps($idrol, $apps=FALSE){
		try {
			if($apps){
				$this->db->select("g.nombre_app");
			}else{
				$this->db->select("g.nombre_gestion");
			}			
			$this->db->from("rol AS r");
			$this->db->join("privilegio_has_rol AS p_r", 'r.idrol = p_r.rol_idrol' );
			$this->db->join("privilegio AS p", 'p.idprivilegio = p_r.privilegio_idprivilegio' );
			$this->db->join("gestion AS g", 'g.idgestion = p.gestion_idgestion' );
			$this->db->where(array("r.idrol"=>$idrol));
			if($apps){
				$this->db->group_by('g.nombre_app');
			}else{
				$this->db->group_by('g.nombre_gestion');
			}
			##$this->db->order_by("g.nombre_app", "desc");
			return $this->db->get();
		} catch (Exception $e) {
			return FALSE;
		}
	}

	public function carga_contratos($idusuario)
	{
		return $this->db->select('idcontrato')->from('usuario_contrato')->where('idusuario',$idusuario)->get();
	}

	private function new_inicio($idper){
		$this->db->update($this->table, 
				array('ultimo_inicio'=>date('Y-m-d H:i:s')), 
				$this->idpersona." = '".$idper."'"
			);
	}
}
/* End of file  */
/* Location: ./application/models/ */