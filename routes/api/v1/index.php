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
    Route::get('/', [DocumentController::class, 'indexَAction'])->name('index');
    Route::get('/pick/{customerDocument}', [DocumentController::class, 'pickCustomerDocument'])->name('pick');
    Route::post('/store', [DocumentController::class, 'storeAction'])->name('store');
});