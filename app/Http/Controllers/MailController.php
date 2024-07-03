<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MailController extends Controller
{
    private $notification;
    private $user;

    public function __construct() {
        $this->notification = new Notification();
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $token = $request->cookie('sessionToken');
        $user_id = $this->user->getLoginUserId($token);

        if(!$user_id) {
            return back()->withInput();
        }

        $addressList = $this->notification->getAddress($user_id);

        return view('notification')->with("addressList",$addressList);
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
        $token = $request->cookie('sessionToken');
        $address = $request->input('mailAddress');
        $user_id = $this->user->getLoginUserId($token);

        if(!$user_id) {
            return back()->withInput();
        }

        $res = $this->notification->isRegisterAddress($address,$user_id);

        if($res) {
            return redirect('/mail');
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
