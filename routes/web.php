<?php

use App\Http\Controllers\BannedUsersController;
use App\Http\Controllers\Google2FA\OneTimePasswordController;
use App\Http\Controllers\PDF\GenerateReportController;
use App\Http\Controllers\QRCode\Google2FAController;
use App\Http\Controllers\RectifyPWAController;
use App\Http\Controllers\TestController;
use App\Models\Billing;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// MAIN DOMAIN
Route::post('/2fa', fn() => redirect(URL()->previous()))->name('g.2fa')->middleware('2fa');
Route::resource('gf2', Google2FAController::class)->only(['create']);
Route::get(
	'storage/{id}/file/{filename}/type/{type}',
	function ($id, $filename, $type) {
	    if ($type == 'appointments') {
		    $path = storage_path("app/appointments/{$id}/{$filename}");
	    }
	    if ($type == 'products') {
		    $path = storage_path("app/products/{$id}/{$filename}");
	    }
	    if ($type == 'shop') {
		    $path = storage_path("app/shop/{$id}/{$filename}");
	    }
	    // dd($path);
    	if (!File::exists($path)) {
		    abort(404);
	    }

	    $file = File::get($path);
	    $type = File::mimeType($path);
	    $response = Response::make($file, 200);

	    return $response->header("Content-Type", $type);
    }
)->name('storage.get');

// routes that dont need user authentication
Route::middleware(['guest'])->group(function () {
	Route::get('/view/pdf', fn() => view('pdf.inventory.product-report'));
	Route::get('/', fn() => redirect()->to('https://www.' . config('app.url')));
	Route::controller(GenerateReportController::class)->group(
		function () {
		    Route::get('/test/pdf', 'createProductInventoryReport');
	    }
	);
});

// routes that need user authentication
Route::middleware(['auth'])->group(function () {
	Route::get('you/are/banned', [BannedUsersController::class, 'index'])->name('restrict.banned.users');
});

// user authentication
require __DIR__ . '/auth.php';

// Route::get('/test/manifest', [RectifyPWAController::class, 'manifestJson']);
