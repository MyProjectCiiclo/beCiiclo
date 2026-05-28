<?php

namespace App\Services;

use App\Repository\SkillRepository;

class SkillService
{
    protected $skillRepository;
    protected $cloudinaryService;

    public function __construct(
        SkillRepository $skillRepository,
        CloudinaryService $cloudinaryService
    ) {
        $this->skillRepository = $skillRepository;
        $this->cloudinaryService = $cloudinaryService;
    }
    public function getAll()
    {
        return $this->skillRepository->getAll();
    }
    public function create(array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->cloudinaryService->upload($data['image']);
        }

        return $this->skillRepository->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->cloudinaryService->upload($data['image']);
        }

        return $this->skillRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->skillRepository->delete($id);
    }
}   