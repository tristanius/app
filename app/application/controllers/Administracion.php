<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administracion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/bogota');
		$idrol = $this->session->userdata('idrol');
		if($idrol != 1){
			redirect(site_url(),'refresh');
		}
	}

	public function index()
	{
		date_default_timezone_set('America/bogota');
	}

	#=================================================================================
	# apps
	#=================================================================================
	public function apps($value='')
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$direccion_act = array(
				'<a href="'.site_url('').'">SICO Apps</a>',
				'<a href="#"">Admin</a>',
				'<a href="'.current_url('').'">Gestiones</a>'
			);

		$this->crear_vista('administracion/apps/lista', $direccion_act, NULL, TRUE, 0);
	}

	#=================================================================================
	# gestiones
	#=================================================================================
	public function gestiones($value='')
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$direccion_act = array(
				'<a href="'.site_url('').'">SICO Apps</a>',
				'<a href="#"">Admin</a>',
				'<a href="'.current_url('').'">Gestiones</a>'
			);

		$this->crear_vista('administracion/gestion/lista', $direccion_act, NULL, TRUE, 1);
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
				'<a href="'.site_url('').'">SICO Apps</a>',
				'<a href="#"">Admin</a>',
				'<a href="'.current_url('').'">Privilegios</a>'
			);

		$this->crear_vista('administracion/privilegios/lista', $direccion_act, NULL, TRUE, 2);
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
				'<a href="'.site_url('').'">SICO Apps</a>',
				'<a href="#"">Admin</a>',
				'<a href="'.current_url('').'">Gestiones</a>'
			);

		$this->crear_vista('administracion/roles/lista', $direccion_act, NULL, TRUE, 3);
	}
	#=================================================================================
	# roles
	#=================================================================================
	public function usuarios($value='')
	{
		if(!$this->sesion_iniciada()){
			redirect(site_url(""));
		}
		$direccion_act = array(
				'<a href="'.site_url('').'">SICO Apps</a>',
				'<a href="#"">Admin</a>',
				'<a href="'.current_url('').'">Gestiones</a>'
			);

		$this->crear_vista('administracion/usuarios/lista', $direccion_act, NULL, TRUE, 4);
	}

	#Crear una nueva vista
	private function crear_vista($vista, $direccion_act, $data, $menu = NULL, $selected = 0){		
		$contenido  = $this->load->view(
			$vista,
			$data,
			TRUE
		);
		if(isset($menu)){
			$menu = $this->cargar_menu_lat();
		}
		$html =	$this->load->view(
				"utilidades_visuales/vista_panel", 
				array(
					"vista_pr"=>$contenido, 
					"direccion_act"=>$direccion_act,
					"menu"=>$menu,
					"selected"=>$selected
					), 
				TRUE
			);
		$this->load->view("home",array("vista"=>$html));
	}
	

	#cargar menu lateral
	private function cargar_menu_lat()
	{
		$menu = array(
				#array("icono","texto","url"),				
				array('data-icon="C"','Apps (No permitido)', site_url("administracion/apps")),
				array('data-icon="t"','Gestiones', site_url("administracion/gestiones")),
				array('data-icon="J"','Privilegios', site_url("administracion/privilegios")),
				array('data-icon="s"','Roles', site_url("administracion/roles")),
				array('data-icon="-"','Usuarios', site_url("administracion/usuarios")),
				array('data-icon="&#xe004;"',' Visualización de usuario por contrato', site_url("usuario/visualizacion")),
				array('','Volver', site_url("panel")),
			);
		return $menu; 
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