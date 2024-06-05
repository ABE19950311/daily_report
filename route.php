<?php
require_once(dirname(__FILE__)."/app/controllers/sessionController.php");
require_once(dirname(__FILE__)."/app/controllers/mailController.php");
require_once(dirname(__FILE__)."/app/controllers/userRegisterController.php");
require_once(dirname(__FILE__)."/app/controllers/loginController.php");
require_once(dirname(__FILE__)."/app/controllers/homeController.php");
require_once(dirname(__FILE__)."/app/controllers/reportController.php");

$sessionController = null;
$mailController = null;
$userRegisterController = null;
$loginController = null;
$homeController = null;
$reportController = null;

try {
    $sessionController = new SessionController();
    $mailController = new MailController();
    $userRegisterController = new UserRegisterController();
    $loginController = new LoginController();
    $homeController = new HomeController();
    $reportController = new ReportController();
    main();
} catch(Exception $e) {
    echo json_encode($e);
}


function router($url) {
    global $sessionController,$mailController,$userRegisterController,$loginController,$homeController,$reportController;

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
        case "/daily":
            $homeController->getDailyDiaryPage();
            break;
        case "/isShowReport":
            $homeController->getReportPage();
            break;
        case "/isRegisterMailAddress":
            $mailController->isRegisterMailAddress();
            break;
        case "/getUserMailAddress":
            $mailController->getUserMailAddressList();
            break;
        case "/isSendMailAddressList":
            $mailController->isSendMailAddressList();
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
        case "/isRegisterReport":
            $reportController->apiIsRegisterReport();
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
    //getのquery外してパスだけ欲しい場合の対応をparse_urlでする
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    router($url);
}

?>