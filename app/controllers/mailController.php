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
        return $id[0]["id"];
    }

    public function isRegisterMailAddress() {
        $mailAddress = $_POST["mailAddress"];
        $userId = $this->getSessionUserIdFromCookie();
        if(!$userId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        }
        $this->mysql->dbInsert("notification","(address,account_id)","(:address,:account_id)",[":address"=>$mailAddress,":account_id"=>$userId]);
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }

    public function getUserMailAddressList() {
        $userId = $this->getSessionUserIdFromCookie();
        if(!$userId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        }
        $mailAddressList = $this->mysql->dbSelect("notification","address","account_id=:account_id",[":account_id"=>$userId]);
        return $mailAddressList;
    }
}


?>