<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S3t extends CI_Controller {
	public function __construct() {
        parent::__construct();
        
        $this->load->model("user_model");
	}
	
	public function ly( $token )	{
        $user_obj = $this->user_model->get_user_by_token($token);
        if( $user_obj->num_rows() > 0 ){
            $user = $user_obj->row();
            redirect($user->bonnus_url);
        }
	}


}
