<?php

namespace App\Services;

use App\Repository\ContactRepository;

class ContactService{
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;
    }

    public function sendMessage($data){
        return $this->contactRepository->sendMessage($data);
    }   
}
