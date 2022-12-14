<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;

class Form9 extends FormRequest
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
			'faq' => ['required', 'array', 'min:5', 'max:5'],
			'faq.*' => ['required', 'array', 'min:2', 'max:2'],

			'faq.*.header' => ['required', 'string', 'max:70'],
			'faq.*.body' => ['required', 'string'],
		];
	}
}
