<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\VerificationModeController;
use App\Http\Controllers\ProviderTypeController;

// Resource routes for CRUD operations
Route::resource('countries', CountryController::class);

Route::get('countries/data', [CountryController::class, 'getData'])->name('countries.data');

Route::resource('categories', CategoryController::class);

Route::resource('subcategories', SubCategoryController::class);

Route::resource('verification-modes', VerificationModeController::class);

Route::resource('provider-types', ProviderTypeController::class);




