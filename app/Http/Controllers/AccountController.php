<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountPasswordRequest;
use App\Http\Requests\AccountUserNameRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AccountController extends Controller
{
    private $user;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('account')
                ->with("userType", $this->userType)
                ->with("userName", $this->userName)
                ->with("userId", $this->userId);
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
        //
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

    public function isShowPassChangePage() {
        return view('passwordChange')
                ->with("userType", $this->userType)
                ->with("userName", $this->userName)
                ->with("userId", $this->userId);
    }

    public function isPasswordChange(AccountPasswordRequest $request) {    
        $oldPassword = $request->input("oldPassword");
        $password = $request->input("password");

        $oldPasswordCheck = $this->user->exsistUserCheck($this->userName,$oldPassword,$this->userType);

        if(!$oldPasswordCheck) {
            return back()->withInput()->withErrors("現在のパスワードが一致しません");
        }

        $response = $this->user->isUpdatePassword($this->userId,$password);

        if($response) {
            return redirect("/account");
        } else {
            return back()->withInput()->withErrors("パスワードの更新に失敗しました");
        }
    }

    public function isShowUserNameChangePage() {
        return view('userNameChange')
                ->with("userType", $this->userType)
                ->with("userName", $this->userName)
                ->with("userId", $this->userId);
    }

    public function isUserNameChange(AccountUserNameRequest $request) {
        $user = $request->input("user");

        $response = $this->user->isUpdateUserName($this->userId,$user);
        //ユーザ名変更でtokenとユーザ名紐づかなくなるため,redis更新
        $updateSession = $this->user->updateUserSession($this->token,$user);

        if($response && $updateSession) {
            return redirect("/account");
        } else {
            return back()->withInput()->withErrors("ユーザ名の更新に失敗しました");
        }
    }
}
