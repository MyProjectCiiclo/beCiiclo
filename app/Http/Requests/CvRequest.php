<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CvRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            
        ];
    }

    public function messages(): array
    {
        return [
            'cv.required' => 'CV is required',
            'cv.file' => 'CV must be a file',
            'cv.mimes' => 'CV must be pdf, doc or docx',
            'cv.max' => 'CV size must not exceed 5MB',
        ];
    }
}