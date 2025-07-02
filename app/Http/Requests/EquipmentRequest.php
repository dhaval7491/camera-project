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
        $equipmentId = $this->route('equipment');
        return [
            'type' => 'required|string|in:camera,tablet',
            'equipment_name' => 'required|string',
            'equipment_code' => [
                'required',
                'string',
                Rule::unique('equipments', 'equipment_code')->ignore($equipmentId),
            ],
            'password' => $this->isMethod('post') ? 'required|string' : 'nullable|string',
        ];
    }
}
