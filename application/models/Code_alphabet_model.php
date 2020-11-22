<?php
class Code_alphabet_model extends CI_Model {

    private $database = "tang_codes.";

    public function __construct() {
        parent::__construct();
    }

    public function existeCodigo($code, $table) {
        $this->db->where('code', $code);
        return $this->db->get($this->database . $table);
    }

    public function upd_date_code($tableName,$id_code){
        $this->db->where('id_code', $id_code);
		$this->db->set( "date_use", date("Y-m-d g:i:s") );
		$this->db->update( $this->database.$tableName );
		
		if( $this->db->affected_rows() > 0 ){
			return $this->db->affected_rows();
		}
		return 0;
    }
    
    public function insert_code($tableName, $code){
		$arr_codigo= array(
			"code"=>$code,
			"batch"=>"0",
			"date_use"=>"0000-00-00 00:00:00"
		);

		if ( $this->db->insert( $this->database.$tableName, $arr_codigo ) ) {
			return $this->db->insert_id();
		}
		return 0;
	}

}

?>