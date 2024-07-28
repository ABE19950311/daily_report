<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'sei' => 'required|string|max:255',
            'mei' => 'required|string|max:255',
            'category' => 'required',
            'content' => 'required|max:65535',
            'url' => 'max:65535',
            'image_path' => 'max:255'
        ];
    }
}
