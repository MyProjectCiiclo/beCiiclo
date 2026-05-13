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

    public function getAllContact()
    {
        return ContactModel::orderBy('created_at', 'desc')->get();
    }

    public function count()
    {
        return ContactModel::count();
    }

    public function sendMessage($data)
    {
        return $this->contactModel->create($data);
    }
}
