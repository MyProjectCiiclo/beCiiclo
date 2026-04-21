<?php
namespace App\Services;

use App\Repository\IntroRepository;


class IntroService{
    protected $introRepository;

    public function __construct(IntroRepository $introRepository)
    {
        $this->introRepository = $introRepository;
    }

    public function getIntros(){
      return $this->introRepository->getIntros();

    }
}