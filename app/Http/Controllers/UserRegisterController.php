<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserRegisterController extends Controller
{
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index($userType)
    {
        return view("userRegister")->with("userType",$userType);
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
    public function store(UserRegisterRequest $request,$userType)
    {
        $requestUser = $request->input("user");
        $password = $request->input("password");
        
        $response = $this->user->isRegisterUser($requestUser,$password,$userType);
        
        if($response) {
            return redirect("/${userType}/login");
        } else {
            return redirect("/${userType}/userRegister");;
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
}
