<?php
class Registro extends CI_Controller {
    private $mailgun_setting = [
        'host'=>'smtp.mailgun.org',
        'username'=>'postmaster@contangquieromaspromo.com',
        'password'=>'',
    ];
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model("user_model");
		$this->load->model("zip_code_model");
        $this->load->library('mailgun', $this->mailgun_setting);
    }

    /**
     * Create a new account 
     */
    public function createUser() {
        $response = array();
        $response["success"] = false;

        // $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        // $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        
        // $this->form_validation->set_rules('mailreg', 'Mail', 'required|valid_email');
        // $this->form_validation->set_rules('dia', 'Día', 'required');
        // $this->form_validation->set_rules('mes', 'Mes', 'required');
        // $this->form_validation->set_rules('anio', 'Año', 'required');
        // $this->form_validation->set_rules('genero', 'Genero', 'required');
        // $this->form_validation->set_rules('estado', 'Estado', 'required');
        // $this->form_validation->set_rules('delegacion', 'Delegación', 'required');
        // $this->form_validation->set_rules('lada', 'Lada', 'required');
        // $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
        // $this->form_validation->set_rules('passReg', 'Contraseña', 'required');
        // $captcha = $this->input->post('g-recaptcha-response');

        // $form_validation = $this->form_validation->run();

        // if (empty($captcha)) {
        //     $response["error_desc"] = "Marca el reCaptcha";
        // } else {

        //     if ($form_validation === true) {
                // --- find if exist email
                 
                $existEmail = $this->user_model->get_user_by_email($this->input->post('mailreg'));
                if ($existEmail->num_rows() === 0) {
                    $userData = $this->user_model->get_user_by_phone($this->input->post('telefono'));
                    if ($userData->num_rows() == 0) {
                        $password = $this->input->post('passReg');
                        $token = sha1( $this->input->post('telefono').$this->input->post('nombre') );
                        $insertedUser = $this->user_model->createUser(
                            $this->input->post('nombre'),
                            $this->input->post('apellido'),
                            $this->input->post('apellido_materno'),
                            $this->input->post('edad'),
                            $this->input->post('email'),
                            $this->input->post('estado'),
                            $this->input->post('delegacion'),
                            $this->input->post('genero'),
                            $this->input->post('tsp'),
                            $this->input->post('telefono'),
                            $this->generateBlowfishPass($password),
                            'web',
                            $token
                        );
                        

                        if ($insertedUser > 0) {
                            // --- init user session ---
                            $userCreated = $this->user_model->get_user_by_id($insertedUser);
                            $this->saveModelSession($userCreated);
                            if ($this->session->last_visit_page) {
                                $response["redirect"] = $this->session->last_visit_page;
                            } else {
                                $response["redirect"] = base_url() . "codigos";
                            }

                            $htmlBody = $this->load->view("mails/welcome", ["nombre"=>$this->input->post('nombre')], true);

                            $sended_mail = $this->mailgun->send_mail('contacto@contangquieromas.com',
                            'Con Tang Quiero Más', $this->input->post('email'),  $this->input->post('nombre'), 'Bienvenido a Tang', $htmlBody, 'Gracias por registrarte');
                            if ($sended_mail) {
                                $response["mail_success"] = true;
                            } else {
                                $response["mail_success"] = false;
                            }

                            $response["success"] = true;
                        } else {
                            $response["error_desc"] = "Error al registrar";
                        }
                    }else{
                        $response["error_desc"] = "Ya existe un usuario con el teléfono indicado.";

                    }

                    
                } else {
                    $response["error_desc"] = "Este usuario ya fue registrado";
                }
        //     } else {
        //         $response["error_desc"] = validation_errors();
        //     }
        // }
        echo json_encode($response);
    }

    

    public function get_cities(){
        $cities = $this->zip_code_model->get_cities_by_state($this->input->post("state"));
        echo json_encode( $cities->result() );
    }

    /**
     * Generate a new Blowfish Password
     * @param string $password
     * @return string
     */
    private function generateBlowfishPass($password) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
    }

    /**
     * Save a model in session
     * @param CIobj $objmodel
     * @return type
     */
    private function saveModelSession($objmodel) {
        foreach ($objmodel->result_array() as $elem) {
            $this->session->set_userdata($elem);
        }
        return $this->session;
    }

    public function test_mail() {
        
        $sended = $this->mailgun->send_mail('contacto@contangquieromas.com', 'Con Tang Quiero Más', 
        'daniel.bazan@catorcedias.com',  '', 'Tu contraseña ha sido actualizada', "test", '');
                
        
        var_dump($sended);
    }
    
    
}

?>