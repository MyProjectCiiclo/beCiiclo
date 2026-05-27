<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CloudinaryService
{
    public function upload($file)
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $uploadPreset = env('CLOUDINARY_UPLOAD_PRESET');

        $resourceType = 'auto';

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