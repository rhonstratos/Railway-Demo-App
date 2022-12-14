<?php

namespace App\Http\Requests\AccountSecurity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class NewPassword extends FormRequest
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
			'current_password' => ['required', 'string'],
			'new_password' => [
				'required', 'confirmed',
				Rules\Password::min(8)
					->letters()
					->mixedCase()
					->numbers()
					->symbols()
					->uncompromised(3)
			],
		];
	}
}
