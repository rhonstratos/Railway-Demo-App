<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
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
			'repair_remarks' => ['required', 'string', 'max:600'],
			'repair_cost' => ['required', 'integer'],

			'items' => ['array', 'min:1'],
			'items.*' => ['required', 'string'],

			'quantity' => ['array', 'min:1'],
			'quantity.*' => ['required', 'integer'],

			'price' => ['array', 'min:1'],
			'price.*' => ['required', 'integer'],
		];
	}
}
