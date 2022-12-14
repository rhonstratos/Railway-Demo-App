<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;

class Form8 extends FormRequest
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
			'gcash_name' => ['nullable', 'string'],
			'gcash_num' => ['bail', 'required_with:gcash_acc_name,gcash_img', 'nullable', 'string'],
			'gcash_img' => ['bail', 'required_with:gcash_acc_name,gcash_acc_num', 'nullable', 'image', 'max:20480'],

			'paymaya_name' => ['nullable', 'string'],
			'paymaya_num' => ['bail', 'required_with:paymaya_name,paymaya_img', 'nullable', 'string'],
			'paymaya_img' => ['bail', 'required_with:paymaya_name,paymaya_num', 'nullable', 'image', 'max:20480'],
		];
	}
}
