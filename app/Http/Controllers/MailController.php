<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    private $notification;

    public function __construct() {
        parent::__construct();
        $this->notification = new Notification();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        list($user_id, $userType) = $this->getUserInfo($request);

        if(!$user_id) {
            return back()->withInput();
        }

        $addressList = $this->notification->getAddress($user_id);

        return view('notification')
                ->with("addressList",$addressList)
                ->with("userType",$userType);
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
        $validator = $this->notification->validation($request->all());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        list($user_id, $userType) = $this->getUserInfo($request);
        $address = $request->input('mailAddress');

        if(!$user_id) {
            return back()->withInput();
        }

        $res = $this->notification->isRegisterAddress($address,$user_id);

        if($res) {
            return redirect('/mail')->with("userType",$userType);;
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
