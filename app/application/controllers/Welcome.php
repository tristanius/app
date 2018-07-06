<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Bogota");
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
	#=============================================================================
	public function recover($value=''){
		$direccion_act = array('app.termo',"formato de recuperación de cuenta" );
		$this->crear_vista("inicio/recover",NULL,$direccion_act);
	}


	#=============================================================================
	public function mailer($value='')
	{
		$this->load->database();
		$correo = $this->input->post("email");
		$mail = $this->db->get_where("usuario",array("correo"=>$correo));
		if($mail->num_rows() > 0){
			$this->load->library("email");
			$this->email->from('yeisontorrado@termotecnica.com', 'Yeison Torrado - Asist. de sistemas, Cúcuta.');
			$this->email->to($correo);
			$m = $mail->row();

			$this->email->subject('Cuenta de correo');
			$this->email->message('Tu cuenta de usuario reporta una requisición: '.$m->password);
			try {
				$this->email->send();	
				redirect(site_url('welcome/response'));
			} catch (Exception $e) {
				redirect(site_url("welcome/recover"));
			}
		}else{
			redirect(site_url("welcome/recover"));
		}
	}
	#=============================================================================
	public function response($value='')
	{
		$direccion_act = array('app.termo',"formato de recuperación de cuenta" );
		$this->crear_vista("inicio/response",NULL,$direccion_act);
	}


	#=============================================================================
	#=============================================================================
	#privado

	public function crear_vista($vista, $data, $direccion_act){
		if(isset($ismenu)){
			$menu = $this->cargar_menu_lat();
		}			
		$html = $this->load->view($vista, $data, TRUE);
		$vista = $this->load->view("utilidades_visuales/vista_horizont",
				array(
					"vista_pr"=>$html,
					"direccion_act"=>$direccion_act
					),
				TRUE );
		$this->load->view("home",array("vista"=>$vista));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */