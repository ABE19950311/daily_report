<?php
require_once(dirname(__FILE__)."/../../config.php");
require_once(SMARTY_DIR . 'Smarty.class.php');

function viewHomePage($reportList) {
    $smarty = new Smarty();

    $smarty->template_dir = dirname(__FILE__)."/../templates/";
    $smarty->compile_dir = dirname(__FILE__)."/../../templates_c/";

    $array = [];

    for($i=0;$i<count($reportList);$i++) {
        array_push($reportList[$i]);
    }

    $smarty->assign("reportList", $reportList);

    $smarty->display('home.tpl');
}

function viewNotificationPage($mailAddressList) {
    $smarty = new Smarty();

    $smarty->template_dir = dirname(__FILE__)."/../templates/";
    $smarty->compile_dir = dirname(__FILE__)."/../../templates_c/";
    
    $array = [];

    for($i=0;$i<count($mailAddressList);$i++) {
        array_push($array,$mailAddressList[$i]["address"]);
    }

    $smarty->assign("mailAddressList", $array);

    $smarty->display('notification.tpl');
}

function viewDailyDiaryPage() {
    $smarty = new Smarty();

    $smarty->template_dir = dirname(__FILE__)."/../templates/";
    $smarty->compile_dir = dirname(__FILE__)."/../../templates_c/";

    $smarty->display('dailyDiary.tpl');
}

?>