<?php
require_once(dirname(__FILE__)."/../../config.php");
require_once(SMARTY_DIR . 'Smarty.class.php');

function viewHomePage() {
    $smarty = new Smarty();

    $smarty->template_dir = dirname(__FILE__)."/../templates/";
    $smarty->compile_dir = dirname(__FILE__)."/../../templates_c/";

    //$name = $_GET['name'];

    //$smarty->assign("name", $name);

    $smarty->display('home.tpl');
}

?>