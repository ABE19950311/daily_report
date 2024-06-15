<?php
require_once(dirname(__FILE__)."/responseController.php");
require_once(dirname(__FILE__)."/baseController.php");


class SessionController extends BaseController {
    private $response;

    private $RESPONSE_HEADER = [
        "Content-Type: application/json",
        "Access-Control-Allow-Origin: *"
    ];

    public function __construct() {
        parent::__construct();
        $this->response = new ResponseController();
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