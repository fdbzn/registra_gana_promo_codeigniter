<?php

/**
 * @author FDBP - 05-03-2020 <daniel.bazan@catorcedias.com>
 */
class Winner_model extends CI_Model{
	var $table = "winner";
	
	public function __construct() {
		parent::__construct();
	}
   
	public function find_by_user_id( $user_id ){
		$this->db->where('user_id', $user_id);
		return $this->db->get( $this->table );
	}
	public function get_winners(){
		$this->db->join( 'tang_user u', 'w.user_id = u.user_id', 'left' );
		$this->db->order_by( "w.type_winner", "DESC" );
		$this->db->order_by( "u.last_name", "ASC" );
		return $this->db->get( $this->table." w" );
	}
	public function insert_winner( $user_id, $type_winner ){
		$date_code = date("Y-m-d H:i:s");
		
		$arr_code_user= array(
			"user_id"=>$user_id,
			"type_winner"=>$type_winner,
			"create_at"=>$date_code
		);
		if ( $this->db->insert( $this->table, $arr_code_user ) ) {
			return $this->db->insert_id();
		}
		return 0;
	}
	
	public function remove_winner( $winner_id ){
		$this->db->where('winner_id', $winner_id);
        if ($this->db->delete($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
	}

}
