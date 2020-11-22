<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends CI_Controller {
	private $mailgun_setting = [
        'host'=>'smtp.mailgun.org',
        'username'=>'postmaster@contangquieromaspromo.com',
        'password'=>'',
    ]; 

	public function __construct() {
		parent::__construct();
		

		$this->load->model("tsp_model");
		$this->load->model("zip_code_model");
		$this->load->library('mailgun', $this->mailgun_setting);

	}
	
	public function index()	{
		$data_tpl = [
			"tsp_s" => $this->tsp_model->get_all(),
			"states" => $this->zip_code_model->get_states()
		];

		$this->load->view('layouts/main_layout', [
			'scriptsJS'=>['assets/js/Contacto.js'],
			'scriptsCSS'=>["assets/css/Contacto.css"],
			'content'=>$this->load->view('contacto/index_contacto', $data_tpl, true)
		]);
	}

	public function new_msg(){
		$response["success"]=false;
		$nombre = $this->input->post("nombre");
		$email = $this->input->post("email");
		$mensaje = $this->input->post("mensaje");

		if(empty($nombre) || empty($email) || empty($mensaje)){
			$response["error_desc"]="Todos los campos son obligatorios";
		}else{

			$html_body_msg = '
				Email:'.$this->input->post("email").'
				<br>Nombre:'.$this->input->post("nombre").'
				<br>Mensaje:'.$this->input->post("mensaje").'
			';
			
			$sended = $this->mailgun->send_mail('contacto@contangquieromas.com', 'Con Tang Quiero Más', 
			'contacto@contangquieromas.com',  'Contacto', 'Formulario contacto', $html_body_msg, '');
					
			if($sended==true){
				$response["success"] = true;
			}
		}

		echo json_encode($response);

	}

}
