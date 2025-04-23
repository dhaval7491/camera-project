<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        $userId = $this->route('user'); // Assuming route like /users/{user}
        
        if ($userId instanceof \App\Models\User) {
            $userId = $userId->id; // Extract ID
        }    

        return [
            'user_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $userId,
            'company_id'    => 'required|exists:companies,id',
            'project_id'    => 'nullable|exists:projects,id',
            'location'      => 'required|string|max:255',
            'access_level'  => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
