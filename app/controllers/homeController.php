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
        $reportCount = $this->report->getReportSize();
        viewHomePage($reportList,$reportCount);
    }

    public function getDailyDiaryPage() {
        viewDailyDiaryPage();
    }

}

?>