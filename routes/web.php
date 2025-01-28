<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProviderTypeController;
use App\Http\Controllers\Admin\VerificationModeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EvidenceTypeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
//Clear Cache facade value:
Route::get('/cache-clear', function() {
    Artisan::call('optimize:clear');
    return '<h1>All Cache cleared</h1>';
});

Route::redirect('/', 'login');
Route::redirect('/home', 'admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth','preventBackHistory']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::put('categories-update-status', [CategoryController::class, 'changeStatus'])->name('categories.updateStatus');
    Route::resource('categories', CategoryController::class);

    Route::put('provider-types-update-status', [ProviderTypeController::class, 'changeStatus'])->name('provider-types.updateStatus');
    Route::resource('provider-types', ProviderTypeController::class);
    
    Route::put('verification-modes-change-status', [VerificationModeController::class, 'changeStatus'])->name('verification-modes.changeStatus');
    Route::resource('verification-modes', VerificationModeController::class);

    Route::put('countries-change-status', [CountryController::class, 'changeStatus'])->name('countries.changeStatus');
    Route::resource('countries', CountryController::class);

    Route::put('evidence-types-change-status', [EvidenceTypeController::class, 'changeStatus'])->name('evidence-types.changeStatus');
    Route::resource('evidence-types', EvidenceTypeController::class);

    Route::put('sub-categories-update-status', [SubCategoryController::class, 'changeStatus'])->name('sub-categories.updateStatus');
    Route::resource('sub-categories', SubCategoryController::class);

    Route::get('update-profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('update-profile/{id}', [ProfileController::class, 'updateProfile'])->name('update_profile');

    Route::get('change-password', [ProfileController::class, 'showChangePasswordForm'])->name('changePasswordForm');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
});
