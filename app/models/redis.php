<?php

class RedisModel {
    private $redis;

    public function __construct() {
        $this->redis = new Redis();
        $this->redis->connect("192.168.64.5",6379);
    }

    public function setSessionToken($token,$user) {
        try {
            $this->redis->set($token,$user);
            return true;
        } catch (Exception $error) {
            return $error;
        }
    }
    
    public function getSessionToken($token) {
        try {
            $result = $this->redis->get($token);
            return $result;
        } catch (Exception $error) {
            return $error;
        }
    }
    
    public function deleteSessionToken($token) {
        try {
            $this->redis->del($token);
            return true;
        } catch (Exception $error) {
            return $error;
        }
    }

}

?>