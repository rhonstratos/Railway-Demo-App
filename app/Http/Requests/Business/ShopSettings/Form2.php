<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;

class Form2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'street' => ['required','string'],
            'province' => ['required','string'],
            'city' => ['required','string'],
            'brgy' => ['required','string'],
            'zip' => ['nullable','string'],
            'googleMaps' => ['nullable','string'],
            'googleMaps_embed' => ['required','string'],
        ];
    }
}
