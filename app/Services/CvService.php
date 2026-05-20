<?php

namespace App\Services;

use App\Repository\CvRepository;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Auth;

class CvService
{
    protected $cvRepository;
    protected $cloudinaryService;

    public function __construct(
        CvRepository $cvRepository,
        CloudinaryService $cloudinaryService
    ) {
        $this->cvRepository = $cvRepository;
        $this->cloudinaryService = $cloudinaryService;
    }

    public function getAllCv()
    {
        return $this->cvRepository->getAllCv();
    }

    public function uploadCv($file)
    {
        $url = $this->cloudinaryService->upload($file);

        $userId = Auth::id();

        if (!$userId) {
            throw new \Exception('Unauthenticated user');
        }

        return $this->cvRepository->create([
            'cv' => $url,
            'user_id' => $userId,
        ]);
    }

    public function updateCv($id, $file)
    {
        $url = $this->cloudinaryService->upload($file);

        return $this->cvRepository->updateCv($id, [
            'cv' => $url,
        ]);
    }

    public function deleteCv($id)
    {
        return $this->cvRepository->deleteCv($id);
    }
}