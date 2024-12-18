<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'password' => ['required, confirmed',
            //                     Rules\Password::min(6)
            //                     ->letters()
            //                     ->mixedCase()
            //                     ->numbers()
            //                     ->symbols()
            //                     ->uncompromised()
            //                 ],
        ];
    }
}
