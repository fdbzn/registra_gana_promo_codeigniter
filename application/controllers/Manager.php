<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
	public function __construct() {
		parent::__construct();
		devAuth();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model("user_model");
		$this->load->model("usercode_model");
		$this->load->model("award_model");
		$this->load->model("winner_model");
		$this->load->model("code_alphabet_model");
    }

	public function index()	{
		$this->load->view('layouts/manager_layout', [
			'scriptsJS'=>[base_url().'assets/js/manager.js'],
			'scriptsCSS'=>[base_url()."assets/css/manager.css"],
			'content'=>$this->load->view('manager/index_manager', [], true)
		]);
	}

	public function csv_report_users(){
		$ini_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		$this->send_excel_headers('report-users-'.$ini_date.'-'.$end_date);

		$data['users'] = $this->user_model->get_users_by_date($ini_date, $end_date);
		$this->load->view('manager/csv_report_users', $data);
	}

	public function csv_report_codes(){
		$ini_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		$this->send_excel_headers('report-codes-'.$ini_date.'-'.$end_date);

		$data['users'] = $this->usercode_model->get_user_codes($ini_date, $end_date);
		$this->load->view('manager/csv_report_codes', $data);
	}
	
	public function premios(){
		$data['awards'] = $this->award_model->get_awards();
		$this->load->view('layouts/manager_layout', [
			'scriptsJS'=>[base_url().'assets/js/manager.js'],
			'scriptsCSS'=>[base_url()."assets/css/manager.css"],
			'content'=>$this->load->view('manager/premios', $data, true)
		]);
	}

	public function status_award(){
		$response = array();
        $response["success"] = false;
        $award_id = $this->input->post("award_id");
        $check_action = $this->input->post("check_action");

        //alternar estatus de rejected en co_recipe
        $success_upd = $this->award_model->toggle_status($award_id, $check_action);
        if ($success_upd > 0) {
            $response["success"] = true;
        } else {
            $response["error_desc"] = "Sin cambios en el registro";
        }
        echo json_encode($response);
	}

	public function nuevo_premio() {
		$this->form_validation->set_rules('name_award', 'nombre', 'required');
		$this->form_validation->set_rules('nivel_award', 'nivel', 'required');
        $form_validation = $this->form_validation->run();
		$data = array("error"=>"");
        if ($form_validation === true) {
            // --- upload image
			//$config['upload_path'] = $_SERVER['DOCUMENT_ROOT']."/".base_url().'assets/images/awards';
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/assets/images/awards';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '1000';
            $config['max_width'] = '768';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload("img_award")) {
                $data["error"] = $this->upload->display_errors();          
            } else {
                // --- insert new award
                $update_detail = $this->upload->data();
                
                
                $award_id_inserted = $this->award_model->insert_award(
					$update_detail["file_name"], 
					$this->input->post("name_award"),
                    $this->input->post("nivel_award")
                );
				
				if($award_id_inserted>0){
					redirect("manager/premios");
				}else{
					$data["error"] = "error al registrar"; 
				}		
            }
        }
        
        $data_layout = array(
            'content' => $this->load->view('/manager/nuevo_premio', $data, TRUE),
            'title' => 'Nuevo premio');     
        $this->load->view('layouts/manager_layout', $data_layout );
	}

	public function nuevo_ganador() {
		$this->form_validation->set_rules('user_id', 'id de usuario', 'required');
		$this->form_validation->set_rules('type_winner', 'tipo de ganador', 'required');
        $form_validation = $this->form_validation->run();
		$data = array("error"=>"");
        if ($form_validation === true) {
			$winner_inserted = $this->winner_model->insert_winner(
				$this->input->post("user_id"),
				$this->input->post("type_winner")
			);
			
			if( $winner_inserted ){
				redirect("manager/nuevo_ganador");
			}else{

			}
        }
		
		$data["winners"] = $this->winner_model->get_winners();
        $this->load->view('layouts/manager_layout', array(
			'scriptsJS'=>[base_url().'assets/js/manager.js'],
            'content' => $this->load->view('/manager/nuevo_ganador', $data, TRUE),
			'title' => 'Nuevo premio')
		);
	}

	public function remove_winner(){
		$response = array();
		$response["success"] = false;
		
		$winner_id = $this->input->post("winner_id");
		$removed_user = $this->winner_model->remove_winner($winner_id);
        if( $removed_user > 0 ){
			$response["success"] = true; 
		}else{
			$response["error_desc"] = "no se pudo borrar"; 
		}

		echo json_encode( $response );
	}
	
	public function buscarUsuario(){
        $user_email = $this->input->post("mail");
        $data = array();
        if (!empty($user_email)){
            $users_results = $this->user_model->search_users_by_email($user_email);
            $num_users_results = $users_results->num_rows();
            $data['users'] =  $users_results;
        }else{
            $data['message'] = "error";
        }

       
        $this->load->view('layouts/manager_layout', 
            array('content' => $this->load->view('manager/buscar_usuario',
               $data
            , true))  
        );   

	}

	public function buscar_codigo(){
    
        $this->load->view('layouts/manager_layout',[
			'scriptsJS'=>[base_url().'assets/js/manager.js'],
			'content' => $this->load->view('manager/buscar_codigo',[], true)
		]);   

	}
	
	public function search_code(){
		$code = $this->input->post("code");
		$validate_code = $this->validate_code($code);
		echo json_encode($validate_code);
	}

	public function reset_password( $email="" ){
        $email_form = $this->input->post("f_email");
        $newpass_form = $this->input->post("f_pass");
        $success = false;
        
        if( !empty($newpass_form) && !empty($email_form) ){    
            $email = $email_form;
            //upd pass
			$upd_pass = $this->updatePass( $email, $newpass_form );
			if($upd_pass){
                $success = true;
            }
        }
        $this->load->view('layouts/manager_layout', 
            array('content' => $this->load->view('manager/reset_password', [
                "email"=>$email,
                "success"=>$success,
            ], true))  
        );
	}
	
	private function updatePass($email, $newPass) {

        // --- new pass ---
        $blowfishPass = $this->generateBlowfishPass($newPass);
        // --- upd pass ---
        $updatePass = $this->user_model->upd_pass_by_mail($email, $blowfishPass);

        if ($updatePass) {
            // --- send mail update pass ---
            return true;
            
        } else {
            return false;
        }
        
	}
	
	private function generateBlowfishPass($password) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
    }

	private function validate_code($code){
        $origin="web";
		$upper_code = strtoupper($code); 
        $prefix = substr( $upper_code, 0,1 );
        $real_code = substr( $upper_code, 1,8 );
        $response = ["success" => false];

        
        if( $prefix == 'T' || $prefix == 'S'){

            
            if (!empty($real_code)) {
                
                // --- validate if exist in user_code
                $exist_code = $this->usercode_model->get_code($real_code);
    
                if ($exist_code->num_rows() > 0) {
                    $response["error_desc"] = "Código ya fue registrado por un usuario";
                } else {
                    // --- get alphabet table
                    $alphabetTable = $this->alphabetTable($real_code);
                    // --- find in table by alphabet if exist ---
                    $alphabet_code = $this->code_alphabet_model->existeCodigo($real_code, $alphabetTable);
                    
                    if ($alphabet_code->num_rows() > 0) {
                            $response['success'] = true;
                        
                    } else {
                        $response["error_desc"] = "Código no valido - no existe en la BD";
                    }
                }
            } else {
                $response["error_desc"] = "Se debe ingresar un código";
            }   
        } else {
            $response["error_desc"] = "Codigo no valido - el prefijo no es valido";
        }
        
        return $response;
	}
	private function alphabetTable($codigo) {
        $caracter = strtolower(substr(trim($codigo), 0, 1));
        if (is_numeric($caracter))
            $tabla = 'code';
        else
            $tabla = 'code_' . $caracter;
        return $tabla;
    }

	private function send_excel_headers($file_name){
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=".$file_name.".xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
    }
	
}