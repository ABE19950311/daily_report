<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

abstract class Controller
{
    private $user;
    protected $userId;
    protected $userType;

    public function __construct(Request $request) {
        $this->user = new User();
        $this->userId = $this->getUserId($request);
        $this->userType = $this->getUserType($request);
    }

    private function getUserId($request) {
        $token = $request->cookie('sessionToken');

        $userId = $this->user->getLoginUserId($token);

        return $userId;
    }

    private function getUserType($request) {
        $token = $request->cookie('sessionToken');

        $userType = $this->user->getUserType($token);

        return $userType;
    }
}
