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

        $existing = $this->skillRepository->findByName($data['name']);

        if ($existing) {
            $data['weight'] = $existing->weight + 1;
        } else {
            $data['weight'] = 1;
        }

        $data['color'] = $this->randomColor();

        return $this->skillRepository->create($data);
    }
    public function update($id, array $data)
    {
        $skill = $this->skillRepository->find($id);

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->cloudinaryService->upload($data['image']);
        }

        $data['color'] = $skill->color;

        return $this->skillRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->skillRepository->delete($id);
    }

    private function randomColor(): string
    {
        $hue = rand(0, 360);

        return "hsl($hue, 70%, 60%)";
    }
}
