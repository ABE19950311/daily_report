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
        case "/login":
            $loginController->main();
            break;
        case "/logout":
            $loginController->apiIsLogout();
            break;
        case "/session":
            $sessionController->apiIsSessionCheck();
            break;
        case "/home":
            $homeController->getHomePage();
            break;
        case "/daily":
            $homeController->getDailyDiaryPage();
            break;
        case "/report":
            $reportController->main();
            break;
        case "/report/update":
            $reportController->getUpdateReportPage();
            break;
        case "/mailaddress":
            $mailController->main();
            break;
        case "/mailaddress/send":
            $mailController->isSendMailAddressList();
            break;
        case "/register":
            $userRegisterController->main();
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