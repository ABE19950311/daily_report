<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

abstract class Controller
{
    private $user;
    protected $userId;
    protected $userType;
    protected $userName;

    public function __construct(Request $request) {
        $this->user = new User();
        $token = $request->cookie('sessionToken');
        $this->userId = $this->user->getLoginUserId($token);
        $this->userType = $this->user->getUserType($token);
        $this->userName = $this->user->getUserName($token);
    }

}
