<?php
require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/../models/redis.php");
require_once(dirname(__FILE__)."/responseController.php");


class SessionController {
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
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }
}

?>