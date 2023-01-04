<?php

use App\Http\Controllers\Api\V1\DocumentController;
use App\Http\Controllers\Api\V1\ReviewerDocumentController;

Route::group(
    [
        'as' => 'auth.',
        'prefix' => 'auth',
    ],
    base_path('routes/api/v1/auth.php')
);

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['as' => 'documents.', 'prefix' => 'documents'], function() {
        Route::get('/', [DocumentController::class, 'customerDocumentIndexAction'])->name('index');
        Route::get('/pick/{customerDocument}', [DocumentController::class, 'pickCustomerDocumentAction'])->name('pick');
        Route::post('/store', [DocumentController::class, 'storeAction'])->name('store');

        Route::group(['as' => 'reviewers.', 'prefix' => 'reviewers'], function() {
            Route::get('/', [ReviewerDocumentController::class, 'indexAction'])->name('index');
            Route::get('/confirm/{document}', [ReviewerDocumentController::class, 'makeConfirmDocument'])
                ->name('make_confirm_document');
        });
    });
});
