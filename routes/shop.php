<?php

use App\Http\Controllers\Business as Controllers;
use Illuminate\Support\Facades\{Route, Auth};

// BUSINESS DOMAIN

// routes that dont need user authentication
Route::get('/', function () {
	if (Auth::check()) {
		return redirect()->route('business.dashboard.index');
	}
	return redirect()->route('auth.business.login');
});

// routes that require user authentication
Route::middleware(['auth.business', '2fa',/* 'verified.business', *//* 'password.confirm' */])->group(
	function () {
	    // account security group
    	Route::group(
	    	['as' => 'account-settings.'],
	    	function () {
		        Route::patch(
		        	'account-settings/store/2fa',
		        	[Controllers\AccountSecurityController::class, 'store2FA']
		        )->name('2fa');
		        Route::get(
		        	'account-settings/verify/pass',
		        	[Controllers\AccountSecurityController::class, 'verifyPass']
		        )->name('verify.pass');
		        Route::patch(
		        	'account-settings/email/store',
		        	[Controllers\AccountSecurityController::class, 'storeNewEmail']
		        )->name('email.store');
		        Route::patch(
		        	'account-settings/email/password',
		        	[Controllers\AccountSecurityController::class, 'storeNewPassword']
		        )->name('password.store');
	        }
	    );

	    // products group
    	Route::group(
	    	['as' => 'products.'],
	    	function () {
		        Route::get(
		        	'products/fill',
		        	[Controllers\ProductsController::class, 'fill']
		        )->name('fill');
		        Route::post(
		        	'products/preview',
		        	[Controllers\ProductsController::class, 'preview']
		        )->name('preview');
		        Route::post(
		        	'products/search',
		        	[Controllers\ProductsController::class, 'advanceSearch']
		        )->name('search');
	        }
	    );

	    // appointments group
    	Route::group(
	    	['as' => 'appointments.'],
	    	function () {
		        Route::patch(
		        	'appointments/{id}/status/{status}',
		        	[Controllers\AppointmentsController::class, 'setAppointmentStatus']
		        )->name('status');
		        Route::patch(
		        	'appointments/{id}/repair/{status}',
		        	[Controllers\AppointmentsController::class, 'setRepairStatus']
		        )->name('repair');
		        Route::post(
		        	'appointments/search',
		        	[Controllers\AppointmentsController::class, 'advanceSearch']
		        )->name('search');
		        Route::get(
		        	'appointments/fetch/{id}',
		        	[Controllers\AppointmentsController::class, 'fetchAppointment']
		        )->name('fetch');
		        Route::post(
		        	'appointments/reviews/filter',
		        	[Controllers\AppointmentReviewsController::class, 'filter']
		        )->name('reviews.filter');
	        }
	    );

	    // reviews group
    	Route::group(
	    	['as' => 'reviews.'],
	    	function () {
		        Route::post(
		        	'reviews/filter',
		        	[Controllers\AppointmentReviewsController::class, 'filter']
		        )->name('filter');
		        Route::post(
		        	'reviews/favorite',
		        	[Controllers\AppointmentReviewsController::class, 'toggleFavorite']
		        )->name('favorite');
	        }
	    );

	    // orders group
    	Route::group(
	    	['as' => 'orders.'],
	    	function () {
		        Route::get(
		        	'orders/history',
		        	[Controllers\OrdersController::class, 'history']
		        )->name('history');
		        Route::patch(
		        	'orders/status/update',
		        	[Controllers\OrdersController::class, 'updateStatus']
		        )->name('status.update');
		        Route::post(
		        	'orders/search',
		        	[Controllers\OrdersController::class, 'advanceSearch']
		        )->name('search');
	        }
	    );

	    // product reviews group
    	Route::group(
	    	['as' => 'products.reviews.'],
	    	function () {
		        Route::post(
		        	'products/{product}/reviews/filter',
		        	[Controllers\ProductReviewsContoller::class, 'filter']
		        )->name('filter');
	        }
	    );

	    // users list group
    	Route::group(
	    	['as' => 'users.'],
	    	function () {
		        Route::post(
		        	'users/search',
		        	[Controllers\UsersController::class, 'advanceSearch']
		        )->name('search');
		        Route::get(
		        	'users/ban/reason',
		        	[Controllers\UsersController::class, 'getBanReason']
		        )->name('ban.reason');
		        Route::post(
		        	'users/unban',
		        	[Controllers\UsersController::class, 'unbanUser']
		        )->name('unban');
	        }
	    );

	    // reports group
    	Route::group(
	    	['as' => 'reports.'],
	    	function () {
		        Route::get(
		        	'reports/{type}/{id}/invoice',
		        	[Controllers\ReportsController::class, 'showInvoice']
		        )->name('invoice.show');

		        Route::post(
		        	'reports/search',
		        	[Controllers\ReportsController::class, 'searchInvoice']
		        )->name('search');
	        }
	    );

	    // shop-settings group
    	Route::group(
	    	['as' => 'site-settings.'],
	    	function () {
		        //shop-settings
        		Route::patch(
		        	'site-settings/form1',
		        	[Controllers\SiteSettingsController::class, 'form1']
		        )->name('form1');
		        Route::patch(
		        	'site-settings/form2',
		        	[Controllers\SiteSettingsController::class, 'form2']
		        )->name('form2');
		        Route::patch(
		        	'site-settings/form3',
		        	[Controllers\SiteSettingsController::class, 'form3']
		        )->name('form3');
		        Route::patch(
		        	'site-settings/form4',
		        	[Controllers\SiteSettingsController::class, 'form4']
		        )->name('form4');
		        Route::patch(
		        	'site-settings/form5',
		        	[Controllers\SiteSettingsController::class, 'form5']
		        )->name('form5');
		        Route::patch(
		        	'site-settings/form6',
		        	[Controllers\SiteSettingsController::class, 'form6']
		        )->name('form6');
		        Route::patch(
		        	'site-settings/form7',
		        	[Controllers\SiteSettingsController::class, 'form7']
		        )->name('form7');
		        Route::patch(
		        	'site-settings/form8',
		        	[Controllers\SiteSettingsController::class, 'form8']
		        )->name('form8');
		        Route::patch(
		        	'site-settings/form9',
		        	[Controllers\SiteSettingsController::class, 'form9']
		        )->name('form9');
		        Route::patch(
		        	'site-settings/form10',
		        	[Controllers\SiteSettingsController::class, 'form10']
		        )->name('form10');
		        Route::post(
		        	'site-settings/validate/shopTag',
		        	[Controllers\SiteSettingsController::class, 'shopTagIsValid']
		        )->name('shopTag.isValid');
		        Route::get(
		        	'site-settings/load/shopTag',
		        	[Controllers\SiteSettingsController::class, 'loadShopTags']
		        )->name('shopTag.load');

		        //site-settings
        		Route::get(
		        	'site-settings/info',
		        	[Controllers\SiteSettingsController::class, 'info']
		        )->name('info');
		        Route::get(
		        	'site-settings/faqs',
		        	[Controllers\SiteSettingsController::class, 'faqs']
		        )->name('faqs');
		        Route::get(
		        	'site-settings/gallery',
		        	[Controllers\SiteSettingsController::class, 'gallery']
		        )->name('gallery');
		        Route::get(
		        	'site-settings/addNewGallery',
		        	[Controllers\SiteSettingsController::class, 'add_new_gallery_card']
		        )->name('gallery.create');
		        Route::patch(
		        	'site-settings/theme',
		        	[Controllers\SiteSettingsController::class, 'themeColor']
		        )->name('theme');
		        Route::get(
		        	'site-settings/system-images',
		        	[Controllers\SiteSettingsController::class, 'system_images']
		        )->name('system-images');
		        Route::patch(
		        	'site-settings/system-images/store',
		        	[Controllers\SiteSettingsController::class, 'storeSiteAssets']
		        )->name('system-images.store');
	        }
	    );
	    // resources group
    	Route::resources([
	    	'dashboard' => Controllers\DashboardController::class,
	    	'products' => Controllers\ProductsController::class,
	    	'products.reviews' => Controllers\ProductReviewsContoller::class,
	    	'chat' => Controllers\MessagesController::class,
	    	'appointments' => Controllers\AppointmentsController::class,
	    	'appointments.billing' => Controllers\BillingController::class,
	    	'orders' => Controllers\OrdersController::class,
	    	// 'shop-settings' => Controllers\ShopSettingsController::class,
    		'site-settings' => Controllers\SiteSettingsController::class,
	    	'account-settings' => Controllers\AccountSecurityController::class,
	    	'reports' => Controllers\ReportsController::class,
	    	'invoice' => Controllers\InvoiceController::class,
	    	'users' => Controllers\UsersController::class,
	    	'reviews' => Controllers\AppointmentReviewsController::class,
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
    }
);
