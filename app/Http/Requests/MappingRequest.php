<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MappingRequest extends FormRequest
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
            'company_id' => ['required', 'exists:companies,id'],
            'project_id' => ['required', 'exists:projects,id'],
            'camera_id' => ['required', 'exists:equipments,id'],
            'tablet_id' => ['required', 'exists:equipments,id']
        ];
    }
}
