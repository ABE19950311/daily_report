<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\ReportUser;

class ReportController extends Controller
{
    private $user;
    private $report;
    private $report_user;

    public function __construct() {
        $this->user = new User();
        $this->report = new Report();
        $this->report_user = new ReportUser();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('createReport');
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
    public function store(Request $request)
    {
        $token = $request->cookie('sessionToken');
        $user_id = $this->user->getLoginUserId($token);

        $requestBody = [
            'title' => $request->input("title"),
            'sei' => $request->input("sei"),
            'mei'=> $request->input("mei"),
            'category'=> $request->input("category"),
            'content' => $request->input("content"),
            'url'=> $request->input("url"),
            'image_path' => $request->input("image_path"),
            'is_release' => intval($request->input("is_release")),
            'user_id' => $user_id
        ];

        $res = $this->report->submissonReport($requestBody);

        if($res) {
            return redirect('/home/1');
        } else {
            return back()->withInput();
        }
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
        $report_id = $request->query("reportid");

        $requestBody = [
            'id' => $report_id,
            'title' => $request->input("title"),
            'sei' => $request->input("sei"),
            'mei'=> $request->input("mei"),
            'category'=> $request->input("category"),
            'content' => $request->input("content"),
            'url'=> $request->input("url"),
            'image_path' => $request->input("image_path"),
            'is_release' => intval($request->input("is_release"))
        ];
        
        $res = $this->report->updateReport($requestBody);

        if($res) {
            return redirect('/home/1');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $report_id = $request->query("reportid");
        $res = $this->report->deleteReport($report_id);

        if($res) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 500]);
        }
    }

    public function isShowReport(Request $request) {
        $report_id = $request->query("reportid");

        $report = $this->fetchReport($report_id);

        return view('report')->with("report",$report);
    }

    public function isShowUpdateReportPage(Request $request) {
        $report_id = $request->query("reportid");
        $report = $this->fetchReport($report_id);
        return view('updateReport')->with("report",$report);
    }

    private function fetchReport($report_id) {
        return $this->report->getReport($report_id);
    }

    public function recordUserReportShow(Request $request) {
        $token = $request->cookie('sessionToken');
        $user_id = $this->user->getLoginUserId($token);
        $report_id = $request->query("reportid");
    
        $setRecord = $this->report_user->setRecordUserReportShow($user_id,$report_id);

        if($setRecord) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 500]);
        }
    }
}
