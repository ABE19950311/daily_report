<?php
require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/../models/redis.php");

class BaseController {
    private $redis;
    private $mysql;

    public function __construct() {
        $this->redis = new RedisModel();
        $this->mysql = new MysqlModel();
    }

    public function getSessionUserIdFromCookie() {
        $sessionToken = $_COOKIE["sessionToken"];
        if(!$sessionToken) return "";
        $user = $this->redis->getSessionToken($sessionToken);
        $id = $this->mysql->dbSelect("account","id","user=:user",[":user"=>$user]);
        return $id[0]["id"];
    }
}

?>