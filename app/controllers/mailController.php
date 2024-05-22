<?php

require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/../models/redis.php");
require_once(dirname(__FILE__)."/responseController.php");

class MailController {
    private $mysql;
    private $redis;
    private $response;
   
    private $RESPONSE_HEADER = [
        "Content-Type: application/json",
        "Access-Control-Allow-Origin: *"
    ];

    public function __construct() {
        $this->mysql = new MysqlModel();
        $this->redis = new RedisModel();
        $this->response = new ResponseController();
    }

    private function getSessionUserIdFromCookie() {
        $sessionToken = $_COOKIE["sessionToken"];
        if(!$sessionToken) return "";
        $user = $this->redis->getSessionToken($sessionToken);
        $id = $this->mysql->dbSelect("account","id","user=:user",[":user"=>$user]);
        return $id;
    }

    public function isRegisterMailAddress() {
        $mailAddress = $_POST["mailAddress"];
        $userId = $this->getSessionUserIdFromCookie();
        if(!$userId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        }
        $this->mysql->dbInsert("notification","(address,account_id)",":mailAddress,:userId",[":mailAddress"=>$mailAddress,"userId"=>$userId]);
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }

    public function getUserMailAddressList() {
        $userId = $this->getSessionUserIdFromCookie();
        if($userId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        }
        $mailAddressList = $this->mysql->dbSelect("notification","address","account_id=:account_id",[":account_id"=>$userId]);
        echo $mailAddressList;
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success",
            "mailAddressList" => $mailAddressList
        ];
        $this->response->doResponse(200,$RESPONSE_HEADER,$responseBody);
    }
}


?>