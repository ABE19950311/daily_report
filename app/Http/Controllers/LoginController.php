<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{

    public function __construct() {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index($userType)
    {
        return view('login')->with("userType",$userType);
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
    public function store(Request $request,$userType)
    {
        $user = new User();

        $loginUser = $request->input("user");
        $password = $request->input("password");

        $response = $user->exsistUserCheck($loginUser,$password,$userType);
        
        if(!$response) {
            return back()->withInput();
        } 

        $token = $user->setSession($loginUser,$userType);

        if($token) {
            return redirect('/home/1')->withCookie('sessionToken', $token);
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
