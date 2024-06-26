<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $page = $request->query("page");
        $titleSearch = $request->query("titleSearch");
        $categorySearch = $request->query("categorySearch");
        $token = $request->cookie('sessionToken');
        $user_id = $this->user->getLoginUserId($token);

        $reportList = $this->report->getReportList($page,$user_id,$titleSearch,$categorySearch);
        $reportSize = $this->report->getReportSize($user_id,$titleSearch,$categorySearch);
        return view('home')->with("reportList",$reportList)->with("reportSize",$reportSize)->with("titleSearch",$titleSearch)->with("categorySearch",$categorySearch);
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
