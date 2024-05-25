<?php
require_once(dirname(__FILE__)."/app/controllers/sessionController.php");
require_once(dirname(__FILE__)."/app/controllers/mailController.php");
require_once(dirname(__FILE__)."/app/controllers/authController.php");
require_once(dirname(__FILE__)."/app/controllers/loginController.php");



function router($url,$sessionController,$mailController,$authController,$loginController) {
    switch($url) {
        case "/isSessionCheck":
            $sessionController->apiIsSessionCheck();
            break;
        case "/isExsistCheck":
            $sessionController->apiIsExsistCheck();
            break;
        case "/isLogout":
            $sessionController->apiIsLogout();
            break;
        case "/isRegisterMailAddress":
            $mailController->isRegisterMailAddress();
            break;
        case "/getUserMailAddress":
            $mailController->getUserMailAddressList();
            break;
        case "/isRegisterUser":
            $authController->apiIsRegisterUser();
        case "/":
            $loginController->getLoginPage();
            break;
        default:
            getPage($url);
            break;
    }
};

function getPage($url) {
    $currentDir = getcwd();
    $pathInfo = pathinfo($url,PATHINFO_EXTENSION);

    $header = [
        "css" => "text/css",
        "js" => "text/javascript",
        "map" => "application/json"
    ];

    $filePath = $currentDir . $url;

    $html = file_get_contents($filePath);
    header("Content-Type: " . $header[$pathInfo]);
    echo $html;
}

function main() {
    $sessionController = new SessionController();
    $mailController = new MailController();
    $authController = new AuthController();
    $loginController = new LoginController();
    $url = $_SERVER["REQUEST_URI"];
    router($url,$sessionController,$mailController,$authController,$loginController);
};

main();


?>