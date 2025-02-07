<?php

use Illuminate\Support\Facades\Route;
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

    Route::get('update-profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('update-profile/{id}', [ProfileController::class, 'updateProfile'])->name('update_profile');

    Route::get('change-password', [ProfileController::class, 'showChangePasswordForm'])->name('changePasswordForm');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('changePassword');

    Route::resources([
        'categories' => 'CategoryController',
        'provider-types' => 'ProviderTypeController',
        'verification-modes' => 'VerificationModeController',
        'countries' => 'CountryController',
        'evidence-types' => 'EvidenceTypeController',
        'sub-categories' => 'SubCategoryController',
        'verification-providers' => 'VerificationProviderController',
        'service-partners' => 'ServicePartnerController',
        'clients' => 'ClientController',
    ]);
});
