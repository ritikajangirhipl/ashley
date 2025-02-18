<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\SubCategoryController;

Route::get('/cache-clear', function() {
    Artisan::call('optimize:clear');
    return '<h1>All Cache cleared</h1>';
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Auth::routes(['register' => false]);

    Route::redirect('/', 'admin/login');
    Route::group(['middleware' => ['auth:admin','preventBackHistory']], function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');

        Route::get('update-profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('update-profile/{id}', [ProfileController::class, 'updateProfile'])->name('update_profile');

        Route::get('change-password', [ProfileController::class, 'showChangePasswordForm'])->name('changePasswordForm');
        Route::post('change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
        
        Route::post('country/get-details', [CountryController::class, 'getCountryDetail'])->name('countries.getCountryDetail');
        
        Route::post('sub-categories/get', [SubCategoryController::class, 'getSubCategories'])->name('subcategories.getSubCategories');

        Route::resources([
            'categories' => 'CategoryController',
            'provider-types' => 'ProviderTypeController',
            'verification-modes' => 'VerificationModeController',
            'countries' => 'CountryController',
            'evidence-types' => 'EvidenceTypeController',
            'sub-categories' => 'SubCategoryController',
            'verification-providers' => 'VerificationProviderController',
            'service-partners' => 'ServicePartnerController',
            'services' => 'ServicesController',
            'clients' => 'ClientController',
            'orders' => 'OrderController',
            'payments' => 'PaymentController',
            'processings' => 'ProcessingController',
        ]);
    });
});

