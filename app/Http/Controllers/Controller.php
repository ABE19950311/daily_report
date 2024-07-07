<?php

namespace App\Http\Controllers;
use App\Models\User;

abstract class Controller
{
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    protected function getUserInfo($request) {
        $token = $request->cookie('sessionToken');

        $user_id = $this->user->getLoginUserId($token);
        $userType = $this->user->getUserType($token);

        return array($user_id, $userType);
    }
}
