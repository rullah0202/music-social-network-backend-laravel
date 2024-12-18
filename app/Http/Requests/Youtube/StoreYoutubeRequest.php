<?php

namespace App\Http\Requests\Youtube;

use Illuminate\Foundation\Http\FormRequest;

class StoreYoutubeRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'url' => 'required|string',
        ];
    }
}
