<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;

class Form5 extends FormRequest
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
			'services' => ['nullable', 'array'],
			'services.*' => ['required', 'string', 'distinct'],
		];
	}
}
