<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{

    protected $contactService;
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $data = $this->contactService->getAllContact();

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }
    public function store(StoreContactRequest $request)
    {
        $contact = $this->contactService->sendMessage(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $contact
        ]);
    }
}
