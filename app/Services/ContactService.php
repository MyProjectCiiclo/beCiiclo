<?php

namespace App\Services;

use App\Repository\ContactRepository;

class ContactService
{
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAllContact()
    {
        return [
            'data' => $this->contactRepository->getAllContact(),
            'totalContacts' => $this->contactRepository->count(),
        ];
    }
    public function sendMessage($data)
    {
        return $this->contactRepository->sendMessage($data);
    }
    public function deleteContact($id)
    {
        return $this->contactRepository->delete($id);
    }
}
