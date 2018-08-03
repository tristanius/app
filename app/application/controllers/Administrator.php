<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/bogota');
	}

	public function index()
	{
		
	}

	#=================================================================================
	# privilegios
	#=================================================================================
	public function privilegios($value='')
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$direccion_act = array(
				'<a href="'.site_url('').'">App termo</a>',
				'<a href="#"">Admin</a>',
				'<a href="'.current_url('').'">Privilegios</a>'
			);
		$this->load->database();
		$rows = $this->db->from("privilegio AS pr")->join('gestion AS g','g.idgestion = pr.gestion_idgestion')->get();
		$gestiones = $this->db->get("gestion")->result();

		$this->crear_vista("Administrator/privilegios",array("privilegios"=>$rows, "gestiones"=>$gestiones), $direccion_act);
	}

	public function add_privilegio()
	{
		$objPost = file_get_contents("php://input");
		$post = json_decode($objPost);
		
		$this->load->model("administrator_db");
		$this->administrator_db->add_privilegio($post);
		echo json_encode($post);
	}


	#=================================================================================
	# roles
	#=================================================================================
	public function roles($value='')
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$direccion_act = array(
				'<a href="'.site_url('').'">App termo</a>',
				'<a href="">administracion</a>',
				'<a href="'.current_url('').'">Roles</a>'
			);
		$this->load->database();
		$rows = $this->db->from("rol")->order_by('grupo','ASC')->get();
		
		$this->crear_vista("Administrator/roles",array("roles"=>$rows),$direccion_act);
	}

	public function add_rol($value='')
	{
		$objPost = file_get_contents("php://input");
		$post = json_decode($objPost);

		$this->load->model("administrator_db");
		$id = $this->administrator_db->add_rol($post);
		$post->idrol = $id;
		echo json_encode($post);
	}

	#=================================================================================
	# roles has privilegios
	#=================================================================================
	public function rol_privilegios($idrol)
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$direccion_act = array(
				'<a href="'.site_url('').'">App termo</a>',
				'<a href="#">Admin</a>',
				'<a href="'.current_url('').'">privilegios del rol</a>'
			);

		$this->load->database();
		$rol = $this->db->get_where("rol",array("idrol"=>$idrol))->row();

		$rows_gestiones = $this->db->get('gestion');
		$gestiones = $rows_gestiones->result();
		foreach ($gestiones as $r) {
			$r->privilegios = $this->db->get_where('privilegio', array('gestion_idgestion'=>$r->idgestion) )->result();
		}

		$this->db->close();
		$this->load->model("administrator_db");
		$rows = $this->administrator_db->getRolPrivilegios($idrol);
		$this->crear_vista("Administrator/rol_privilegios",array("rol"=>$rol, "privilegios_rol"=>$rows, "gestiones"=>$gestiones),$direccion_act);
	}

	public function add_privilegio_rol($value='')
	{
		$objPost = file_get_contents("php://input");
		$post = json_decode($objPost);

		$this->load->model("administrator_db");
		$id = $this->administrator_db->add_privilegio_rol($post);
		$post->idprivilegio_has_rol = $id;
		echo json_encode($post);
	}

	public function del_priv_rol($id)
	{
		$this->load->database();
		$this->db->delete('privilegio_has_rol',array('idprivilegio_has_rol'=>$id));
		redirect(site_url('Administrator/roles'));
	}
	#=================================================================================
	# usuarios
	#=================================================================================
	public function usuarios($value='')
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$direccion_act = array(
				'<a href="'.site_url('').'">App termo</a>',
				'<a href="#">Admin</a>',
				'<a href="'.current_url('').'">Usuarios</a>'
			);
		$this->load->database();
		$rows = $this->db->from("usuario AS usr")->join("rol", "usr.rol_idrol = rol.idrol")->order_by('usr.estado','DESC')->get();
		$roles = $this->db->get("rol");
		
		$this->crear_vista("Administrator/usuarios",array("usuarios"=>$rows, "roles"=>$roles),$direccion_act);
	}

	public function add_usuario($value='')
	{
		$objPost = file_get_contents("php://input");
		$post = json_decode($objPost);

		$this->load->library("encrypt");
		$pass = $this->encrypt->encode($post->persona_identificacion);

		$this->load->model("administrator_db");
		$post->password = $pass;

		$post->idusuario = $this->administrator_db->add_usuario($post);
		echo json_encode($post);
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
			redirect(site_url('Administrator/usuarios'));
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
			redirect(site_url('Administrator/usuarios'));
		}else{
			echo 'usuario no encontrado';
		}
	}

	public function formReasignarRol($id)
	{
		$this->load->database();
		$user = $this->db->get_where('usuario', array('idusuario'=>$id) );
		$this->load->view('Administrator/reasignar_usuario_rol', array( 'usuario'=>$user->row() ));
	}

	#=================================================================================
	# privados utiles
	#=================================================================================
	public function crear_vista($vista, $data, $direccion_act){

		$html = $this->load->view($vista, $data, TRUE);
		
		$vista = $this->load->view("utilidades_visuales/vista_panel",
				array(
					"vista_pr"=>$html,
					"direccion_act"=>$direccion_act
					),
				TRUE );
		$this->load->view("home",array("vista"=>$vista));
	}


	private function sesion_iniciada()
	{
		$this->load->library("session");
		if($this->session->userdata("isess")){
			return TRUE;
		}
		return FALSE;
	}

}

/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */