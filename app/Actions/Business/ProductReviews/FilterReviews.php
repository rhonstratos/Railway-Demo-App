<?php

namespace App\Actions\Business\ProductReviews;

use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Database\Eloquent as Product;
use Illuminate\Support\Str;

class FilterReviews
{
	public function execute($request, $reviews)
	{
		if ($request->review_stars && is_numeric($request->review_stars) && Str::contains($request->review_stars,[1,2,3,4,5])) {
			$reviews = $reviews
				->where('ratings', $request->review_stars);
		}

		if ($request->review_date_start && $request->review_date_end) {
			$from = Carbon::parse($request->review_date_start)->toDate();
			$to = Carbon::parse($request->review_date_end)->toDate();
			$reviews = $reviews
				->whereBetween('created_at', [
					Carbon::parse($to),
					Carbon::parse($from),
				]);
		}

		return $reviews;
	}
}
