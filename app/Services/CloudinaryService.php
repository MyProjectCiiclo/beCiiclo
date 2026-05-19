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

        if (!$cloudName) {
            throw new \Exception('Cloudinary cloud name is missing');
        }

        if (!$uploadPreset) {
            throw new \Exception('Cloudinary upload preset is missing');
        }

        if (!$file || !$file->isValid()) {
            throw new \Exception('Invalid file upload');
        }

        if (!file_exists($file->getRealPath())) {
            throw new \Exception('File not found on server');
        }

        try {
            $response = Http::timeout(30)
                ->attach(
                    'file',
                    fopen($file->getRealPath(), 'r'),
                    $file->getClientOriginalName()
                )
                ->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
                    'upload_preset' => $uploadPreset
                ]);

            Log::info('Cloudinary response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if (!$response->successful()) {
                throw new \Exception('Upload failed: ' . $response->body());
            }

            $result = $response->json();

            if (!isset($result['secure_url'])) {
                throw new \Exception('Cloudinary response missing secure_url');
            }

            return $result['secure_url'];
        } catch (\Exception $e) {
            Log::error('Cloudinary upload error', [
                'message' => $e->getMessage()
            ]);

            throw $e;
        }
    }
}
