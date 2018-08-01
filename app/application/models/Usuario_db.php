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

}

/* End of file Usuario_db.php */
/* Location: ./application/models/Usuario_db.php */