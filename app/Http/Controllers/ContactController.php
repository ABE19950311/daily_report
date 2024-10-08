<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    private $contact;

    public function __construct(Request $request)
    {
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
    public function store(ContactRequest $request)
    {
        $requestBody = $this->extractContactRequestData($request);

        $response = $this->registerContact($requestBody);

        if ($response) {
            return redirect("/contact/complete");
        } else {
            return back()->withInput();
        }
    }

    private function extractContactRequestData($request)
    {
        return [
            "name" => $request->name,
            "address" => $request->address,
            "contact" => $request->contact,
            "user_id" => $this->userId
        ];
    }

    private function registerContact($requestBody)
    {
        return $this->contact->isRegisterContact($requestBody);
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

    public function isShowCompletePage()
    {
        return view("contactComplete")->with("userType", $this->userType);
    }
}
