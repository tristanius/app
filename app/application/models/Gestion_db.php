<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion_db extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function add($gestion)
	{
		$gestion = (array) $gestion;
		$this->load->database();
		$this->db->insert('gestion', $gestion);
		return $this->db->insert_id();
	}

	public function update($gestion, $id)
	{
		$data = array(
			'nombre_gestion'=>$gestion->nombre_gestion,
			'descripcion_gestion'=>$gestion->descripcion_gestion,
			'nombre_app'=>$gestion->nombre_app
		);
		$this->load->database();
		return $this->db->update('gestion', $data, 'idgestion = '.$id);
	}

	public function getAll()
	{
		$this->load->database();
		return $this->db->from('gestion AS g')->join('aplicacion AS a','a.nombre_app = g.nombre_app')->get();
	}

	public function getApps()
	{
		$this->load->database();
		return $this->db->get('aplicacion');
	}


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

/* End of file Gestion_db.php */
/* Location: ./application/models/Gestion_db.php */