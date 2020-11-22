<script>

  fbq('track', 'CompleteRegistration');

</script>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
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
        $this->load->library('mailgun', $this->mailgun_setting);
    }


    public function recuperar() {
        $dataRecuperar = [
            'scriptsCSS' => [
                base_url()."assets/css/Login.css"
            ],
            'scriptsJS' => [
                base_url()."assets/js/Login.js"
            ]
        ];
        if (validate_session()) {
            redirect(base_url() . "participa");
        } else {
            $this->load->view("layouts/main_layout", array(
                "content" => $this->load->view("/login/recuperar", $dataRecuperar, true),
            ));
        }
    }

    public function updatePass() {
        $response = array();
        $response["success"] = false;
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $response["error_desc"] = "Email no es valido";
        } else {
            $email = $this->input->post("email");
            $newPass = $this->generatePassword();

            // --- new pass ---
            $blowfishPass = $this->generateBlowfishPass($newPass);
            // --- upd pass ---
            $updatePass = $this->user_model->upd_pass_by_mail($email, $blowfishPass);

            if ($updatePass) {
                // --- send mail update pass ---
                $mailBody = $this->load->view("mails/recuperar", ["newPass" => $newPass, "email" => $email], true);
                
                $sended = $this->mailgun->send_mail('contacto@contangquieromas.com', 'Con Tang Quiero Más', $email,  '', 'Tu contraseña ha sido actualizada', $mailBody, '');
                if ($sended) {
                    $response["success"] = true;
                } else {
                    $response["error_desc"] = "No se puede recuperar la contraseña";
                }
            } else {
                $response["error_desc"] = "Fallo la recuperación de contraseña";
            }
        }
        echo json_encode($response);
    }

    /**
     * public method to authenticate
     */
    public function authUser() {

        $response = array();
        $response["success"] = false;
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response["error_desc"] = "Todos los campos son requeridos";
        } else {
            // --- login validation in model and blowfish encryption
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $findUser = $this->blowfishValidation($email, $password);

            // --- if exist email and password is correct ---
            if ($findUser != false) {
                // --- save user in session variable ---
                $this->saveModelSession($findUser);
                // --- save last login in db ---
                //$this->user_model->updateLastLogin($email);

                // --- define redirection
                if (!empty($this->input->post("redir"))) {
                    $response["redirect"] = $this->input->post("redir");
                } else {
                    if ($this->session->last_visit_page) {
                        $response["redirect"] = $this->session->last_visit_page;
                    } else {
                        $response["redirect"] = base_url();
                    }
                }
                $response["success"] = true;
            } else {
                $response["error_desc"] = "Usuario o contraseña incorrectos";
            }
        }
        echo json_encode($response);
    }

    public function authUserPhone() {

        $response = array();
        $response["success"] = false;
        $this->form_validation->set_rules('phone', 'phone', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response["error_desc"] = "Todos los campos son requeridos";
        } else {
            // --- login validation in model and blowfish encryption
            $phone = $this->input->post("phone");
            $password = $this->input->post("password");
            $findUser = $this->blowfishValidationPhone($phone, $password);

            // --- if exist email and password is correct ---
            if ($findUser != false) {
                // --- save user in session variable ---
                $this->saveModelSession($findUser);
                // --- save last login in db ---
                //$this->user_model->updateLastLogin($email);

                // --- define redirection
                if (!empty($this->input->post("redir"))) {
                    $response["redirect"] = $this->input->post("redir");
                } else {
                    if ($this->session->last_visit_page) {
                        $response["redirect"] = $this->session->last_visit_page;
                    } else {
                        $response["redirect"] = base_url();
                    }
                }
                $response["success"] = true;
            } else {
                $response["error_desc"] = "Usuario o contraseña incorrectos";
            }
        }
        echo json_encode($response);
    }

    /**
     * validate if exist user and password is correct
     * @param string $password
     * @return CIobj
     */
    private function blowfishValidation($email, $password) {
        $userData = $this->user_model->get_user_by_email($email);
        if ($userData->num_rows() > 0) {
            $user = $userData->row();
            $blowfishPass = crypt($password, $user->password);
            if ($blowfishPass == $user->password) {
                return $userData;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * validate if exist user and password is correct
     * @param string $password
     * @return CIobj
     */
    private function blowfishValidationPhone($phone, $password) {
        $userData = $this->user_model->get_user_by_phone($phone);
        if ($userData->num_rows() > 0) {
            $user = $userData->row();
            $blowfishPass = crypt($password, $user->password);
            if ($blowfishPass == $user->password) {
                return $userData;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Is the route where facebook api redirect
     */
    public function callbackAuth() {
        // --- load facebook api
        $this->load->library('FacebookLogin', $this->fbSettings);
        $fbToken = $this->facebooklogin->getAuthToken();
        if (isset($fbToken)) {

            // --- using graph
            $fbUser = $this->facebooklogin->graphUser($fbToken);

            // --- do something with facebook user
            //print_r($fbUser->getFieldNames());
            $email = $fbUser->getField('email');
            if (isset($email)) {
                // --- save token in session
                $this->session->set_userdata("facebookToken", $fbToken);

                // --- buscar si existe en la base de datos
                $userData = $this->user_model->get_user_by_email($email);
                if ($userData->num_rows() > 0) {
                    // --- salvar sesion
                    $this->saveModelSession($userData);
                    $this->user_model->updateLastLogin($email);
                } else {
                    // --- si no existe registra
                    $fecha = new DateTime();

                    $insertedUser = $this->user_model->createSocialUser(
                            $fbUser->getField('id'), $fbUser->getField('first_name') . " " . $fbUser->getField('last_name'), $email, $this->generateBlowfishPass($fecha->getTimestamp())
                    );
                    if ($insertedUser > 0) {
                        // --- envia correo de bienvenida
                        //$htmlBody = $this->load->view("mails/mail_bienvenida_2019", ["nombre"=>$this->input->post('nombre')], true);
                        //$this->envia_mail($email, $htmlBody, "¡Bienvenido a Philadelphia!");
                        // --- registro hecho- redirecciona a participa o last page
                        $userCreated = $this->user_model->get_user_by_id($insertedUser);
                        $this->saveModelSession($userCreated);
                    }
                }
                if (!empty($this->input->post("redir"))) {
                    $response["redirect"] = $this->input->post("redir");
                } else {
                    if ($this->session->last_visit_page) {
                        redirect($this->session->last_visit_page);
                    } else {
                        redirect(base_url());
                    }
                }
            } else {
                echo "Verifica los permisos de facebook para la app Philadelphia.";
            }
        } else {
            redirect(base_url());
        }
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

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function exist_session(){
        $response["success"] = false;
        if(validate_session()){
            $response["success"] = true;
        }
        echo json_encode($response);
    }

    public function get_status_moments() {
        $response["success"] = false;

        if (validate_session()) {
            if ($this->session->message_moment) {
                
            } else {
                $this->load->model("club_momento_model");
                $user_moments = $this->club_momento_model->get_moments_by_user_id($this->session->id);
                if ($user_moments->num_rows() > 0) {
                    $response["success"] = true;
                    $response["moments"] = $user_moments->result_array();
                } else {
                    $response["error_desc"] = "Sin resultados";
                }
                $this->session->set_userdata('message_moment', true);
            }
        }

        echo json_encode($response);
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

    private function generatePassword($length = 8) {
        
    }

    private function envia_mail($email, $bodyMail = "**", $subject = "Philadelphia") {
        // --- send mail movie ticket ---
        $this->load->library('email');
        $this->email->from('envios@philadelphia.com.mx', 'Philadelphia');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($bodyMail);

        return $this->email->send();
    }

}

?>
