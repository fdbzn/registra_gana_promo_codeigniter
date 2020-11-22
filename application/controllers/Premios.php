<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premios extends CI_Controller {
	public function __construct() {
		parent::__construct();
		

        $this->load->model("award_model");
		$this->load->model("like_user_model");
		$this->load->library('session');
		$this->load->model("tsp_model");
		$this->load->model("zip_code_model");
	}
	
	public function index()	{
		$data_tpl = [
			"tsp_s" => $this->tsp_model->get_all(),
			"states" => $this->zip_code_model->get_states(),
			"my_awards" => $this->like_user_model->get_awards_by_user_id($this->session->user_id),
			"awards" => $this->award_model->get_awards_by_status(1),
		];
		
		$this->load->view('layouts/main_layout', [
			'scriptsJS'=>[base_url().'assets/js/Premios.js'],
			'scriptsCSS'=>[base_url()."assets/css/Premios.css"],
			'content'=>$this->load->view('premios/index_premios', $data_tpl, true)
		]);
	}

	public function add_like(){
		json_val_login();

		$response["success"] = false; 
		$award_id = $this->input->post("award_id");
		// --- obtener nivel del premio
		$award_data = $this->award_model->award_model->get_award( $award_id );
		$level_award = $award_data->row()->level;
		
		// --- verificar que solo tenga un voto por level
		$exist_like_level = $this->like_user_model->exist_like_level($this->session->user_id, $level_award);
		if( $exist_like_level->num_rows() == 0 ){
			// ---  add like
			$liked = $this->like_user_model->add_like( $this->session->user_id, $award_id );
			if($liked){
				$response["success"] = true;
			}else{
				$response["error_desc"] = "No se pudo agregar el voto";
			}
		}else{
			$response["error_desc"] = "Solo se puede votar una vez";
		}

		echo json_encode($response);
	}


	public function premio_ganador()	{
		$data_tpl = [
			"tsp_s" => $this->tsp_model->get_all(),
			"states" => $this->zip_code_model->get_states(),
		];

		$this->load->view('layouts/main_layout', [
			'scriptsJS'=>[base_url().'assets/js/Premios.js'],
			'scriptsCSS'=>[base_url()."assets/css/Premios.css"],
			'content'=>$this->load->view('premios/premio_ganador', $data_tpl, true)
		]);
	}


}
