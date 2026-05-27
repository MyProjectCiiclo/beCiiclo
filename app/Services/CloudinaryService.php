<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    public function upload($file)
    {
        $cloudName = config('cloudinary.cloud_name');
        $uploadPreset = config('cloudinary.upload_preset');

        if (empty($cloudName) || empty($uploadPreset)) {
            Log::error('Cloudinary ENV missing', [
                'cloud_name' => $cloudName,
                'upload_preset' => $uploadPreset
            ]);

            throw new \Exception('Cloudinary config missing');
        }
        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/raw/upload";

        Log::info('Cloudinary Upload Start', [
            'url' => $url,
            'file_name' => $file->getClientOriginalName()
        ]);

        try {
            $response = Http::attach(
                'file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post($url, [
                'upload_preset' => $uploadPreset,
            ]);

            $data = $response->json();

            Log::info('Cloudinary Response', $data);

            if (!$response->successful() || !isset($data['secure_url'])) {
                Log::error('Cloudinary Upload Failed', $data);
                throw new \Exception('Upload failed: ' . json_encode($data));
            }

            return $data['secure_url'];
        } catch (\Exception $e) {
            Log::error('Cloudinary Exception', [
                'message' => $e->getMessage()
            ]);

            throw $e;
        }
    }
}
