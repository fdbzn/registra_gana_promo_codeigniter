<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model("usercode_model");
		$this->load->model("user_model");
		$this->load->model("tsp_model");
		$this->load->model("zip_code_model");
    }

	public function index()	{
		requireLogin("/");
		$data_tpl = [
			"tsp_s" => $this->tsp_model->get_all(),
			"states" => $this->zip_code_model->get_states(),
			"user_data"=>$this->user_model->get_user_by_id($this->session->user_id)->row(),
			"num_codes"=>$this->usercode_model->get_codes_by_user_id($this->session->user_id)->num_rows(),
		];

		$this->load->view('layouts/main_layout', [
			'scriptsJS'=>['assets/css/Perfil.js'],
			'scriptsCSS'=>["assets/css/Perfil.css"],
			'content'=>$this->load->view('perfil/index_perfil', $data_tpl, true)
		]);
	}

}
