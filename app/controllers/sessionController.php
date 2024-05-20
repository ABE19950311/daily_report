<?php
require("../models/mysql.php");
require("../models/redis.php");
require("./responseController.php");

const RESPONSE_HEADER = [
    "Content-Type: application/json",
    "Access-Control-Allow-Origin: *"
];

class sessionController {
    private $redis;
    private $mysql;
    private $response;

    public function __construct() {
        $this->redis = new redisModel();
        $this->mysql = new mysqlModel();
        $this->response = new responseController();
    }

    private function getSessionUserIdFromCookie() {
        $sessionToken = $_COOKIE["sessionToken"];
        if(!$sessionToken) return "";
        $user = $this->redis->getSessionToken($sessionToken);
        $id = $this->mysql->dbSelect("account","id","user=:user",[":user"=>$user]);
        return $id;
    }
    
    public function apiIsSessionCheck() {
        $sessionUserId = $this->getSessionUserIdFromCookie();
        if(!$sessionUserId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        }
        echo $sessionUserId;
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,RESPONSE_HEADER,$responseBody);
    }
    
    public function apiIsExsistCheck() {
        $loginUser = $_POST["loginUser"];
        $loginPassword = $_POST["loginPassword"];
        $result = $this->mysql->dbSelect("account","user,password","user=:loginUser AND password=:loginPassword",[":loginUser"=>$loginUser,":loginPassword"=>$loginPassword]);
        if(!$result.length) {
            $this->response->responseProblemSessiionToken("User does not exist");
            return;
        }
        $randomId = $this->getRandomId();
        $sessionToken = "sessionToken-" . $randomId;
        $this->redis->setSessionToken($sessionToken,$loginUser);
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
        return bin2hex(random_bytes(2));
    }
    
    public function apiIsLogout() {
        $sessionToken = $_COOKIE["sessionToken"];
        if(!$sessionToken) {
            $this->response->responseProblemSessiionToken("Session does not exist");
            return;
        }
        $this->redis->deleteSessionToken($sessionToken);
        $delCheck = $this->redis->getSessionToken($sessionToken);
        echo $delCheck;
        if($delCheck!=null) {
            $this->response->responseProblemSessiionToken("Session does exist");
            return;
        }
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,RESPONSE_HEADER,$responseBody);
    }
}

?>