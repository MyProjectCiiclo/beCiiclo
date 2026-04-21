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

        try {
            $response = Http::timeout(30)->attach(
                'file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
                'upload_preset' => 'my_preset'
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