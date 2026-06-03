<?php

namespace App\Services;

use App\Repository\EducationRepository;

class EducationService
{
    protected $educationRepository;

    public function __construct(EducationRepository $educationRepository)
    {
        $this->educationRepository = $educationRepository;
    }

    public function getAll()
    {
        return $this->educationRepository->getAll();
    }

    public function create($data)
    {
        return $this->educationRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->educationRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->educationRepository->delete($id);
    }
}
