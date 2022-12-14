<?php

// ADMIN DOMAIN
Route::middleware(['guest'])->group(function () {
    Route::get('/', fn () => 'welcome to admin domain');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => 'welcome to admin domain');
});
