<?php

/**
 * @author FDBP - 05-03-2020 <daniel.bazan@catorcedias.com>
 */
class Tsp_model extends CI_Model{
	var $table = "tsp";
	
	public function __construct() {
		parent::__construct();
	}
   
	public function get_all( ){
		return $this->db->get( $this->table );
	}

}
