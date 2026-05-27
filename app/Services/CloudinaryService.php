<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    public function upload($file)
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $uploadPreset = env('CLOUDINARY_UPLOAD_PRESET');

        $extension = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));

        $resourceType = $extension === 'pdf' ? 'raw' : 'image';

        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/{$resourceType}/upload";

        $response = Http::attach(
            'file',
            fopen($file->getRealPath(), 'r'),
            $file->getClientOriginalName()
        )->post($url, [
            'upload_preset' => $uploadPreset,
        ]);

        return $response->json()['secure_url'];
    }
}
