<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilegio_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	# privilegio
	public function add($priv)
	{
		$data = array(
			'nombre_privilegio'=>$priv->nombre_privilegio,
			'gestion_idgestion'=>$priv->gestion_idgestion,
			'codigo_privilegio'=>$priv->codigo_privilegio
		);
		$this->load->database();
		$this->db->insert('privilegio', $data);
		return $this->db->insert_id();
	}

	public function update($priv, $id)
	{
		$data = array(
			'nombre_privilegio'=>$priv->nombre_privilegio,
			'gestion_idgestion'=>$priv->gestion_idgestion,
			'codigo_privilegio'=>$priv->codigo_privilegio
		);
		$this->load->database();
		return $this->db->update('privilegio', $data, 'idprivilegio = '.$id);
	}

	public function delete($id)
	{
		$this->load->database();
		return $this->db->delete('privilegio', array('idprivilegio'=>$id));
	}

	# consultas
	public function getAll()
	{
		$this->load->database();
		return $this->db->from('privilegio AS p')
					->join('gestion AS g','g.idgestion = p.gestion_idgestion')
					->join('aplicacion AS app','app.nombre_app = g.nombre_app')
					->get();
	}


	# manejos de erres
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

/* End of file Privilegio_db.php */
/* Location: ./application/models/Privilegio_db.php */