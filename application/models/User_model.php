<?php

/**
 * @author FDBP - 23-10-19 <daniel.bazan@catorcedias.com>
 */
class User_model extends CI_Model {
	private $table = "tang_user";

    public function __construct() {
        parent::__construct();
    }

    // public function get_user_by_phone( $phone_num ){
    //     return $this->db->query('
    //         SELECT *
    //         FROM tang_user
    //         WHERE telefono like "%'.$phone_num.'%"
            
    //     ');     
    // }

    public function user_update_token($user_id, $token){
        $this->db->set('token', $token);
        $this->db->where('id', $user_id);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
    }

    public function upd_bonnus_id($user_id, $bonnus_id){
        $this->db->set('bonnus_id', $bonnus_id);
        $this->db->where('user_id', $user_id);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
    }
    public function upd_bonnus_url($user_id, $bonnus_url){
        $this->db->set('bonnus_url', $bonnus_url);
        $this->db->where('user_id', $user_id);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
    }

    public function get_user_by_token( $token ){
        $this->db->where("token", $token);
		return $this->db->get( $this->table );
    }

    public function get_user_by_phone( $phone ){
        $this->db->where("phone", $phone);
		return $this->db->get( $this->table );
    }

    public function update_moment_status( $user_id ){
        $this->db->set('moment_created', 1);
        $this->db->where('user_id', $user_id);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;        
    }
	
    /**
     * update a new password
     * @param string $email
     * @param string $newPass
     * @return type
     */
    public function upd_pass_by_mail( $email, $newPass ) {
		$this->db->set('password', $newPass);
        $this->db->where('email', $email);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
    }

    public function upd_user_code( $user_id=0 ){
		$where = array(
			"id" => $user_id
		);
		$this->db->where( $where );
		$this->db->set( "cod_acumulados", 'cod_acumulados+1', FALSE );
		$this->db->update( $this->table );
		
		if( $this->db->affected_rows() > 0 ){
			return $this->db->affected_rows();
		}
		return 0;
	}
	
	/**
     * main login in app
     * @param string $email
     * @param string $password
     * @return type
     */
    public function get_user_by_email( $email ) {
		$this->db->where("email", strtolower($email));
		return $this->db->get($this->table);
    }

    /**
     * @author FDBP
     * @param int $user_id 
	 * @return obj
     */
    public function get_user_by_id($user_id) {
        $this->db->where("user_id", $user_id);
        return $this->db->get($this->table);
    }
	
	/**
	 * @param type $num_codes
	 * @param type $user_id
	 * @return int
	 */
    public function sum_code_user($num_codes, $user_id) {
        $this->db->set('cod_acumulados', 'cod_acumulados+' . $num_codes, FALSE);
        $this->db->where('id', $user_id);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
    }
	
	/**
	 * @param type $num_codes
	 * @param type $user_id
	 * @return int
	 */
    public function subtract_code_user($num_codes, $user_id) {
        $this->db->set('cod_canjeados', 'cod_canjeados+' . $num_codes, FALSE);
        $this->db->where('id', $user_id);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
    }
    
    
    /**
     * insert a new user 
     * @return int
     */
    public function createUser($name,$last_name,$second_last_name,$age,$email,$state,$city,$sex, $tsp, $phone,$password,$origin,$token) {

        $data = array(
            "name"=>$name,
            "last_name"=>$last_name,
            "second_last_name"=>$second_last_name,
            "age"=>$age,
            "email"=>strtolower($email),
            "state"=>$state,
            "city"=>$city,
            "sex"=>$sex,
            "tsp"=>$tsp,
            "phone"=>$phone,
            "password"=>$password,
            "token"=>$token,
            "origin"=>$origin,
            "create_at"=>date("Y-m-d H:i:s")
        );
        if ($this->db->insert( $this->table, $data )) {
            return $this->db->insert_id();
        }
        return 0;
    }

     /**
     * insert a new user to fix auronix 
     * @return int
     */
    public function fixCreateUser($name,$last_name,$second_last_name,$age,$email,$state,$city,$sex, $tsp, $phone,$password,$origin,$token, $create_at="") {
        $data = array(
            "name"=>$name,
            "last_name"=>$last_name,
            "second_last_name"=>$second_last_name,
            "age"=>$age,
            "email"=>$email,
            "state"=>$state,
            "city"=>$city,
            "sex"=>$sex,
            "tsp"=>$tsp,
            "phone"=>$phone,
            "password"=>$password,
            "token"=>$token,
            "origin"=>$origin,
            "create_at"=> empty($create_at) ? date("Y-m-d H:i:s") : $create_at
        );
        if ($this->db->insert( $this->table, $data )) {
            return $this->db->insert_id();
        }
        return 0;
    }
	
	/**
     * insert a new social user 
     * @param string $nombre
     * @param string $email
     * @param string $password
     * @param int $cp
     * @param string $estado
     * @param int $newsletter
     * @param int $sexo
     * @param int $estado_civil
     * @param string $fecha_nacimiento
     * @return int
     */
    public function createSocialUser($social_id, $nombre, $email, $password, $cp=0,  $estado="", $newsletter=0, $sexo = 0, $estado_civil = 0, $fecha_nacimiento = "00/00/0000") {
        $data = array(
            'fbid'=>$social_id,
            'nombre'=>$nombre,
            'email'=>$email,
            'password'=>$password,
            'newsletter'=>$newsletter,
            'origen_registro'=>'sitio',
            'fecha_nacimiento'=>date("Y-m-d", strtotime($fecha_nacimiento)),
            'sexo'=>$sexo,
            'estado_civil'=>$estado_civil,
            'last_login'=>date("Y-m-d H:i:s"),
            'estado'=>$estado,
            'cp'=>$cp
        );
        if ($this->db->insert( $this->table, $data )) {
            return $this->db->insert_id();
        }
        return 0;
    }
	
	public function updUser($userId,$nombre,$mailreg,$f_nacimiento,$calle,
		$no_ext,$genero,$e_civil,$no_int,$estado,$delegacion,$cp,$colonia,
		$referencia,$telefono ) {
		
		$setUpd = [
			"nombre"=>$nombre,
			"email"=>$mailreg,
			"fecha_nacimiento"=>$f_nacimiento,
			"direccion"=>$calle,
			"no_exterior"=>$no_ext,
			"sexo"=>$genero,
			"estado_civil"=>$e_civil,
			"no_interior"=>$no_int,
			"estado"=>$estado,
			"ciudad"=>$delegacion,
			"cp"=>$cp,
			"colonia"=>$colonia,
			"referencia"=>$referencia,
			"telefono"=>$telefono
		];
		 $where = array(
            "id" => $userId
        );
        $this->db->where($where);
        $this->db->update($this->table, $setUpd);

        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        }
        return 0;
	}
	
	public function get_all(){
        $this->db->join('entidad e', 'e.cve_ent = u.state_id');
		$this->db->join('municipio m', 'm.cve_mun = u.city_id AND u.state_id=m.cve_ent ');
		return $this->db->get($this->table.' u');
	}
	
	public function upd_codigos_by_user_id( $user_id, $codigos_acumulados ){
		$upd_data = [
            'cod_acumulados'=>$codigos_acumulados,
            
		];
		$this->db->where('id', $user_id);
		
        if ($this->db->update($this->table, $upd_data)) {
            return $this->db->affected_rows();
        }
        return 0;
	}
	
	public function updateLastLogin($email){
		$upd_data = [
            'last_login'=>date("Y-m-d H:i:s")
		];
		$this->db->where('email', $email);
		
        if ($this->db->update($this->table, $upd_data)) {
            return $this->db->affected_rows();
        }
        return 0;
    }
    
    public function all_user_count(){
        $this->db->select('count(*) as num_users');
        return $this->db->get($this->table);
    }

    public function user_count_by_date($start_date, $end_date){
        $this->db->where('date(dt_registro) >=', $start_date);
      	$this->db->where('date(dt_registro) <=', $end_date);
        return $this->db->get($this->table);
    }

    public function without_code_by_date($startDate, $endDate){
		$this->db->join( 'user_code uc', 'uc.st_user = u.email', 'left' );

		$this->db->where('uc.st_code IS  NULL', NULL, FALSE);
		$this->db->where('date(u.dt_registro) >=', $startDate);
		$this->db->where('date(u.dt_registro) <=', $endDate);
		
		$this->db->group_by( 'u.id' );
		return $this->db->get( $this->table.' u' );
    }
    
    public function users_in_user_code_by_date($startDate, $endDate){
		
		$this->db->join( 'user_code uc', 'uc.st_user = u.email');

		$this->db->where('date(u.dt_registro) >=', $startDate);
		$this->db->where('date(u.dt_registro) <=', $endDate);
		
		$this->db->group_by( 'u.id' );
		return $this->db->get( $this->table.' u' );
    }
    
    public function search_users_by_email($email){
        $this->db->select('*');
        $this->db->like('email', $email, 'both'); 
        return $this->db->get($this->table);
    }

    public function upd_status_user($user_status, $user_id){
        $this->db->set('user_status', $user_status);
        $this->db->where('user_id', $user_id);
        if ($this->db->update($this->table)) {
            return $this->db->affected_rows();
        }
        return 0;
    }

    
	public function get_users_by_date($startDate, $endDate){
        $this->db->where('date(u.create_at) >=', $startDate);
        $this->db->where('date(u.create_at) <=', $endDate);
        
        $this->db->select('u.*, count(uc.user_id) as num_codes');
        $this->db->join('user_code uc', 'uc.user_id = u.user_id', 'left');
        $this->db->group_by('u.user_id');
        $this->db->order_by('u.user_id');
        return $this->db->get($this->table.' u');
    }

    public function get_user_fix_url(){
        $query = '
        SELECT `u`.*, count(uc.user_id) as num_codes 
        FROM `tang_user` `u` 
        LEFT JOIN `user_code` `uc` ON `uc`.`user_id` = `u`.`user_id` 
        WHERE date(u.create_at) >= "2020-01-01" 
        AND date(u.create_at) <= "2020-06-01"  
        AND bonnus_url = ""
        GROUP BY `u`.`user_id` having num_codes>0 
        ORDER BY `u`.`user_id`
        ';
        return $this->db->query($query);
    }
}
