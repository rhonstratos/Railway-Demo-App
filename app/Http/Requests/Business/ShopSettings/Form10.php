<?php

namespace App\Http\Requests\Business\ShopSettings;

use Illuminate\Foundation\Http\FormRequest;

class Form10 extends FormRequest
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
			'action' => ['required', 'string', 'in:save,delete'],

			'gallery_title' => ['required', 'array', 'min:1', 'max:5'],
			'gallery_title.*' => ['required', 'string', 'max:250'],

			'gallery_desc' => ['required', 'array', 'min:1', 'max:5'],
			'gallery_desc.*' => ['required', 'string', 'max:300'],

			'gallery_img' => ['nullable', 'array', 'min:1', 'max:5'],
			'gallery_img.*' => ['nullable', 'image', 'max:20480'],
		];
	}
}
