<?php

/**
 * @author FDBP - 05-03-2020 <daniel.bazan@catorcedias.com>
 */
class Zip_code_model extends CI_Model{
	var $table = "codigo_postal";
	
	public function __construct() {
		parent::__construct();
	}
   
	public function get_states( ){
		$this->db->group_by('estado');
		return $this->db->get( $this->table );
	}
	
	public function get_cities_by_state( $state ){
		$this->db->where( "estado", $state );
		$this->db->group_by('municipio');
		return $this->db->get( $this->table );
	}
	

}
