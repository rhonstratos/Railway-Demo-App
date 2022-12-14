<?php

namespace App\Actions\Customer\Products;

use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreReview
{
	public function execute(Request $request, Products $product)
	{
		$files = [];
		if (!is_null($request->file('files'))) {
			foreach ($request->file('files') as $file) {
				$destinationPath = 'public/reviews';
				array_push($files, pathinfo($file->store($destinationPath))['basename']);
			}
		}

		return Reviews::create([
			'user_id' => Auth::id(),
			'product_id' => $product->id,
			'message' => $request->review_message,
			'ratings' => $request->rating,
			'attachments' => empty($files) ? null : $files
		]);
	}
}
