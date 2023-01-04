<?php

use App\Http\Controllers\Api\V1\DocumentController;

Route::group(
    [
        'as' => 'auth.',
        'prefix' => 'auth',
    ],
    base_path('routes/api/v1/auth.php')
);

Route::group(['as' => 'documents.', 'prefix' => 'documents', 'middleware' => 'auth:api'], function() {
    Route::get('/', [DocumentController::class, 'customerDocumentIndexAction'])->name('index');
    Route::post('/pick/{customerDocument}', [DocumentController::class, 'pickCustomerDocument'])->name('pick');
    Route::post('/store', [DocumentController::class, 'storeAction'])->name('store');
});