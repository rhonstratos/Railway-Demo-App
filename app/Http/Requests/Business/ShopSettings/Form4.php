<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Form4 extends FormRequest
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
			'time_opening' => ['required',],
			'time_closing' => ['required',],
			'time_interval' => ['required',],
			'operating_days' => ['required', 'array', 'min:1', 'max:7',],
			'operating_days.*' => ['required', Rule::in(
				array_keys(config('enums.week_days'))
			)],
		];
	}
}
