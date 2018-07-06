<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function config_upload($nombre="termo"){
	
}
function app_termo($app="app.termo"){
	$ci =& get_instance();
	$ci->load->database();
	$res = $ci->db->get_where("aplicacion","nombre_app = '".$app."'");
	$r = $res->row();
	return $r->ruta_app;
}

function addlog($ip, $accion, $privilegio, $user){
	$data["direccion_ip"] = $ip;
	$data["actividad_realizada"] = $accion;
	$data["privilegio_idprivilegio"] = $privilegio;
	$data["usuario_idusuario"] = $user;
	$data["fecha_actividad"] = date("Y-m-d H:i:s a");
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->insert("log_movimientos",$data);
}


function getUser($id)
{
	$ci =& get_instance();
	$ci->load->database();
	$rt = $ci->db->get_where("usuario", array("idusuario"=>$id));
	if ($rt->num_rows() > 0) {
		$r = $rt->row();
		return $r->nombres." ".$r->apellidos;
	}
	return "";
}

function existeAppSesion($apps, $buscar){
	foreach ($apps as $key => $value) {
		if ($buscar == $value) {
			return TRUE;
		}
	}
	return FALSE;
}