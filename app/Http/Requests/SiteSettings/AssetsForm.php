<?php

namespace App\Http\Requests\SiteSettings;

use Illuminate\Foundation\Http\FormRequest;

class AssetsForm extends FormRequest
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
			'site_name' => ['required', 'string'],
			'site_logo' => ['required'],
			'icon' => ['required', 'array'],
			'icon.57x57' => ['required'],
			'icon.60x60' => ['required'],
			'icon.72x72' => ['required'],
			'icon.76x76' => ['required'],
			'icon.96x96' => ['required'],
			'icon.114x114' => ['required'],
			'icon.152x152' => ['required'],
			'icon.180x180' => ['required'],
			'icon.192x192' => ['required'],
			'icon.256x256' => ['required'],
			'icon.384x384' => ['required'],
			'icon.512x512' => ['required'],
			'splash' => ['required', 'array'],
			'splash.641x1136' => ['required'],
			'splash.750x1334' => ['required'],
			'splash.828x1792' => ['required'],
			'splash.1125x2436' => ['required'],
			'splash.1242x2608' => ['required'],
			'splash.1242x2688' => ['required'],
			'splash.1536x2048' => ['required'],
			'splash.1668x2224' => ['required'],
			'splash.1668x2388' => ['required'],
			'splash.2048x2732' => ['required'],
		];
	}
}
