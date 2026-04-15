<?php

namespace App\Services;

use App\Repository\AboutRepository;

class AboutService
{
    protected $aboutRepository;

    public function __construct(AboutRepository $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    public function getAbouts()
    {
        return $this->aboutRepository->getAbouts();
    }
}
