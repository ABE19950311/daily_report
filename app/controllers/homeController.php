<?php

require_once(dirname(__FILE__)."/../views/home.php");
require_once(dirname(__FILE__)."/mailController.php");
require_once(dirname(__FILE__)."/reportController.php");

class HomeController {
    private $mail;
    private $report;

    public function __construct() {
        $this->mail = new MailController();
        $this->report = new ReportController();
    }

    public function getHomePage() {
        $reportList = $this->report->getReportList();
        viewHomePage($reportList);
    }

    public function getNotificationPage() {
        $mailAddressList = $this->mail->getUserMailAddressList();
        viewNotificationPage($mailAddressList);
    }

    public function getDailyDiaryPage() {
        viewDailyDiaryPage();
    }

    public function getReportPage() {
        $report = $this->report->getReport();
        viewReportPage($report);
    }

}

?>