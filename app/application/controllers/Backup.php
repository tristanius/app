<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->bkup();
	}

	public function bkup($value='')
	{
		$this->dobkup("app","app1");
		$this->dobkup("gd2","app2");
		$this->dobkup("ot","app3");
		$this->dobkup("rb","app4");
	}
	private function dobkup($bd, $conn)
	{
		echo $bd." ".$conn."<br>";
		date_default_timezone_set("America/Bogota");
		$obj = $this->load->database($conn,TRUE);
		$this->load->dbutil($obj);
		$this->load->helper("file");
		$config = array(
			'format'        => 'txt',
        	'filename'      => $bd.'.sql',  
			);
		$bkup = $this->dbutil->backup($config);

		$this->crear_directorio("./BACKUP/");
		$this->crear_directorio("./BACKUP/".date('Y-m-d')."/");
		write_file('./BACKUP/'.date("Y-m-d").'/'.$bd.".sql", $bkup);
	}

	private function crear_directorio($dir){
		#rmdir("./uploads/".$dir);
		if (!file_exists($dir)) {
			mkdir($dir, 0777);
		}
  	}
}

/* End of file Backup.php */
/* Location: ./application/controllers/Backup.php */