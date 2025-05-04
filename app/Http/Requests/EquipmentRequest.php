<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EquipmentRequest extends FormRequest
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
        $type = $this->input('type');

        return [
            'type' => 'required|string|in:camera,tablet',

            'password' => 'required',

            // Required if type is camera
            'camera_name' => [
                Rule::requiredIf($type === 'camera'),
                'string',
                'nullable', // still allows null if not required
            ],
            'stream_link' => [
                Rule::requiredIf($type === 'camera'),
                'url',
                'nullable',
            ],
            'camera_code' => [
                Rule::requiredIf($type === 'camera'),
                'string',
                'nullable',
            ],

            // Required if type is tablet
            'map_tablet' => [
                Rule::requiredIf($type === 'tablet'),
                'string',
                'nullable',
            ],
        ];
    }
}
