<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

abstract class Controller
{
    private $user;
    protected $token;
    protected $userId;
    protected $userType;
    protected $userName;

    public function __construct(Request $request) {
        $this->user = new User();
        $this->token = $request->cookie('sessionToken');
        $this->userId = $this->user->getLoginUserId($this->token);
        $this->userType = $this->user->getUserType($this->token);
        $this->userName = $this->user->getUserName($this->token);
    }

}
