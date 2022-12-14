<?php

use App\Http\Controllers\Auth as BaseAuth;
use App\Http\Controllers\Auth\Business as BusinessAuth;
use App\Http\Controllers\Auth\Customer as CustomerAuth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
	Route::group(
		[
			'domain' => 'shop.' . config('app.url'),
			'as' => 'auth.business.',
		],
		function () {
		    Route::controller(BusinessAuth\EmailVerificationController::class)->group(
		    	function () {
			            Route::get('verify-email', '__invoke')->name('verification.notice');
		            }
		    );
		    Route::controller(BusinessAuth\VerifyEmailController::class)->group(
		    	function () {
			            Route::get('verify-email/{id}/{hash}', '__invoke')
			            	->middleware(['signed', 'throttle:6,1'])
			            	->name('verification.verify');
		            }
		    );
		    Route::controller(BusinessAuth\NotifyEmailVerification::class)->group(
		    	function () {
			            Route::post('email/verification-notification', 'store')
			            	->middleware('throttle:6,1')
			            	->name('verification.send');
		            }
		    );

		    // Route::controller(BusinessAuth\ConfirmPasswordController::class)->group(function () {
    		//     Route::get('confirm-password', 'show')->name('password.confirm');
    		//     Route::post('confirm-password', 'store');
    		// });
    	}
	);
	Route::group(
		[
			'domain' => 'www.' . config('app.url'),
			// 'as' => 'auth.customer.',

		],
		function () {
		    Route::controller(CustomerAuth\EmailVerificationController::class)->group(
		    	function () {
			            Route::get('verify-email', '__invoke')->name('verification.notice');
		            }
		    );
		    // Route::controller(BusinessAuth\VerifyEmailController::class)->group(function () {
    		//     Route::get('verify-email/{id}/{hash}', '__invoke')
    		//         ->middleware(['signed', 'throttle:6,1'])
    		//         ->name('verification.verify');
    		// });
    		Route::controller(CustomerAuth\NotifyEmailVerification::class)->group(
		    	function () {
			        Route::post('email/verification-notification', 'store')
			        	->middleware('throttle:6,1')
			        	->name('verification.send');
		        }
		    );

		    // Route::controller(BusinessAuth\ConfirmPasswordController::class)->group(function () {
    		//     Route::get('confirm-password', 'show')->name('password.confirm');
    		//     Route::post('confirm-password', 'store');
    		// });
    	}
	);

	// Route::controller(Auth\EmailVerificationPromptController::class)->group(function () {
	//     Route::get('verify-email', '__invoke')->name('verification.notice');
	// });
	Route::controller(BaseAuth\VerifyEmailController::class)->group(
		function () {
		    Route::get('verify-email/{id}/{hash}', '__invoke')
		    	->middleware(['signed', 'throttle:6,1'])
		    	->name('verification.verify');
	    }
	);

	// Route::controller(Auth\EmailVerificationNotificationController::class)->group(function () {
	//     Route::post('email/verification-notification', 'store')
	//         ->middleware('throttle:6,1')
	//         ->name('verification.send');
	// });

	Route::controller(BaseAuth\ConfirmablePasswordController::class)->group(
		function () {
		    Route::get('confirm-password', 'show')->name('password.confirm');
		    Route::post('confirm-password', 'store');
	    }
	);

	Route::controller(BaseAuth\AuthenticatedSessionController::class)->group(
		function () {
		    Route::post('logout', 'destroy')->name('logout');
	    }
	);
});

Route::middleware('guest')->group(function () {
	Route::group(
		[
			'domain' => 'shop.' . config('app.url'),
			'as' => 'auth.business.',
		],
		function () {
		    Route::controller(BusinessAuth\LoginController::class)->group(
		    	function () {
			            Route::get('login', 'create')->name('login');
			            Route::post('login', 'store');
		            }
		    );
		    // Route::controller(BusinessAuth\RegistrationController::class)->group(
		    // 	function () {
			//             Route::get('register', 'create')->name('register');
			//             Route::post('register', 'store');
		    //         }
		    // );

		    // Route::controller(BusinessAuth\RegistrationController::class)->group(function () {
    		//     Route::get('register', 'create')->name('register');
    		//     Route::post('register', 'store');
    		// });
    		Route::controller(BusinessAuth\PasswordResetController::class)->group(
		    	function () {
			        Route::get('forgot-password', 'create')->name('password.request');
			        Route::post('forgot-password', 'store')->name('password.email');
		        }
		    );
		    Route::controller(BusinessAuth\NewPasswordController::class)->group(
		    	function () {
			            Route::get('reset-password/{token}', 'create')->name('password.reset');
			            Route::post('reset-password', 'store')->name('password.update');
		            }
		    );
	    }
	);

	Route::group(
		[
			'domain' => 'www.' . config('app.url'),
			'as' => 'auth.customer.',
		],
		function () {
		    Route::controller(CustomerAuth\LoginController::class)->group(
		    	function () {
			            Route::get('login', 'create')->name('login');
			            Route::post('login', 'store');
		            }
		    );

		    Route::controller(CustomerAuth\RegistrationController::class)->group(
		    	function () {
			            Route::get('register', 'create')->name('register');
			            Route::post('register', 'store');
		            }
		    );
		    Route::controller(CustomerAuth\PasswordResetController::class)->group(
		    	function () {
			            Route::get('forgot-password', 'create')->name('password.request');
			            Route::post('forgot-password', 'store')->name('password.email');
		            }
		    );
		    Route::controller(CustomerAuth\NewPasswordController::class)->group(
		    	function () {
			            Route::get('reset-password/{token}', 'create')->name('password.reset');
			            Route::post('reset-password', 'store')->name('password.update');
		            }
		    );
	    }
	);
});
