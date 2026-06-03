<?php

namespace App\Repository;

use App\Models\IntroModel;

class IntroRepository
{
    protected $introModel;

    public function __construct(IntroModel $introModel)
    {
        $this->introModel = $introModel;
    }

    public function getIntros()
    {
        return $this->introModel->all();
    }
}
