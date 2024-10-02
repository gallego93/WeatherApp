<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Routing\Route;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'user_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'password' => [
                'required',
                'min:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            //name
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            //user_name
            'user_name.required' => 'El nombre de usuario es obligatorio.',
            'user_name.unique' => 'El nombre de usuario ya se encuentra registrado.',
            'user_name.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'user_name.max' => 'El nombre de usuario no puede tener más de 255 caracteres.',
            //email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya se encuentra registrado.',
            'email.max' => 'El correo electrónico no puede contener menos de 255 caracteres.',
            //phone
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña no puede tener menos de 8 caracteres.',
        ];
    }
}
