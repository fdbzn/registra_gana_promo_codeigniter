<?php

/**
 * @author FDBP - 05-03-2020 <daniel.bazan@catorcedias.com>
 */
class Like_user_model extends CI_Model{
	var $table = "like_user";
	
	public function __construct() {
		parent::__construct();
	}
   
	public function exist_like_level( $user_id, $level ){
		$this->db->join('award a', "l.award_id=a.award_id");
		$this->db->where('l.user_id', $user_id);
		$this->db->where('a.level', $level);

		return $this->db->get( $this->table." l" );
	}
	public function add_like( $user_id, $award_id ){
        $data = array(
            'user_id'=>$user_id,
            'award_id'=>$award_id,
        );
        if ($this->db->insert( $this->table, $data )) {
            return $this->db->insert_id();
        }
        return 0;
	}
	
	public function get_awards_by_user_id( $user_id ){
		$this->db->where('user_id', $user_id);
		return $this->db->get( $this->table );
	}
	

}
