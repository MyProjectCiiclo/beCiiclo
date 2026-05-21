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

        if (!$cloudName || !$uploadPreset) {
            throw new \Exception('Cloudinary config missing');
        }

        if (!$file || !$file->isValid()) {
            throw new \Exception('Invalid file upload');
        }

        if (!file_exists($file->getRealPath())) {
            throw new \Exception('File not found');
        }

        $extension = strtolower($file->getClientOriginalExtension());

        $isPdf = $extension === 'pdf';

        $url = $isPdf
            ? "https://api.cloudinary.com/v1_1/{$cloudName}/raw/upload"
            : "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";

        try {
            $response = Http::timeout(30)
                ->attach(
                    'file',
                    fopen($file->getRealPath(), 'r'),
                    $file->getClientOriginalName()
                )
                ->post($url, [
                    'upload_preset' => $uploadPreset,
                ]);

            Log::info('Cloudinary response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if (!$response->successful()) {
                throw new \Exception($response->body());
            }

            $result = $response->json();

            if (!isset($result['secure_url'])) {
                throw new \Exception('Missing secure_url');
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
