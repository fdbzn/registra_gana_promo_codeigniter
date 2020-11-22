<?php

/**
 * @author FDBP - 14-02-16 <daniel.bazan@catorcedias.com>
 */
class Usercode_model extends CI_Model{
	var $table = "user_code";
	
	public function __construct() {
		parent::__construct();
	}
        
	public function get_my_num_codes($email="") {
		$this->db->where_in("st_user", $email);
		return $this->db->get( $this->table );
	}
        
	public function codes_in_account_by_st_user($codes, $st_user){
		$this->db->where_in("st_code", $codes);
		$this->db->where("st_user", $st_user);
		return $this->db->get( $this->table );
	}

	public function get_code($phCode){
		$this->db->select( "user_id" );
		$this->db->where( "code", $phCode ); 
		return $this->db->get( $this->table );
	}
	
	public function insert_user_code( $user_id, $code, $type, $origin="whats"){
		$date_code = date("Y-m-d H:i:s");
		
		$arr_code_user= array(
			"user_id"=>$user_id,
			"code"=>$code,
			"type"=> $type,
			"origin"=> $origin,
			"create_at"=>$date_code
		);
		if ( $this->db->insert( $this->table, $arr_code_user ) ) {
			return $this->db->insert_id();
		}
		return 0;
	}
	public function exist_recipe_detail( $recipe_id, $origin_detail ) {
		$this->db->select( "id" );
		$this->db->where( "co_recipe_id", $recipe_id );
		$this->db->where( "origin_detail", $origin_detail );
		return $this->db->get( $this->table );
	}
	public function num_assigned_codes( $user_id ){
		$user_mail = $this->user_mail_by_id( $user_id )->row()->email;
		$this->db->select( "id" );
		$this->db->where( "st_user", $user_mail );
		$this->db->where( "co_recipe_id >", 0 );
		return $this->db->get( $this->table );
	}	
	
	public function get_notications_by_origin_id( $email, $origin_id ){
		$this->db->select( "co_recipe_id, COUNT(co_recipe_id)" );
		$this->db->where( "st_user", $email );
		$this->db->where( "origin_id", $origin_id );
		$this->db->where( "notification_date", "0000-00-00 00:00:00" );
		$this->db->group_by( "co_recipe_id" );
		return $this->db->get( $this->table );
	}
	
	public function upd_notification_date( $co_recipe_id, $origin_id ){
		$where = array(
			"co_recipe_id" => $co_recipe_id,
			"origin_id" => $origin_id
		);
		$this->db->where( $where );
		$this->db->set( "notification_date", date("Y-m-d g:i:s") );
		$this->db->update( $this->table );
		
		if( $this->db->affected_rows() > 0 ){
			return $this->db->affected_rows();
		}
		return 0;
	}
	
	public function get_codes_mthan_date($date){
		$this->db->select("u.id, count(u.id) as total_acumulados, u.email" );
		$this->db->join( "user u", "u.email=philadelphia_club_usercode.st_user" );
		$this->db->where( "philadelphia_club_usercode.create_at>", $date );
		$this->db->group_by( "st_user" );
		return $this->db->get( $this->table );
	}
	
	private function user_mail_by_id( $user_id ) {
		$this->db->select( "email" );
		$this->db->where( "id", $user_id );
		return $this->db->get( "tang_user" );
	}



	public function get_codes_between_dates($startDate, $endDate, $offset= 0, $limit= 0){
		if($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$this->db->select('e.nom_ent, m.nom_mun, e.nom_ent, u.nombre, u.apellido, u.email, u.telefono, u.fecha_nacimiento, u.sexo, u.estado,  u.ciudad,  u.id, count(uc.st_code) as num_cods' );
		$this->db->join( 'tang_user u', 'uc.st_user = u.email', 'left' );
		$this->db->join( 'entidad e', 'u.estado = e.cve_ent', 'left' );
		$this->db->join( 'municipio m', 'm.cve_mun = u.ciudad AND m.cve_ent = u.estado','left' );
		
		// --- normal query
		$this->db->where('date(uc.create_at) >=', $startDate);
      	$this->db->where('date(uc.create_at) <=', $endDate);
		$this->db->group_by( 'u.id' );
		$this->db->order_by( 'num_cods', 'DESC' );
		return $this->db->get( $this->table.' uc' );
	}

	public function num_codes_between_dates($startDate, $endDate){
		
		$this->db->select('count(*) as num_codes, user_id');
		$this->db->where('date(create_at) >=', $startDate);
      	$this->db->where('date(create_at) <=', $endDate);
		$this->db->group_by( 'user_id' );
		return $this->db->get($this->table);
		
	}
	
	public function get_codes_by_user_id( $user_id ){
		$this->db->where('user_id', $user_id);
		return $this->db->get( $this->table );
	}
	
	public function get_user_codes( $startDate, $endDate ){
		$this->db->where('date(uc.create_at) >=', $startDate);
		$this->db->where('date(uc.create_at) <=', $endDate);
		
		$this->db->select('uc.*, u.email, u.user_id');
		$this->db->join( 'tang_user u', 'uc.user_id = u.user_id', 'left' );
		return $this->db->get( $this->table.' uc' );
	}
}
