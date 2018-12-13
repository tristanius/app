<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getAll($where = NULL)
	{
		$this->load->database();
		if( isset($where) ){
			$this->db->where( $where );
		}
		return $this->db->from('usuario')->join('rol','rol.idrol = usuario.rol_idrol')->get();
	}

	public function add($obj)
	{
		$data = array(
				'username' => $obj->persona_identificacion,
				'persona_identificacion' => $obj->persona_identificacion,
				'nombres' => isset($obj->nombres)?$obj->nombres:NULL,
				'apellidos' => isset($obj->apellidos)?$obj->apellidos:NULL,
				'correo' => isset($obj->correo)?$obj->correo:NULL,
				'base_idbase' => isset($obj->base_idbase)?$obj->base_idbase:NULL,
				'rol_idrol' => isset($obj->rol_idrol)?$obj->rol_idrol:NULL,
				'password' => isset($obj->password)?$obj->password:NULL
			);
		$this->load->database();
		$this->db->insert('usuario', $data);
		return $this->db->insert_id();
	}

	public function mod($obj)
	{
		$data = array(
				'username' => $obj->persona_identificacion,
				'persona_identificacion' => $obj->persona_identificacion,
				'nombres' => isset($obj->nombres)?$obj->nombres:NULL,
				'apellidos' => isset($obj->apellidos)?$obj->apellidos:NULL,
				'correo' => isset($obj->correo)?$obj->correo:NULL,
				'base_idbase' => isset($obj->base_idbase)?$obj->base_idbase:NULL,
				'rol_idrol' => isset($obj->rol_idrol)?$obj->rol_idrol:NULL,
				'password' => isset($obj->password)?$obj->password:NULL
			);
		$this->load->database();
		return $this->db->update('usuario', $data, 'idusuario = '.$obj->idusuario);
	}

	public function getContratos($iduser)
	{
		$this->load->database();
		return $this->db->select('*')->from('usuario_contrato')->where('idusuario'=>$iduser)->get();
	}

	public function relacionarContrato($idusuario, $idcontrato)
	{
		$this->load->database();
		$data = $this->db->
		return 
	}

}

/* End of file Usuario_db.php */
/* Location: ./application/models/Usuario_db.php */