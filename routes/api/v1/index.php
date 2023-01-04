<?php

Route::group(
    [
        'as' => 'auth.',
        'prefix' => 'auth',
    ],
    base_path('routes/api/v1/auth.php')
);