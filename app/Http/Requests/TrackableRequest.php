<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackableRequest extends FormRequest
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
            'trackable_name' => ['required', 'string', 'max:255'],
            'other_name' => ['required', 'string', 'max:255'],
            'linked_objects' => [
            'required',
            'array',
            function ($attribute, $value, $fail) {
                // Filter out empty values
                $nonEmptyValues = array_filter($value, function($item) {
                    return !empty(trim($item));
                });
                
                // Check if at least one non-empty value exists
                if (empty($nonEmptyValues)) {
                    $fail('At least one linked object is required.');
                }
            },
        ],
            'project_id' => ['nullable', 'exists:projects,id'],
            'linked_objects.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
