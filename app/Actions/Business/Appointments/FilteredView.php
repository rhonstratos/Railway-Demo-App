<?php

namespace App\Actions\Business\Appointments;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Database\Eloquent\Builder;

class FilteredView
{
	public function execute(Request $request, Builder $review, View|ViewFactory $view): array
	{
		$review = isset($request->star_filter)
			? $review->where('ratings', $request->star_filter)
			: $review;

		$review = (isset($request->date_from) && isset($request->date_to))
			? $review->whereBetween('created_at', [
				Carbon::parse($request->date_from),
				Carbon::parse($request->date_to)
			])
			: $review;

		$view = isset($request->star_filter)
			? $view->with(['star_filter' => $request->star_filter])
			: $view;

		$view = (isset($request->date_from) && isset($request->date_to))
			? $view->with(['date_from' => $request->date_from, 'date_to' => $request->date_to])
			: $view;

		return [
			'review' => $review,
			'view' => $view,
		];
	}
}
