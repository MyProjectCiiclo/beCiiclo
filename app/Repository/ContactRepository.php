<?php

namespace App\Repository;

use App\Models\ContactModel;

class ContactRepository
{
    protected $contactModel;

    public function __construct(ContactModel $contactModel)
    {
        $this->contactModel = $contactModel;
    }

    public function sendMessage($data)
    {
        return $this->contactModel->create($data);
    }
}