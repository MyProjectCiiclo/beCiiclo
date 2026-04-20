<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CloudinaryService
{
    public function upload($file)
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        $response = Http::timeout(30)->attach(
            'file',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
            'upload_preset' => 'my_preset'
        ]);

        if (!$response->successful()) {
            throw new \Exception('Upload failed: ' . $response->body());
        }

        $result = $response->json();

        return $result['secure_url'] ?? null;
    }
}