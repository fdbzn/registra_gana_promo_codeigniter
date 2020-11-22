<?php

/**
 * @author FDBP - 05-03-2020 <daniel.bazan@catorcedias.com>
 */
class Award_model extends CI_Model{
	var $table = "award";
	
	public function __construct() {
		parent::__construct();
	}
   
	public function get_awards_by_status( $status ){
		$this->db->select('a.award_id, a.name_award, a.name_img, count(l.like_id) likes');
		$this->db->join('like_user l', "l.award_id=a.award_id", "left");
		$this->db->where('a.status', $status);
		$this->db->group_by('a.award_id');

		return $this->db->get( $this->table." a" );
	}
	

	public function get_award( $award_id ){
		$this->db->select('a.*, count(l.like_id) likes');
		$this->db->join('like_user l', "l.award_id=a.award_id", "left");
		$this->db->where('a.award_id', $award_id);
		return $this->db->get( $this->table." a" );
	}

	public function get_awards(){
		$this->db->select('
		 a.award_id, a.name_award, a.name_img, a.status,
		 a.level, a.create_at,
		 count(l.like_id) likes');
		$this->db->join('like_user l', "l.award_id=a.award_id", "left");
		$this->db->group_by('a.award_id');
		return $this->db->get( $this->table." a" );
	}

	public function toggle_status($award_id, $check_action){
		$arr_upd = array(
            "status" => $check_action
        );
        $this->db->where("award_id", $award_id);
        $this->db->update($this->table, $arr_upd);

        return $this->db->affected_rows();
	}

	public function insert_award($name_img, $name_award,$level){
		$data_insert= array(
			"name_award"=>$name_award,
			"name_img"=>$name_img,
			"level"=> $level,
			"create_at"=>date("Y-m-d H:i:s")
		);
		if ( $this->db->insert( $this->table, $data_insert ) ) {
			return $this->db->insert_id();
		}
		return 0;
	}

}
