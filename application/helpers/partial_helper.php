<?php
if ( ! function_exists('load_partial'))
{
	function load_partial( $partial, $data = array() ) {
		$CI = & get_instance();
		$CI->load->view( $partial, $data );
	}
}
?>