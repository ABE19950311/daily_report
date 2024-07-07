<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionController extends Controller
{
    public function isLogout(Request $request) {
        $user = new User();
        $token = $request->cookie('sessionToken');
        $userType = $user->getUserType($token);
        $res = $user->deleteSession($token);
        
        if($res) {
            return redirect("/$userType/login")->withoutCookie('sessionToken');
        } else {
            return back()->withInput();
        }
    }
}
