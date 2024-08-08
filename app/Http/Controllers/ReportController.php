<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use App\Models\Report;
use App\Models\User;
use App\Models\ReportUser;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    private $user;
    private $report;
    private $report_user;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->user = new User();
        $this->report = new Report();
        $this->report_user = new ReportUser();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('createReport')->with("userType", $this->userType);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportRequest $request)
    {
        $requestBody = $this->extractReportRequestData($request);

        $res = $this->handleReportSubmission($requestBody);

        if ($res) {
            return redirect('/home/1');
        } else {
            return back()->withInput();
        }
    }

    private function extractReportRequestData($request)
    {
        return [
            'title' => $request->title,
            'sei' => $request->sei,
            'mei' => $request->mei,
            'category' => $request->category,
            'content' => $request->content,
            'url' => $request->url,
            'image_path' => $request->image_path,
            'is_release' => intval($request->is_release),
            'user_id' => $this->userId
        ];
    }

    private function handleReportSubmission($requestBody)
    {
        return $this->report->submissonReport($requestBody);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $requestBody = $this->extractUpdateReportRequestData($request);

        $res = $this->handleUpdateReportSubmission($requestBody);

        if ($res) {
            return redirect('/home/1');
        } else {
            return back()->withInput();
        }
    }

    private function extractUpdateReportRequestData($request)
    {
        return [
            'id' => $request->reportid,
            'title' => $request->title,
            'sei' => $request->sei,
            'mei' => $request->mei,
            'category' => $request->category,
            'content' => $request->content,
            'url' => $request->url,
            'image_path' => $request->image_path,
            'is_release' => intval($request->is_release)
        ];
    }

    private function handleUpdateReportSubmission($requestBody)
    {
        return $this->report->updateReport($requestBody);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $report_id = $request->reportid;
        $res = $this->isDeleteReport($report_id);

        if ($res) {
            return redirect('/home/1');
        } else {
            return back()->withInput();
        }
    }

    private function isDeleteReport($report_id)
    {
        return $this->report->deleteReport($report_id);
    }

    public function isShowReport(Request $request)
    {
        $report_id = $request->reportid;

        $res = $this->recordUserReportShow($this->userId, $report_id);

        if (!$res) {
            return back()->withInput();
        }

        $report = $this->fetchReport($report_id);

        return view('report')
            ->with("report", $report)
            ->with("userType", $this->userType);
    }

    public function isShowUpdateReportPage(Request $request)
    {
        $report_id = $request->reportid;
        $report = $this->fetchReport($report_id);

        return view('updateReport')
            ->with("report", $report)
            ->with("userType", $this->userType);
    }

    private function fetchReport($report_id)
    {
        return $this->report->getReport($report_id);
    }

    private function recordUserReportShow($user_id, $report_id)
    {

        $setRecord = $this->recordReportView($user_id, $report_id);

        if ($setRecord) {
            return true;
        } else {
            return false;
        }
    }

    private function recordReportView($user_id, $report_id)
    {
        return $this->report_user->setRecordUserReportShow($user_id, $report_id);
    }

    public function isGetReportData()
    {
        $reportList = $this->fetchGetAllReportList();

        if ($reportList) {
            return response()->json(["status" => 200, "report" => $reportList]);
        } else {
            return response()->json(["status" => 500]);
        }
    }

    private function fetchGetAllReportList()
    {
        return $this->report->getAllReportList($this->userId, $this->userType);
    }
}
