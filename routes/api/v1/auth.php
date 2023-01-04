<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;

Route::post('/login', [LoginController::class, 'authentication'])->name('login');