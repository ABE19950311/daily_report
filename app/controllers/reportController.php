<?php
require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/../models/redis.php");
require_once(dirname(__FILE__)."/responseController.php");

class ReportController {
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

    public function apiIsRegisterReport() {
        $title = $_POST["title"];
        $sei = $_POST["sei"];
        $mei = $_POST["mei"];
        $category = $_POST["category"];
        $content = $_POST["content"];
        $url = $_POST["url"];
        $image_path = $_POST["image_path"];
        $userId = $this->getSessionUserIdFromCookie();

        if(!$userId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        };

        $colum = "(title,sei,mei,category,content,url,image_path,account_id)";
        $query = "(:title,:sei,:mei,:category,:content,:url,:image_path,:account_id)";
        $params = [":title"=>$title,":sei"=>$sei,":mei"=>$mei,":category"=>$category,":content"=>$content,":url"=>$url,":image_path"=>$image_path,":account_id"=>$userId];

        $this->mysql->dbInsert("report",$colum,$query,$params);

        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }

    public function getReportList() {
        $userId = $this->getSessionUserIdFromCookie();

        if(!$userId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        };

        $column = "id,title,sei,mei,category,content,url,image_path";
        $query = "account_id=:account_id";
        $params = [":account_id"=>$userId];

        $reportList = $this->mysql->dbSelect("report",$column,$query,$params);
        return $reportList;
    }

    public function apiIsShowReport() {
        $reportId = $_GET["reportid"];
        
        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }

}

?>