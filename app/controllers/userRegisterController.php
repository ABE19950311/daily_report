<?php

require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/responseController.php");
require_once(dirname(__FILE__)."/../views/userRegister.php");

class UserRegisterController {
    private $mysql;
    private $response;

    private $RESPONSE_HEADER = [
        "Content-Type: application/json",
        "Access-Control-Allow-Origin: *"
    ];

    public function __construct() {
        $this->mysql = new MysqlModel();
        $this->response = new ResponseController();
    }

    public function main() {
        $method = $_SERVER["REQUEST_METHOD"];

        switch($method) {
            case "GET":
                $this->getUserRegisterPage();
                break;
            case "POST":
                $this->apiIsRegisterUser();
                break;
        }
    }

    public function getUserRegisterPage() {
        viewUserRegisterPage();
    }

    public function apiIsRegisterUser() {
        $user = $_POST["user"];
        $password = $_POST["password"];
        $result = $this->mysql->dbInsert("account","(user,password)","(:user,:password)",[":user"=>$user,":password"=>$password]);
    
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];

        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }
}


?>