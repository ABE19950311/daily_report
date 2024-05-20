<?php


class responseController {
    const RESPONSE_HEADER = [
        "Content-Type: application/json",
        "Access-Control-Allow-Origin: *"
    ];

    public function doResponse($httpStatusCode,$responseHeader,$responseBody) {
        http_response_code($httpStatusCode);
        for($i=0;$i<$responseHeader.length;$i++) {
            header($responseHeader[$i]);
        }
        echo json_encode($responseBody)."\n";
    }

    public function responseProblemSessiionToken($applicationMessage) {
        $this->doResponse(200,$this->RESPONSE_HEADER,[
            "applicationStatusCode" => "problem_process",
            "applicationMessage" => $applicationMessage
        ]);
    }
    
}


?>