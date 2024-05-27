<?php
require_once(dirname(__FILE__)."/app/controllers/sessionController.php");
require_once(dirname(__FILE__)."/app/controllers/mailController.php");
require_once(dirname(__FILE__)."/app/controllers/userRegisterController.php");
require_once(dirname(__FILE__)."/app/controllers/loginController.php");
require_once(dirname(__FILE__)."/app/controllers/homeController.php");



function router($url,$sessionController,$mailController,$userRegisterController,$loginController,$homeController) {
    switch($url) {
        case "/isSessionCheck":
            $sessionController->apiIsSessionCheck();
            break;
        case "/isExsistCheck":
            $loginController->apiIsExsistCheck();
            break;
        case "/isLogout":
            $loginController->apiIsLogout();
            break;
        case "/home":
            $homeController->getHomePage();
            break;
        case "/notification":
            $homeController->getNotificationPage();
            break;
        case "/isRegisterMailAddress":
            $mailController->isRegisterMailAddress();
            break;
        case "/getUserMailAddress":
            $mailController->getUserMailAddressList();
            break;
        case "/isRegisterUser":
            $userRegisterController->apiIsRegisterUser();
            break;
        case "/register":
            $userRegisterController->getUserRegisterPage();
            break;
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
    $userRegisterController = new UserRegisterController();
    $loginController = new LoginController();
    $homeController = new HomeController();
    $url = $_SERVER["REQUEST_URI"];
    router($url,$sessionController,$mailController,$userRegisterController,$loginController,$homeController);
};

main();


?>