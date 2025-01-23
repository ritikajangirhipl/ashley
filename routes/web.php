<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\AccreditationBodiesController;
use App\Http\Controllers\Admin\IssuersController;
use App\Http\Controllers\Admin\DegreesController;
use App\Http\Controllers\Admin\CurriculumsController;
use App\Http\Controllers\Admin\CurriculumDetailsController;
use App\Http\Controllers\Admin\ReceiversController;
use App\Http\Controllers\Admin\BillingDefinitionsController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\EvaluationTemplatesController;
use App\Http\Controllers\Admin\EvaluationTemplateMappingsController;
use App\Http\Controllers\Admin\HolderSubmissionsController;
use App\Http\Controllers\Admin\ProcessingSubmissionsController;
use App\Http\Controllers\Admin\CategoryController;

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

    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    Route::resource('categories', CategoryController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Update Profile
    Route::get('update-profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('update-profile/{id}', [ProfileController::class, 'updateProfile'])->name('update_profile');

    // Change Password
    Route::get('change-password', [ProfileController::class, 'showChangePasswordForm'])->name('changePasswordForm');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('changePassword');

    // Issuer
    Route::put('issuers-update-status', [IssuersController::class,'changeStatus'])->name('issuers.updateStatus');
    Route::resource('issuers', IssuersController::class);

    // Receiver
    Route::put('receivers-update-status', [ReceiversController::class,'changeStatus'])->name('receivers.updateStatus');
    Route::resource('receivers', ReceiversController::class);

    // Degrees
    Route::get('{degreeType}/get-degrees', [DegreesController::class, 'getAllOptions'])->name('degrees.getAllOptions');
    Route::put('{degreeType}/update-degrees-status', [DegreesController::class,'changeStatus'])->name('degrees.updateStatus');    
    Route::resource('{degreeType}/degrees', DegreesController::class);

    // Curriculums
    Route::get('{type}/get-curriculums', [CurriculumsController::class, 'getAllOptions'])->name('curriculums.getAllOptions');
    Route::put('{type}/update-curriculums-status', [CurriculumsController::class,'changeStatus'])->name('curriculums.updateStatus');
    Route::resource('{type}/curriculums', CurriculumsController::class);

    // Curriculum Details
    Route::put('{type}/update-curriculum-details-status', [CurriculumDetailsController::class,'changeCurriculumDetailsStatus'])->name('curriculumDetails.updateStatus');
    Route::resource('{type}/curriculum-details', CurriculumDetailsController::class);

    // Students
    Route::put('update-student-status', [StudentsController::class,'changeStudentStatus'])->name('students.updateStatus');
    Route::resource('students', StudentsController::class);

    //Evaluation Templates 
    Route::put('update-evaluation-templates-status', [EvaluationTemplatesController::class,'changeStatus'])->name('evaluationTemplates.updateStatus');

    Route::get('get-evaluation-template-records', [EvaluationTemplatesController::class, 'getAllRecords'])->name('evaluationTemplates.getAllRecords');

    Route::resource('evaluation-templates', EvaluationTemplatesController::class,['parameters' => ['evaluation-templates' => 'evaluationTemplate']]);

    //Evaluation Template Mapping

    Route::get('get-issuer-curriculum', [EvaluationTemplateMappingsController::class, 'getIssuerCurriculumDetailOptions'])->name('evaluation-template-mappings.getIssuerCurriculumDetailOptions');

    Route::get('get-receiver-curriculum', [EvaluationTemplateMappingsController::class, 'getReceiverCurriculumDetailOptions'])->name('evaluation-template-mappings.getReceiverCurriculumDetailOptions');

    Route::put('update-evaluation-template-mappings-status', [EvaluationTemplateMappingsController::class,'changeStatus'])->name('evaluation-template-mappings.updateStatus');

    Route::resource('evaluation-template-mappings', EvaluationTemplateMappingsController::class,['parameters' => ['evaluation-template-mappings' => 'evaluationTemplateMapping']]);

    // Billing Definitions
    Route::get('{billingType}/get-fees-to-pay', [BillingDefinitionsController::class, 'getFeesToPay'])->name('billingFeesToPay.getFeesToPay');
    Route::put('{billingType}/update-billing-definitions-status', [BillingDefinitionsController::class,'changeStatus'])->name('billingDefinitions.updateStatus');
    Route::resource('{billingType}/billing-definitions', BillingDefinitionsController::class,['parameters' => ['billing-definitions' => 'billingDefinition']]);

    

    /*
    |--------------------------------------------------------------------------
    | Submission Stage Management Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'holder-submissions/{holder_submission_id}', 'as' => 'submissionProcessing.'], function () {
    
        // Bill and Verify Payment
        Route::group(['prefix' => 'stage1', 'as' => 'stage1.'], function () {
            Route::resource('bill-verify-payments', BillVerifyPaymentsController::class);
        });

        // Request Verification Access
        Route::group(['prefix' => 'stage2', 'as' => 'stage2.'], function () {
            Route::resource('request-verification-access', RequestVerificationAccessController::class);
        });

        // Extract Transcript
        Route::group(['prefix' => 'stage3', 'as' => 'stage3.'], function () {
            Route::resource('extract-transcripts', ExtractTranscriptsController::class);
        });
    });
    // Holder Submissions
    Route::put('update-status', [HolderSubmissionsController::class,'changeStatus'])->name('holderSubmissions.updateStatus');
    Route::post('holder-submissions/update-document', [HolderSubmissionsController::class,'updateDocument'])->name('holderSubmissions.updateDocument');
    Route::resource('holder-submissions', HolderSubmissionsController::class);


    //  Processing Submissions
    Route::post('get-template-mappings', [ProcessingSubmissionsController::class, 'getTemplateMappings'])->name('evaluation-template-mappings.getTemplateMappings');

    Route::post('update-steps/{holderSubmission}', [ProcessingSubmissionsController::class,'updateSteps'])->name('processingSubmissions.updateSteps');
    Route::get('generate-evaluation-report/{holderSubmission}', [ProcessingSubmissionsController::class, 'generateEvaluationReport'])->name('processingSubmissions.generateEvaluationReport');
    Route::post('generate-extraction-report/{holderSubmission}', [ProcessingSubmissionsController::class, 'generateExtractionReport'])->name('processingSubmissions.generateExtractionReport');
    Route::get('merge-report/{holderSubmission}', [ProcessingSubmissionsController::class, 'mergeReport'])->name('processingSubmissions.mergeReport');

    Route::get('submission-recipent/delete/{recipent_id}', [ProcessingSubmissionsController::class, 'deleteReportRecipent'])->name('processingSubmissions.deleteReportRecipent');

    Route::resource('processing-submissions', ProcessingSubmissionsController::class,['parameters' => ['processing-submissions' => 'holderSubmission']]);



    /*
    |--------------------------------------------------------------------------
    | All Master Routes
    |--------------------------------------------------------------------------
    */    
        /*
        |--------------------------------------------------------------------------
        | Level Master API Routes
        |--------------------------------------------------------------------------
        | 
        | Route         : http://localhost:8000/admin/levels
        |
        */
        Route::put('update-level-status', [LevelMastersController::class,'changeLevelStatus'])->name('levels.updateStatus');
        Route::resource('levels', LevelMastersController::class,['parameters' => ['levels' => 'levelMaster']]);

        // Country
        // change status of country
        Route::put('update-country-status', [CountriesController::class,'changeCountryStatus'])->name('countries.updateStatus');
        Route::resource('countries', CountriesController::class);

        // Accreditation Body
        Route::get('get-accreditation-bodies', [AccreditationBodiesController::class, 'getAllOptions'])->name('accreditationBodies.getAllOptions');
        Route::put('update-accreditation-status', [AccreditationBodiesController::class,'changeStatus'])->name('accreditationBodies.updateStatus');
        Route::resource('accreditation-bodies', AccreditationBodiesController::class,['parameters' => ['accreditation-bodies' => 'accreditationBody']]);

        

});
