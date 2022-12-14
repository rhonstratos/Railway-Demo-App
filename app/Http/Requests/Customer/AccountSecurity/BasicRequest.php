<?php

namespace App\Http\Requests\Customer\AccountSecurity;

use Illuminate\Foundation\Http\FormRequest;

class BasicRequest extends FormRequest
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
			'user_img' => ['nullable','image', 'max:20480'],
			'first_name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'contact' => ['required', 'digits:11'],
			'birthday' => ['required', 'date'],
			'address' => ['nullable', 'string'],
			'action' => ['required', 'string'],
		];
	}
}
