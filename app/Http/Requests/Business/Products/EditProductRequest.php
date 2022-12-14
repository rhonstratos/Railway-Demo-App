<?php

namespace App\Http\Requests\Business\Products;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
			'category' => ['required', 'string'],
			'product_name' => ['required', 'string'],
			'img_showcase' => ['nullable', 'mimes:jpeg,gif,png', 'max:20480'],
			'product_img' => ['nullable', 'array', 'min:1', 'max:3'],
			'product_img.*' => ['nullable', 'mimes:jpeg,gif,png', 'max:20480'],
			'condition' => ['required', 'string'],
			'product_description' => ['required', 'string'],
			'price' => ['required', 'integer'],
			'quantity' => ['required', 'integer'],

			'spec_key' => ['required', 'array', 'min:1'],
			'spec_key.*' => ['required', 'string', 'distinct'],

			'spec_value' => ['required', 'array', 'min:1'],
			'spec_value.*' => ['required', 'string',],

			// 'transfer_method' => ['required', 'array', 'min:1'],
			// 'transfer_method.*' => ['required', 'string'],

			// 'payment_method' => ['required', 'array', 'min:1'],
			// 'payment_method.*' => ['required', 'string'],
		];
	}
}
