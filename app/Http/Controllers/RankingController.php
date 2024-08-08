<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportUser;

class RankingController extends Controller
{
    private $report_user;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->report_user = new ReportUser();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rankList = $this->fetchUserRankList();

        if (!$rankList) {
            return back();
        }

        return view("ranking")
            ->with("userType", $this->userType)
            ->with("rankList", $rankList);
    }

    private function fetchUserRankList()
    {
        return $this->report_user->getUserRankList();
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
