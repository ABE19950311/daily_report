<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    private $notification;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->notification = new Notification();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!$this->userId) {
            return back()->withInput();
        }

        $addressList = $this->notification->getAddress($this->userId);

        return view('notification')
                ->with("addressList",$addressList)
                ->with("userType",$this->userType);
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
    public function store(NotificationRequest $request)
    {
        $address = $request->input('mailAddress');

        if(!$this->userId) {
            return back()->withInput();
        }

        $res = $this->notification->isRegisterAddress($address,$this->userId);

        if($res) {
            return redirect('/mail')->with("userType",$this->userType);;
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
