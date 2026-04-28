<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    public function upload($file)
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        if (!$cloudName) {
            throw new \Exception('Cloudinary cloud name is missing');
        }

        if (!$file || !$file->isValid()) {
            throw new \Exception('Invalid file upload');
        }

        try {
            $response = Http::timeout(30)
                ->attach(
                    'file',
                    $file->getContent(),
                    $file->getClientOriginalName()
                )
                ->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
                    // ⚠️ QUAN TRỌNG: đổi đúng preset của bạn
                    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET', 'my_preset')
                ]);

            Log::info('Cloudinary response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if (!$response->successful()) {
                throw new \Exception('Upload failed: ' . $response->body());
            }

            $result = $response->json();

            return $result['secure_url'] ?? null;

        } catch (\Exception $e) {
            Log::error('Cloudinary upload error', [
                'message' => $e->getMessage()
            ]);

            throw $e;
        }
    }
}