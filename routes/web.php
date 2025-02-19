<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

Route::get('/cache-clear', function() {
    Artisan::call('optimize:clear');
    return '<h1>All Cache cleared</h1>';
});
Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/catalogue', [HomeController::class, 'catalogue'])->name('catalogue');

Auth::routes(['verify' => true]);

// Route::middleware(['auth', 'preventBackHistory', 'verified'])->group(function () {
//     Route::get('/catalogue', [HomeController::class, 'catalogue'])->name('catalogue');
// });

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    //Auth::routes(['register' => false]);
    // 
    Route::namespace('Auth')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('loginSubmit');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/forget-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => ['auth.admin','preventBackHistory']], function () {
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

