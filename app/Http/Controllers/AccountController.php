<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function isPasswordChange(Request $request) {    
        $validator = $this->passwordValidation($request->all());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

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

    public function isUserNameChange(Request $request) {
        $validator = $this->userNameValidation($request->all());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

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

    private function passwordValidation($request) {
        $rules = array(
            'oldPassword' => 'required|max:255',
            'password' => 'required|max:255|confirmed'
        );
        $validator = Validator::make($request,$rules);
        return $validator;
    }

    private function userNameValidation($request) {
        $rules = array(
            'user' => 'required|max:255|unique:users,name',
            'user_confirmation' => 'required|same:user'
        );
        $validator = Validator::make($request,$rules);
        return $validator;
    }
}
