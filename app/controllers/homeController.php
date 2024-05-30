<?php

require_once(dirname(__FILE__)."/../views/home.php");
require_once(dirname(__FILE__)."/mailController.php");

class HomeController {
    private $mail;

    public function __construct() {
        $this->mail = new MailController();
    }

    public function getHomePage() {
        viewHomePage();
    }

    public function getNotificationPage() {
        $mailAddressList = $this->mail->getUserMailAddressList();
        viewNotificationPage($mailAddressList);
    }

    public function getDailyDiaryPage() {
        viewDailyDiaryPage();
    }

}

?>