<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;

class ReportController extends Controller
{
    private $user;
    private $report;

    public function __construct() {
        $this->user = new User();
        $this->report = new Report();
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
            'user_id' => $user_id
        ];

        $res = $this->report->submissonReport($requestBody);

        if($res) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 500]);
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
            'image_path' => $request->input("image_path")
        ];
        
        $res = $this->report->updateReport($requestBody);

        if($res) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 500]);
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
}
