<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once(dirname(__FILE__)."/../models/mysql.php");
require_once(dirname(__FILE__)."/../models/redis.php");
require_once(dirname(__FILE__)."/baseController.php");
require_once(dirname(__FILE__)."/responseController.php");
require_once("/usr/local/lib/PHPMailer/src/PHPMailer.php");
require_once("/usr/local/lib/PHPMailer/src/Exception.php");
require_once("/usr/local/lib/PHPMailer/src/SMTP.php");


class MailController extends BaseController {
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
                $this->getNotificationPage();
                break;
            case "POST":
                $this->isRegisterMailAddress();
                break;
        }
    }

    public function getNotificationPage() {
        $mailAddressList = $this->getUserMailAddressList();
        viewNotificationPage($mailAddressList);
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

    // public function isSendMailAddressList() {
    //     $mailAddressList = $this->getUserMailAddressList();

    //     if(!count($mailAddressList)) return;

    //     mb_language("uni");
    //     mb_internal_encoding("UTF-8");

    //     $mail = new PHPMailer(true);
    //     $mail->CharSet = "utf-8";

    //     try {
    //         $mailTo = [];
    //         $mailFrom
    //         $smtpHost
    //         $smtpUser
    //         $smtpPass = 
    //         $port = 587
    //         $subject = "hoge";
    //         $text = "test";

    //         for($i=0;$i<count($mailAddressList);$i++) {
    //             array_push($to,$mailAddressList[$i]["address"]);
    //         }

    //     } catch {

    //     }

    // }
}


?>