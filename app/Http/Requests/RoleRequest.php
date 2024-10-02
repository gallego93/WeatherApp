<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        $roleId = $this->route('role');

        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('roles', 'name')->ignore($roleId)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre no debe estar vacio.',
            'name.unique' => 'El nombre ya se encuentra registrado',
            'name.max' => 'El nombre no debe contener más de 255 caracteres',
        ];
    }
}
