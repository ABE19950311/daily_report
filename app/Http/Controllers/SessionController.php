<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionController extends Controller
{
    public function sessionCheck(Request $request) {
        $user = new User();
        $token = $request->cookie('sessionToken');
        $res = $user->getToken($token);
        if($res) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 500]);
        }
    }

    public function isLogout(Request $request,$userType) {
        $user = new User();
        $token = $request->cookie('sessionToken');
        $res = $user->deleteSession($token);
        
        if($res) {
            return redirect("/$userType/login")->withoutCookie('sessionToken');
        } else {
            return back()->withInput();
        }
    }
}
