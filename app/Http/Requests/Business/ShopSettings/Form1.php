<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;

class Form1 extends FormRequest
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
			'shop_name' => ['required', 'string'],
			'tagline' => ['required', 'string', 'max:250'],
			'shop_img' => ['nullable', 'mimes:jpeg,gif,png', 'max:20480'],
		];
	}
}
