<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model("award_model");
		$this->load->model("like_user_model");
		$this->load->model("tsp_model");
		$this->load->model("zip_code_model");
		$this->load->library('session');
	}
	
	public function index()	{
		
		$data_tpl = [
			"awards" => $this->award_model->get_awards_by_status(1),
			"tsp_s" => $this->tsp_model->get_all(),
			"states" => $this->zip_code_model->get_states()
		];

		$this->load->view('layouts/main_layout', [
			'scriptsJS'=>['assets/js/Home.js'],
			'scriptsCSS'=>["assets/css/Home.css"],
			'content'=>$this->load->view('home/index_home', $data_tpl, true)
		]);
	}

	public function environment(){
		echo $_SERVER['ENVIRONMENT'];
	}

}
