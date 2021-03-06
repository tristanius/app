<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


	public function add($rol)
	{
		$data = array(
			'nombre_rol'=>$rol->nombre_rol,
			'grupo'=>$rol->grupo,
			'tipo_visualizacion'=>$rol->tipo_visualizacion
		);
		$this->load->database();
		$this->db->insert('rol', $rol);
		return $this->db->insert_id();
	}

	public function update($rol, $id)
	{
		$data = array(
			'nombre_rol'=>$rol->nombre_rol,
			'grupo'=>$rol->grupo,
			'tipo_visualizacion'=>$rol->tipo_visualizacion
		);
		$this->load->database();
		return $this->db->update('rol', $data, 'idrol = '.$id);
	}

	public function get($id = NULL)
	{
		$this->load->database();
		if (isset($id)) {
			$this->db->where('idrol', $id);
		}
		return $this->db->from('rol')->order_by('rol.grupo', 'ASC')
					->get();
	}

	public function delete($id)
	{
		$this->load->database();
		return $this->db->delete('rol', array('idrol'=>$id));
	}

	# Privilegios del rol

	public function addPrivRol($idprivilegio, $idrol)
	{
		$this->load->database();
		$data = array(
			'privilegio_idprivilegio'=>$idprivilegio,
			'rol_idrol'=>$idrol
		);
		$this->db->insert('privilegio_has_rol', $data);
		return $this->db->insert_id();
	}

	public function delPrivRol($id)
	{
		$this->load->database();
		$this->db->delete('privilegio_has_rol', array('idprivilegio_has_rol'=>$id) );
	}

	public function getPrivilegiosRol($idrol)
	{
		$this->load->database();
		return $this->db->select('
					pr.idprivilegio_has_rol,
					r.idrol,
					r.nombre_rol,
					p.idprivilegio,
					p.nombre_privilegio,
					g.nombre_gestion
				')
				->from('rol AS r')
				->join('privilegio_has_rol AS pr','pr.rol_idrol = r.idrol')
				->join('privilegio AS p','p.idprivilegio = pr.privilegio_idprivilegio')
				->join('gestion AS g','g.idgestion = p.gestion_idgestion')
				->where('r.idrol',$idrol)
				->order_by('g.idgestion','ASC')
				->get();
	}

	# validacion de errores

	public function start($value='')
	{
		$this->load->database();
		$this->db->trans_begin();
	}

	public function status($value='')
	{
		return $this->db->trans_status();
	}

	public function end($value='')
	{
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}
	}
}

/* End of file Rol_db.php */
/* Location: ./application/models/Rol_db.php */