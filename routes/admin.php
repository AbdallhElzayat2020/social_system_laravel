<?php

use Illuminate\Support\Facades\Route;


Route::get('test', function () {
    return 'test';
});


require __DIR__ . '/auth.php';
