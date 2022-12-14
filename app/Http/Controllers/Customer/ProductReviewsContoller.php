<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Business\ProductReviews\FilterReviews;
use App\Http\Controllers\ReviewsController as Controller;
use App\Models\Products;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductReviewsContoller extends Controller
{
	use AuthData;
}
