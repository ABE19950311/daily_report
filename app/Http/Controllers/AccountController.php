<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function __construct(Request $request) {
        parent::__construct($request);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('account')
                ->with("userType", $this->userType)
                ->with("userName", $this->userName)
                ->with("userId", $this->userId);
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
        $validator = $this->validation($request->all());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
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

    public function isShowPassChangePage() {
        return view('passwordChange')
                ->with("userType", $this->userType)
                ->with("userName", $this->userName)
                ->with("userId", $this->userId);
    }

    private function validation($request) {
        $rules = array(
            'oldPassword' => 'required|max:255',
            'password' => 'required|max:255|confirmed'
        );
        $validator = Validator::make($request,$rules);
        return $validator;
    }
}
