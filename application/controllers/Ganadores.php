<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ganadores extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		

		$this->load->model("tsp_model");
		$this->load->model("zip_code_model");
		$this->load->model("winner_model");
	
	}
	
	public function index()	{
		$data_tpl = [
			"tsp_s" => $this->tsp_model->get_all(),
			"states" => $this->zip_code_model->get_states(),
			"winners" => $this->winner_model->get_winners()
		];

		$this->load->view('layouts/main_layout', [
			'scriptsJS'=>['assets/js/Contacto.js'],
			'scriptsCSS'=>["assets/css/Contacto.css"],
			'content'=>$this->load->view('ganadores/index_ganadores', $data_tpl, true)
		]);
	}

}
