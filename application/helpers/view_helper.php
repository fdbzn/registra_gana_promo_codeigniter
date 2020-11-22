<?php

if (!function_exists('menu_active')) {
    function menu_active($name_section) {
		$CI = & get_instance();
		
		if( $CI->uri->segment(1) == $name_section  ){
			return 'menu-active';
		}
		return '';
			
	}
}
if (!function_exists('loadJs')) {
    function loadJs($js) {
		if(is_array($js)){
			$jsHtmlTags = "";
			foreach( $js as $path_script ){
				$jsHtmlTags .= '<script src="'.$path_script.'"></script>';
			}
			return $jsHtmlTags;			
		}else{
			echo "scriptsJS: parametro debe ser un array";
		}	
	}
}

if (!function_exists('loadCss')) {
    function loadCss($css){ 
		if(is_array($css)){
			$cssHtmlTags = "";
			foreach( $css as $path_css ){
				$cssHtmlTags .= '<link rel="stylesheet" href="'.$path_css.'" />';
			}
			
			return $cssHtmlTags;
		}else{
			echo "scriptsCSS: parametro debe ser un array";
		}
	}
}


if(!function_exists('devAuth')){
	function devAuth(){
		$php_auth_user = isset($_SERVER['PHP_AUTH_USER'])?$_SERVER['PHP_AUTH_USER']:"";
		$php_auth_pw = isset($_SERVER['PHP_AUTH_PW'])?$_SERVER['PHP_AUTH_PW']:"";
		$password = define_password();
		
		
		if ( $php_auth_user== "catorce" && $php_auth_pw== $password) {	
		}
		else{
			header('WWW-Authenticate: Basic realm="Tang"');
			header('HTTP/1.0 401 Unauthorized');
			echo 'Acceso denegado';
			exit;
		}
	}
}
if (!function_exists('define_password')) {
    function define_password(){
        $password="";
        if ($_SERVER['ENVIRONMENT'] == "local") {
            $password='';
        } elseif ($_SERVER['ENVIRONMENT'] == "development") {
            $password='';
        } elseif ($_SERVER['ENVIRONMENT'] == "production") {
            $password='';
        }

        return $password;
    }
}

?>