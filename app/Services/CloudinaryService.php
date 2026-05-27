<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CloudinaryService
{
    public function upload($file)
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $uploadPreset = env('CLOUDINARY_UPLOAD_PRESET');

        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/auto/upload";
        dd('NEW CODE HERE');
        $response = Http::attach(
            'file',
            fopen($file->getRealPath(), 'r'),
            $file->getClientOriginalName()
        )->post($url, [
            'upload_preset' => $uploadPreset,
        ]);

        $data = $response->json();

        if (!$response->successful() || !isset($data['secure_url'])) {
            throw new \Exception('Upload failed: ' . json_encode($data));
        }

        return $data['secure_url'];
    }
}
