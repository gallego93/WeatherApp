<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherRequest extends FormRequest
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
            'city' => 'string|required',
            'temperature' => 'required',
            'weather' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'city.required' => 'Aún no se ha cargado una ciudad.',
            'city.string' => 'El campo ciudad debe ser una cadena de texto.',
            'temperature' => 'Aún no se ha cargado la temperatura.',
            'weather' => 'Aún no se ha cargado el estado del clima.'
        ];
    }
}
