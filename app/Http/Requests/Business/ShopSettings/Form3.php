<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;

class Form3 extends FormRequest
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
			'shop_desc' => ['required', 'string', 'max:200'],

			'shop_aboutUs' => ['required', 'array', 'min:4'],
			'shop_aboutUs.*' => ['required', 'string'],

			'shop_contacts' => ['required', 'array'],
			'shop_contacts.*' => ['required', 'string'],
			'shop_contacts.email' => ['required', 'email'],

			'shop_socials' => ['required', 'array'],
			'shop_socials.*' => ['required', 'string', 'url'],
		];
	}
}
