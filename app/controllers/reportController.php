<?php
require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/../models/redis.php");
require_once(dirname(__FILE__)."/responseController.php");
require_once(dirname(__FILE__)."/baseController.php");

class ReportController extends BaseController {
    private $mysql;
    private $redis;
    private $response;

    private $RESPONSE_HEADER = [
        "Content-Type: application/json",
        "Access-Control-Allow-Origin: *"
    ];

    public function __construct() {
        parent::__construct();
        $this->mysql = new MysqlModel();
        $this->redis = new RedisModel();
        $this->response = new ResponseController();
    }

    public function main() {
        $method = $_SERVER["REQUEST_METHOD"];

        switch($method) {
            case "GET":
                $this->getReportPage();
                break;
            case "POST":
                $this->apiIsRegisterReport();
                break;
            case "PUT":
                $this->updateReport();
                break;
            case "DELETE":
                $this->deleteReport();
                break;
        }
    }

    public function getReportPage() {
        $report = $this->getReport();
        viewReportPage($report);
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

    public function updateReport() {
        parse_str(file_get_contents('php://input'),$putData);

        $reportId = $putData["reportid"];
        $title = $putData["title"];
        $sei = $putData["sei"];
        $mei = $putData["mei"];
        $category = $putData["category"];
        $content = $putData["content"];
        $url = $putData["url"];
        $image_path = $putData["image_path"];

        $column = "title=:title,sei=:sei,mei=:mei,category=:category,content=:content,url=:url,image_path=:image_path";
        $query = "id=:reportId";
        $params = [
            ":reportId"=>$reportId,
            ":title"=>$title,
            ":sei"=>$sei,
            ":mei"=>$mei,
            ":category"=>$category,
            ":content"=>$content,
            ":url"=>$url,
            ":image_path"=>$image_path
        ];

        $this->mysql->dbUpdate("report",$column,$query,$params);

        $responseBody = [
            "applicationStatusCode" => "Success",
            "applicationMessage" => "Success"
        ];
        $this->response->doResponse(200,$this->RESPONSE_HEADER,$responseBody);
    }

    public function deleteReport() {
        $reportId = $_GET["reportid"];

        $query = "id=:reportId";
        $params= [":reportId"=>$reportId];

        $this->mysql->dbDelete("report",$query,$params);

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

        $page = $_GET["page"];
        $reportsDisplayLimit = 10;
        $offset = ($page-1) * $reportsDisplayLimit;

        $column = "id,title,sei,mei,category,content,url,image_path";
        $query = "account_id=:account_id";
        $params = [
            ":account_id"=>$userId,
        ];

        $reportList = $this->mysql->selectOffsetReport("report",$column,$query,$reportsDisplayLimit,$offset,$params);
        return $reportList;
    }

    public function getReport() {
        $reportId = $_GET["reportid"];
        
        $column = "id,title,sei,mei,category,content,url,image_path";
        $query = "id=:reportId";
        $params = ["reportId"=>$reportId];

        $report = $this->mysql->dbSelect("report",$column,$query,$params);
        return $report;
    }

    public function getReportSize() {
        $userId = $this->getSessionUserIdFromCookie();

        if(!$userId) {
            $this->response->responseProblemSessiionToken("SessionUserId does not exist");
            return;
        };

        $reportDisplayLimit = 10;

        $query = "account_id=:account_id";
        $params = [
            ":account_id"=>$userId,
        ];

        $reportCount = $this->mysql->fetchAllRecordWithCondition("report",$query,$params);
        return floor($reportCount/$reportDisplayLimit)+1;
    }

    public function getUpdateReportPage() {
        $report = $this->getReport();
        viewUpdateReportPage($report);
    }

}

?>