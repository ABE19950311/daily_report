<?php
require("../models/mysql.php");
require("../models/redis.php");
require("./responseController.php");

$RESPONSE_HEADER = [
    "Content-Type" => "application/json",
    "Access-Control-Allow-Origin" => "*"
];

class sessionController {
    private $redis;
    private $mysql;

    public function __construct() {
        $this->redis = new redisModel();
        $this->mysql = new mysqlModel();
    }

    private function getSessionUserIdFromCookie() {
        $sessionToken = $_COOKIE["sessionToken"];
        if(!$sessionToken) return ""
        $user = $this->redis->getSessionToken($sessionToken);
        //TODO:変える
        $id = $this->mysql->dbSelect("account","id","where user=?",[$user]);
        return $id
    }
    
    public function apiIsSessionCheck() {
        $sessionUserId = getSessionUserIdFromCookie();
        if(!$sessionUserId) {
            response.responseProblemSessiionToken(res,"SessionUserId does not exist");
            return;
        }
        echo $sessionUserId;
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        response.doResponse(res,200,RESPONSE_HEADER,responseBody);
    }
    
    public function apiIsExsistCheck() {
        $loginUser = $_POST["loginUser"];
        $loginPassword = $_POST["loginPassword"];
        $result = $this->mysql.dbSelect("account","user,password",`WHERE user="${req["body"]["loginUser"]}" AND password="${req["body"]["loginPassword"]}"`);
        if(!$result.length) {
            response.responseProblemSessiionToken(res,"User does not exist");
            return;
        }
        $randomId = getRandomId();
        $sessionToken = "sessionToken-" . $randomId;
        $this->redis.setSessionToken($sessionToken,req["body"]["loginUser"]);
        $responseHeader = RESPONSE_HEADER;
        responseHeader["Set-Cookie"] = `sessionToken=${sessionToken}`
        const responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        response.doResponse(res,200,responseHeader,responseBody);
    }
    
    private function getRandomId() {
        return bin2hex(random_bytes(2));
    }
    
    public function apiIsLogout() {
        $sessionToken = $_COOKIE["sessionToken"];
        if(!$sessionToken) {
            response.responseProblemSessiionToken(res,"Session does not exist");
            return;
        }
        $this->redis.deleteSessionToken($sessionToken);
        $delCheck = $this->redis.getSessionToken($sessionToken);
        echo $delCheck;
        if(!$delCheck!=null) {
            response.responseProblemSessiionToken(res,"Session does exist");
            return;
        }
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        response.doResponse(res,200,RESPONSE_HEADER,responseBody);
    }
}

?>