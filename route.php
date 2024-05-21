<?php
require(dirname(__FILE__)."/app/controllers/sessionController.php");

$sessionController = new SessionController();

function router($url) {
    switch($url) {
        case "/isSessionCheck":
            $sessionController->apiIsSessionCheck();
            break;
        default:
            getPage($url);
            break;
    }
};

function getPage($url) {
    if($url=="/") {
        $url = "/dist/index.html";
    }
    $currentDir = getcwd();
    $pathInfo = pathinfo($url,PATHINFO_EXTENSION);

    $header = [
        "html"=>"text/html",
        "css"=>"text/css",
        "js"=>"text/javascript"
    ];

    $filePath = $currentDir . $url;

    $html = file_get_contents($filePath);
    header("Content-Type: " . $header[$pathInfo]);
    echo $html;
}

function main() {
    $url = $_SERVER["REQUEST_URI"];
    router($url);
};

main();


?>