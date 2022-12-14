<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
			'firstName' => ['required', 'string'],
			'lastName' => ['required', 'string'],
			'contact' => ['required', 'string', 'numeric'],
			'alt_contact' => ['nullable', 'string', 'numeric'],
			'email' => ['required', 'string', 'email'],
			'category' => ['nullable', 'string'],
			'product_brand' => ['required', 'string'],
			'model_name' => ['required', 'string'],
			'model_num' => ['nullable', 'string'],
			'date' => ['required', 'string', 'date'],
			'time' => ['required', 'string'],
			'concern' => ['required', 'string'],
			'files' => ['array', 'required', 'min:1', 'max:8'],
			'files.*' => ['required', 'mimes:jpeg,gif,png', 'max:20480'],
		];
	}
}
