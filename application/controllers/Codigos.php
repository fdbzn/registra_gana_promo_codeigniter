<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codigos extends CI_Controller {
    private $mailgun_setting = [
        'host'=>'smtp.mailgun.org',
        'username'=>'postmaster@contangquieromaspromo.com',
        'password'=>'',
    ];
    
    private $bearer_token;
    private $path_api;
    private $alias_bonnus;

	public function __construct() {
        parent::__construct();
        redirect('ganadores');

        $this->load->library('session');
        $this->load->model("user_model");
        $this->load->model("code_alphabet_model");
        $this->load->model("usercode_model");
        $this->load->model("tsp_model");
		$this->load->model("zip_code_model");
        $this->load->library('mailgun', $this->mailgun_setting);

        $this->bearer_token = "Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6Ik56QkJRalF4TWpaR01EZ3dRemt6T1RNMk5rUTRRMFJHUmtaQk5FTkVOMFU0UkVRMk1UVkZPQSJ9.eyJpc3MiOiJodHRwczovL2Jvbm51cy5hdXRoMC5jb20vIiwic3ViIjoiaTN5UEdjelFmTWxwc0tqbWZzZzhiTkx3OVJjMURKUUNAY2xpZW50cyIsImF1ZCI6Imh0dHBzOi8vYm9ubnVzYXBpMzAuYXp1cmV3ZWJzaXRlcy5uZXQvIiwiaWF0IjoxNTg4OTY2MDkxLCJleHAiOjE1OTE1NTgwOTEsImF6cCI6ImkzeVBHY3pRZk1scHNLam1mc2c4Yk5MdzlSYzFESlFDIiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIn0.mCdZWQTPc_xgAe5CE2ARoG-_Tuml0WxoX24WJyvgsqKZQRoctY6ShE1upwv6jJsVwkIYLePgDNhzTBoWZHES-cp0VLIsMzXsZZmptkd8hnGk8Czd7opiWfQXauUYbBTZyQZkGfnscEo3diUSBKmHqLE-JFv2wx4zIPpn_yi7ve5cSurYa-YcUVboaX7TSuxkkCqB-P0O0OSjkrtxOcWDYg0ZqpUZmx-LrH3cgaFJjnrnaJpWN7LGsph9yw3XXMvRK0c0ZeN8WmI4cdj6m1350jryS9rcVmBzmj7wSss7QdSJUgtcYC9klcQfLu56lsfBXPWhLTIpLwKE0TFcYDyxUw";
        $this->path_api = $this->define_enviroment_bonnus_path();
        $this->alias_bonnus = $this->define_alias_bonnus();
        
    }

	public function index()	{
        requireLogin("/");

        $data_tpl = [
			"tsp_s" => $this->tsp_model->get_all(),
			"states" => $this->zip_code_model->get_states()
		];
		$this->load->view('layouts/main_layout', [
			'scriptsJS'=>['assets/js/Codigos.js'],
			'scriptsCSS'=>["assets/css/Codigos.css"],
			'content'=>$this->load->view('codigos/index_codigos', $data_tpl, true)
		]);
	}


    public function save_codes_in_account() {
        json_val_login();
        $response = [];
        $codes = [];
        
        foreach ($this->input->post('tang_code') as $code) {
            if (!empty($code)) {
                $codes[] = $code;
            }
        }

        // --- xss clean 
        $clean_codes = $this->security->xss_clean($codes);

        // --- validate and insert a codes
        foreach ($clean_codes as $code) {
            $validate_code = $this->validate_code($code, $this->session->user_id); 
            $response[$code] = $validate_code;

            if($validate_code["success"]==true){
                // --- instant win
                $is_first_code = $this->is_first_code( $this->session->user_id );
                if($is_first_code){
                    $bonnus_api_process = $this->bonnus_api_process($this->session->user_id, $this->session->email, $this->session->state, $this->session->city, $this->session->tsp, $this->session->phone);
                    $response['bonnus'] = $bonnus_api_process;
                }
            }            
        }

        echo json_encode($response);
	}

	public function validate_code($code, $user_id, $type=1){
        $origin="web";
		$upper_code = strtoupper($code); 
        $prefix = substr( $upper_code, 0,1 );
        $real_code = substr( $upper_code, 1,8 );
        $response = ["success" => false];

        
        if( $prefix == 'T' || $prefix == 'S'){

            
            if (!empty($real_code)) {
                
                // --- validate if exist in user_code
                $exist_code = $this->usercode_model->get_code($real_code);
    
                if ($exist_code->num_rows() > 0) {
                    $response["error_desc"] = "Código ya fue registrado";
                } else {
                    // --- get alphabet table
                    $alphabetTable = $this->alphabetTable($real_code);
                    // --- find in table by alphabet if exist ---
                    $alphabet_code = $this->code_alphabet_model->existeCodigo($real_code, $alphabetTable);
                    
                    if ($alphabet_code->num_rows() > 0) {
                        $codeRecord = $alphabet_code->row();
                        
                        // --- if it is not use, resgister code ---
                        $usercode_insert = $this->usercode_model->insert_user_code($user_id, $real_code, $type, $origin);
                        if ($usercode_insert > 0) {
                            $response['success'] = true;
                            
                        } else {
                            $response["error_desc"] = "Error al asignar código";
                        }
                        
                    } else {
                        $response["error_desc"] = "Código no valido";
                    }
                }
            } else {
                $response["error_desc"] = "Se debe ingresar un código";
            }   
        } else {
            $response["error_desc"] = "Codigo no valido.";
        }
        
        return $response;
    }

    private function alphabetTable($codigo) {
        $caracter = strtolower(substr(trim($codigo), 0, 1));
        if (is_numeric($caracter))
            $tabla = 'code';
        else
            $tabla = 'code_' . $caracter;
        return $tabla;
    }
	
	private function is_first_code( $user_id ){
        //--- is first code in account
        $user_codes = $this->usercode_model->get_codes_by_user_id($user_id);
        $num_codes = $user_codes->num_rows();
        
        // --- validate if bonnus
        if( $num_codes == 1 ){
            //--- if is first code get a bonnus
            return true;
        }
        return false;
    }


    private function bonnus_api_process($user_id, $email, $user_state, $user_city, $tsp, $phone){
        $data_trigger["success"] = false;
        $user_bonnus = $this->initBonnus($user_id, $email, $user_state, $user_city, $tsp, $phone, $this->bearer_token);
        
        if(isset($user_bonnus["userId"])){
            // --- save bonnus_id
            $updated_user = $this->user_model->upd_bonnus_id($user_id, $user_bonnus["userId"]);
            //print_r($updated_user);
    
            // --- send trigger
            if($updated_user){
                $data_trigger = $this->trigger_bonnus($user_bonnus["userId"], $this->bearer_token); 
                $updated_bonnus_url = $this->user_model->upd_bonnus_url($user_id, $data_trigger["url"]);  
                $data_trigger["success"] = true;
            }else{
                $data_trigger["error_desc"]="exist bonnus record";
            }
        }else{
            $data_trigger["error_desc"]="error init bonnus";
        }

        return $data_trigger;
    }

    private function initBonnus($user_id, $email, $user_state, $user_city, $tsp, $phone, $bearer_token){
        $method_path='Initialize';
        $data_array =  [ 
            "Id"=> [
                "TypeName"=>strval(5),
                "TypeId"=> strval($user_id)
                    
            ],
            "data"=> [
                "carrier"=> (int)$tsp,
                // "city"=> $this->rsa_encrypt($user_city),
                // "state"=> $this->rsa_encrypt($user_state),
            ],
        ];

        $make_call = $this->callAPI('POST', $this->path_api.$method_path, json_encode($data_array), $bearer_token);
        
        return json_decode($make_call, true);
    }

    private function trigger_bonnus($bonnus_id, $bearer_token){
        
        $method_path='trigger/';
        //$momento_alias="RegistroPromocion"; 
        //$momento_alias="Test1"; 
        $value='';

        $data_array =  [ 
            "userId"=> strval($bonnus_id),
            "momentAlias"=> $this->alias_bonnus,
        ];

        //echo json_encode($data_array);
        $make_call = ["url"=>""];
        $make_call = $this->callAPI('POST', $this->path_api.$method_path, json_encode($data_array), $bearer_token);
        return json_decode($make_call, true);
    }

    private function rsa_encrypt($string){
        $encripted_str = "";
        /*
        $fp=fopen (base_url()."public.pem","r");
        $pub_key=fread ($fp,8192);
        fclose($fp);
        */

        $publicKey = '';
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" . wordwrap($publicKey, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
    
        $PK="";
        $PK=openssl_get_publickey($publicKey);
        if (!$PK) {
            echo "Cannot get public key";
        }
        $finaltext="";
        openssl_public_encrypt($string,$finaltext,$PK);
        if (!empty($finaltext)) {
            $encripted_str = base64_encode($finaltext);
            openssl_free_key($PK);
            //echo "Encryption OK!";
        }else{
            echo "Cannot Encrypt";
        }
        return $encripted_str;
    }

    private function callAPI($method, $url, $data, $bearer_token=""){
        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            $bearer_token
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        // EXECUTE:
        $result = curl_exec($curl);
        //var_dump($result);
        //echo "<br><br><br>";
        if(!$result){
            die("Connection Failure");
            //$result["success"] = false;
        }
        curl_close($curl);
        return $result;
    }

    public function define_enviroment_bonnus_path(){
        $path_api="";
        if( $_SERVER['ENVIRONMENT'] == "local" ){
            $path_api='https://bonnusapi30dev.azurewebsites.net/api/';
        }else if( $_SERVER['ENVIRONMENT'] == "development" ){
            $path_api='https://bonnusapi30.azurewebsites.net/api/';
            //$path_api='https://bonnusapi30dev.azurewebsites.net/api/';
        }else if($_SERVER['ENVIRONMENT'] == "production"){
            $path_api='https://bonnusapi30.azurewebsites.net/api/';
        }

        return $path_api;
    }
    public function define_alias_bonnus(){
        $alias="";
        if( $_SERVER['ENVIRONMENT'] == "local" ){
            $alias='Test1';
        }else if( $_SERVER['ENVIRONMENT'] == "development" ){
            $alias='primercodigo';
            //$alias='Test1';
        }else if($_SERVER['ENVIRONMENT'] == "production"){
            $alias='primercodigo';
        }

        return $alias;
    }
}
