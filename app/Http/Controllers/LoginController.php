<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index($userType)
    {
        return view('login')->with("userType", $userType);
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
    public function store(LoginRequest $request, $userType)
    {
        $loginUser = $request->user;
        $password = $request->password;

        $response = $this->authenticateUser($loginUser, $password, $userType);

        if (!$response) {
            return back()->withInput()->withErrors("ユーザまたはパスワードが間違っています");
        }

        $token = $this->createSession($loginUser, $userType);

        if ($token) {
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

    private function authenticateUser($loginUser, $password, $userType)
    {
        return $this->user->exsistUserCheck($loginUser, $password, $userType);
    }

    private function createSession($loginUser, $userType)
    {
        return $this->user->setSession($loginUser, $userType);
    }
}
