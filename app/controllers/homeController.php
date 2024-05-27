<?php

require_once(dirname(__FILE__)."/../views/home.php");

class HomeController {

    public function getHomePage() {
        viewHomePage();
    }

    public function getNotificationPage() {
        viewNotificationPage();
    }

}

?>