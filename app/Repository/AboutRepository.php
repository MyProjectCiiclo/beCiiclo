<?php

namespace App\Repository;

use App\Models\AboutModel;


class AboutRepository
{
    protected $aboutModel;

    public function __construct(AboutModel $aboutModel)
    {
        $this->aboutModel = $aboutModel;
    }

    public function getAbouts()
    {
        return $this->aboutModel->all();
    }
}
