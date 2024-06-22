<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
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
        $user = new User();

        $loginUser = $request->input("user");
        $password = $request->input("password");

        $response = $user->loginCheck($loginUser,$password);
        
        if(!$response) {
            return response()->json(['statusCode' => 500, 'redirect' => url('/register'), 'message' => "user or password does not exsist"]);
        } 

        $token = $user->setSessionToken($loginUser);

        if($token) {
            return response()->json(['statusCode' => 200])
                    ->withCookie('sessionToken', $token);
        } else {
            return response()->json(['statusCode' => 500, 'redirect' => url('/register'), 'message' => "failed to generate session token"]);
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
