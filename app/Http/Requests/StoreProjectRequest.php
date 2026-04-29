<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_name' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'project_type' => 'required|string|max:255',
        ];
    }
}
