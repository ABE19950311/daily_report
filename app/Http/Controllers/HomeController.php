<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class HomeController extends Controller
{
    private $report;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->report = new Report();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('home');
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
    public function show(Request $request, string $page)
    {
        $titleSearch = $request->titleSearch;
        $categorySearch = $request->categorySearch;

        $reportList = $this->isGetReportList($page, $titleSearch, $categorySearch);
        $reportSize = $this->isGetReportSize($titleSearch, $categorySearch);

        return view('home')
            ->with("reportList", $reportList)
            ->with("reportSize", $reportSize)
            ->with("titleSearch", $titleSearch)
            ->with("categorySearch", $categorySearch)
            ->with("userType", $this->userType);
    }

    private function isGetReportList($page, $titleSearch, $categorySearch)
    {
        return $this->report->getReportList($page, $this->userId, $titleSearch, $categorySearch, $this->userType);
    }

    private function isGetReportSize($titleSearch, $categorySearch)
    {
        return $this->report->getReportSize($this->userId, $titleSearch, $categorySearch, $this->userType);
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
