<?php

require_once(dirname(__FILE__)."/../views/login.php");
require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/../models/redis.php");
require_once(dirname(__FILE__)."/responseController.php");

class LoginController {
    private $redis;
    private $mysql;
    private $response;

    private $RESPONSE_HEADER = [
        "Content-Type: application/json",
        "Access-Control-Allow-Origin: *"
    ];

    public function __construct() {
        $this->redis = new RedisModel();
        $this->mysql = new MysqlModel();
        $this->response = new ResponseController();
    }

    public function getLoginPage() {
        viewLoginPage();
    }

    public function apiIsExsistCheck() {
        $loginUser = $_POST["loginUser"];
        $loginPassword = $_POST["loginPassword"];

        $result = $this->mysql->dbSelect("account","user,password","user=:loginUser AND password=:loginPassword",[":loginUser"=>$loginUser,":loginPassword"=>$loginPassword]);

        if(!count($result)) {
            $this->response->responseProblemSessiionToken("User does not exist");
            return;
        }
        $randomId = $this->getRandomId();
        $sessionToken = "sessionToken-" . $randomId;
        $setSession = $this->redis->setSessionToken($sessionToken,$loginUser);
        if(!$setSession) {
            $this->response->responseProblemSessiionToken("Failed to set Token");
            return;
        }
        $responseHeader = [
            "Content-Type: application/json",
            "Access-Control-Allow-Origin: *",
            "Set-Cookie: sessionToken=$sessionToken"
        ];
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$responseHeader,$responseBody);
    }
    
    private function getRandomId() {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }
    
    public function apiIsLogout() {
        $sessionToken = $_COOKIE["sessionToken"];
        if(!$sessionToken) {
            $this->response->responseProblemSessiionToken("Session does not exist");
            return;
        }
        $deleteSession = $this->redis->deleteSessionToken($sessionToken);
        if(!$deleteSession) {
            $this->response->responseProblemSessiionToken("Failed to delete Session");
            return;
        }
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }
}


?>