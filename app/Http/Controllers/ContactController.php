<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    private $contact;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->contact = new Contact();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view("contact")->with("userType", $this->userType);
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
        $validator = $this->validation($request->all());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $requestBody = [
            "name" => $request->input("name"),
            "address" => $request->input("address"),
            "contact" => $request->input("contact"),
            "user_id" => $this->userId
        ];
        
        $response = $this->contact->isRegisterContact($requestBody);

        if($response) {
            return redirect("/contact/complete");
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

    public function isShowCompletePage() {
        return view("contactComplete")->with("userType",$this->userType);
    }

    private function validation($request) {
        $rules = array(
            'name' => 'required|max:255',
            'address' => 'required|email|max:255',
            'contact' => 'required|max:65535'
        );
        $validator = Validator::make($request,$rules);
        return $validator;
    }
}
