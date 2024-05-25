<?php

require_once(dirname(__FILE__)."/../views/login.php");

class LoginController {
    public function __construct() {

    }

    public function getLoginPage() {
        return viewLoginPage();
    }
}


?>