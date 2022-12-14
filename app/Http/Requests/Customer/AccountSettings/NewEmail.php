<?php

namespace App\Http\Requests\Customer\AccountSettings;

use Illuminate\Foundation\Http\FormRequest;

class NewEmail extends FormRequest
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
			'new_email' => ['required', 'string', 'email'],
		];
	}
}
