<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('config');		
		$this->rem_cache();
		date_default_timezone_set("America/Bogota");
	}

	public function index($error=NULL)
	{	
		if($this->sesion_iniciada()){
			redirect(site_url("panel"));
		}else{
			redirect(site_url("sesion/login"));
		}
	}
	#==================================== INICIO DE SESION ====================================================

	public function login($error=NULL)
	{
		$direccion_act = array('Inicio de sesion' );
		$data  =array("direccion_act"=>$direccion_act);
		if(isset($error)){
			$data["error"] = TRUE;
		}
		$this->load->view("inicio/login",$data);
	}

	#Valida los datos ingresados en el formulario de inicio
	public function validar_datos(){
		$direccion_act = array("Inicio de sesión","validando datos");
		$this->crear_vista('panel_inicio/carga_datos', $direccion_act, NULL, NULL, NULL, 0);	
		try {
			$this->load->database();
			$user = $this->input->post("user");
			$pass = $this->input->post("password");			
			
			$this->load->model("sesion_db");
			$users = $this->sesion_db->get_usuario_rol($user);
			if($user==FALSE){
				echo "error de consulta en la base de datos";
				return;
			}
			$num_rows = $users->num_rows();
			if($num_rows > 0) {
				$this->load->library("encrypt");

				if($num_rows > 1){
					echo "Hay campos duplicados, por favor pongase en contacto y reporte este problema.";
				}else{
					$usuario = $users->row();
					if($pass === $this->encrypt->decode($usuario->password)){
						$privilegios = $this->datos_session($usuario->username, $usuario->rol_idrol);
						$data = array(
							'idusuario'=>$usuario->idusuario,
							'usuario'=>$this->encrypt->encode($user),
							'nombre_usuario'=>$usuario->nombres.' '.$usuario->apellidos,
							'idrol'=>$usuario->idrol,
							'nombre_rol'=>$usuario->nombre_rol,
							"identificacion"=>$usuario->persona_identificacion,
							'base'=>$usuario->base_idbase,
							'tipo_visualizacion'=>$usuario->tipo_visualizacion,
							'idpersona'=>$usuario->persona_identificacion,
							'apps'=>$privilegios['apps'],
							'gestiones'=>$privilegios['gestiones'],
							'privilegios'=>$privilegios['privilegios'],
							'isess' => TRUE
						);
						#$this->iniciar_sesion($json);
						#Agregar al log
						$this->iniciar_sesion($data);
						addlog($this->input->ip_address(), "inicio de session en webApps SICO", 13, $usuario->idusuario);
						redirect( site_url('sesion/') );
					}else{
						redirect( site_url('sesion/login/error') );
					}
				}
			}else{
				redirect( site_url('sesion/login/error') );
			}		
		} catch (Exception $e) {
			print_r($e);
		}
	}

	#------------------------------------------------------------------------
	#cargar datos de session_commit()
	private function datos_session($user, $idrol){
		$this->load->library("session");
		$privilegios = $this->sesion_db->cargar_privilegios($idrol);
		$arrayjson = array();
		$arraypriv = array();
		#privilegio
		foreach ($privilegios->result() as $priv) {
			$arraypriv[$priv->idprivilegio] = $priv->idprivilegio;
		}
		#gestion
		$arraygest = $this->carga_gestiones($idrol);
		#apps
		$arraapps = $this->carga_apps($idrol);		
		$arrayjson["privilegios" ]= $arraypriv;
		$arrayjson["gestiones"] = $arraygest;
		$arrayjson["apps"] = $arraapps;
		return $arrayjson;
	}

	private function carga_gestiones($idrol){
		$gestiones = $this->sesion_db->cargar_grupo_gestiones_apps($idrol);
		$arraygest = array();
		foreach ($gestiones->result() as $ges) {
			array_push($arraygest, $ges->nombre_gestion);
		}
		return $arraygest;
	}

	private function carga_apps($idrol){
		$apps = $this->sesion_db->cargar_grupo_gestiones_apps($idrol,TRUE);
		$arrayapps = array();
		foreach ($apps->result() as $app) {
			array_push($arrayapps, $app->nombre_app);
		}
		return $arrayapps;
	}

	#===================================================================================================
	#iniciar sesión
	public function iniciar_sesion($data){
		try {
			$this->load->library("session");
			$this->session->set_userdata($data);
			return TRUE;
		} catch (Exception $e) {
			return FALSE;
		}
	}
	#===================================================================================================
	#finalizar sesón
	public function finalizar($value='')
	{
		$this->load->library("session");
		$this->session->sess_destroy();
		redirect(site_url(''));
	}
	public function rem_cache()
    {
        header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache"); 
    }	

	#====================================================================================================
	#cAMBIAR CONTRASEÑA
	public function cambia_pass($value='')
	{
		$pass = $this->input->post("pass");
		$pass1 = $this->input->post("pass1");
		$pass2 = $this->input->post("pass2");
		if($pass1 != $pass2){
			//echo $pass1." ".$pass2."-";
			redirect(site_url("sesion/config/1"));
		}
		$this->load->library("session");
		$this->load->database();
		$usr = $this->db->get_where("usuario","idusuario = ".$this->session->userdata('idusuario'));
		if($usr->num_rows() > 0){
			$this->load->library("encrypt");
			$us = $usr->row();
			if($this->encrypt->decode($us->password) == $pass){
				$this->db->update("usuario", array("password"=>$this->encrypt->encode($pass2)), "idusuario = ".$this->session->userdata('idusuario') );
				$data = array("success"=>"Su contraseña se ha guardado de manera exitosa");
			}else{
				$data = array("success"=>"Su contraseña actual no coincide con la ingresada");
			}
			//$this->mail($us->correo, $pass2);			
			$this->crear_vista("panel_inicio/cuenta", array("Panel de usuario","configuracion de datos de cuenta"), $data, NULL, TRUE, 1);
		}else{
			redirect(site_url("sesion/config/1"));
		}
	}

	private function mail($correo, $npass)
	{
		$this->load->library('email');
		$this->email->from('yeisontorrado@termotecnica.com.co', 'Tu nombre');
		$this->email->to($correo);

		$this->email->subject('Cambio de password');
		$this->email->message('Su nuevo password para ingresar a las apps app.termo es:'.$npass);

		$this->email->send();
	}
	#-------------------------------------
	public function genpass($pass="termo")
	{
		$this->load->library("encrypt");
		echo $this->encrypt->encode($pass);
	}
	public function decrypt($value='')
	{
		$this->load->library("encrypt");
		echo $this->encrypt->decode("WoNmEtJ9GGpff56g48ZUgsibevpUSzjSnOWirHREo0kxYJ647w0EoZAKYsRYcVm6Bdi0Uqv1o8m3RIOSWm8iXQ==");
	}
	#====================================================================================================
	#config cuenta
	public function access_change($err=NULL){
		$this->redir($this->sesion_iniciada());
		$direccion_act = array("Panel de usuario","configuracion de datos de cuenta");
		$data = array("err"=>$err);
		$this->crear_vista("panel_inicio/cuenta",$direccion_act, $data, NULL, TRUE, 2);
	}

	#====================================================================================================
	#Ver datos de session
	public function data(){
		$this->load->library("session");
		print_r($this->session->all_userdata());
	}


	#====================================================================================================
	#agregar correo para notificaciones importantes	

	#===================================== Utilidades privadas ===========================================

	#comprobar sesion; Si la session ha sido iniciada retorna TRUE en otro caso Retorna FALSE.

	private function sesion_iniciada()
	{
		$this->load->library("session");
		if($this->session->userdata("isess")){
			return TRUE;
		}
		return FALSE;
	}
	private function redir($val = FALSE)
	{
		if(!$val){
			redirect(site_url(""));
		}
	}

	#Crear una nueva vista
	private function crear_vista($vista, $direccion_act, $data, $json = NULL, $menu = NULL, $selected = 0){		
		$contenido  = $this->load->view(
			$vista,
			array("json"=>$json, "data" => $data),
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
				array('data-icon="C"','panel incio', site_url("panel")),
				array('data-icon="t"','Mi cuenta', site_url("panel/cuenta")),
				array('data-icon="z"','Datos de acceso', site_url("sesion/config")),
				array('data-icon="@"','Sesión', site_url('panel/sesion'))
			);
		return $menu; 
	}

}

/* End of file  */
/* Location: ./application/controllers/ */