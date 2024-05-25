<?php
define('SMARTY_DIR', '/usr/local/lib/smarty-3.1.35/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');

function viewLoginPage() {
    $smarty = new Smarty();

    $smarty->template_dir = dirname(__FILE__)."/../templates/";
    $smarty->compile_dir = dirname(__FILE__)."/../../templates_c/";

    //$name = $_GET['name'];

    //$smarty->assign("name", $name);

    $smarty->display("login.tpl");
}

?>