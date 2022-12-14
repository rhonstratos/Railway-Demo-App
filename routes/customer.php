<?php

// CUSTOMER DOMAIN
// test

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Customer;

Route::get('/', [Customer\LandingPageController::class, 'guestIndex'])->name('guest.index');
Route::resource('products', Customer\ProductsController::class)->only(['index','show']);
// products group
Route::group(
	['as' => 'products.'],
	function () {
	    Route::post(
	    	'products/search',
	    	[Customer\ProductsController::class, 'searchProduct']
	    )->name('search');
	    Route::post(
	    	'products/search/advance',
	    	[Customer\ProductsController::class, 'advanceSearchProduct']
	    )->name('advance.search');
    }
);

Route::middleware(['auth.customer', '2fa' /* , 'verified.customer' */])->group(function () {

	// settings group
	Route::group(
		['as' => 'settings.'],
		function () {
		    Route::patch(
		    	'settings/form/store',
		    	[AccountSettingsController::class, 'formStore']
		    )->name('form.store');
		    Route::post(
		    	'settings/validate/password',
		    	[Customer\AccountSettingsController::class, 'validatePassword']
		    )->name('form.pass.validate');
		    Route::patch(
		    	'settings/email/store',
		    	[Customer\AccountSettingsController::class, 'storeNewEmail']
		    )->name('form.email.store');
		    Route::patch(
		    	'settings/password/store',
		    	[Customer\AccountSettingsController::class, 'storeNewPassword']
		    )->name('form.password.store');
		    Route::patch(
		    	'settings/2fa/store',
		    	[Customer\AccountSettingsController::class, 'storeNew2FA']
		    )->name('form.2fa.store');
	    }
	);

	// orders group
	Route::group(
		['as' => 'orders.'],
		function () {
		    Route::post(
		    	'orders/review/store',
		    	[Customer\ProductReviewsContoller::class, 'storeProductReview']
		    )->name('review.store');
	    }
	);

	// Billings group
	Route::group(
		['as' => 'billings.'],
		function () {
		    Route::post(
		    	'billings/export/invoice',
		    	[Customer\BillingController::class, 'print']
		    )->name('invoice.export');
	    }
	);

	// carts group
	Route::group(
		['as' => 'carts.'],
		function () {
		    Route::post(
		    	'carts/instant',
		    	[Customer\CartController::class, 'instantCheckout']
		    )->name('instant');

		    Route::patch(
		    	'carts/quantity',
		    	[Customer\CartController::class, 'quantityChange']
		    )->name('quantity');
	    }
	);

	// appointments group
	Route::group(
		['as' => 'appointments.'],
		function () {
		    Route::get(
		    	'appointments/filterBy/{filter}',
		    	[Customer\AppointmentsController::class, 'filter']
		    )->name('filter');
		    Route::get(
		    	'appointments/time',
		    	[Customer\AppointmentsController::class, 'getTimeSlots']
		    )->name('getTimeSlots');
		    Route::post(
		    	'appointments/review/store',
		    	[Customer\AppointmentReviewsController::class, 'storeAppointmentReview']
		    )->name('review.store');
		    Route::patch(
		    	'appointments/{appointment}/appointmentStatus/cancel',
		    	[Customer\AppointmentsController::class, 'cancelAppointment']
		    )->name('status.cancel');
	    }
	);

	Route::resource('products', Customer\ProductsController::class)->except(['index','show']);

	// resources group
	Route::resources([
		'home' => Customer\LandingPageController::class,
		'shop' => Customer\StoreProfileController::class,
		'cart' => Customer\CartController::class,
		'chats' => Customer\MessagesController::class,
		'checkout' => Customer\CheckoutController::class,
		'orders' => Customer\OrdersController::class,
		'settings' => Customer\AccountSettingsController::class,
		'appointments' => Customer\AppointmentsController::class,
		// 'products' => Customer\ProductsController::class,
		'favorites' => Customer\FavoritesController::class,
		'categories' => Customer\CategoriesController::class,
	], [
			// 'only' => [
			// 	'index',
			// 	'create',
			// 	'show',
			// 	'edit',
			// 	'delete',
			// 	'store'
			// ],
			// 'except' => [''],

		]);
});
