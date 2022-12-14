<?php

namespace App\Http\Requests\SiteSettings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ThemeColor extends FormRequest
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
			'theme_color' => ['required', 'string', Rule::in(
				array_keys(config('cms.site_settings.theme_color'))
			)]
		];
	}
}
