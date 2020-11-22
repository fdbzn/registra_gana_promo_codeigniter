<?php
if ( ! function_exists('requireLogin'))
{
	function requireLogin($redirectPage) {
		if( validate_session() == false ){
			save_last_visit();
			redirect($redirectPage);
		}
	}
}
if ( ! function_exists('validate_session'))
{
	function validate_session() {
		$CI = & get_instance();
		$CI->load->library('session');
		$userId = $CI->session->user_id;

		if( isset($userId) ){
			return true;
		}
		return false;
	}
}

if ( ! function_exists('getDataSession'))
{
	function getDataSession() {
		$CI = & get_instance();
		$CI->load->library('session');
		return $CI->session;
	}

}
if ( ! function_exists('save_last_visit')){
	function save_last_visit(){
		$CI = & get_instance();
		$CI->load->library('session');
		$CI->session->set_userdata("last_visit_page", $CI->uri->uri_string());
	}
}
if ( ! function_exists('getSessionId')){
	function getSessionId(){
		$CI = & get_instance();
		$CI->load->library('session');
		return $CI->session->user_id;
	}
}
if ( ! function_exists('json_val_login')){
	function json_val_login() {
        if (validate_session() == false) {
            echo json_encode(array("success" => false, "error_desc" => "Inicia sesión", "errorCode" => 0));
            die();
        }
    }
}


?>
