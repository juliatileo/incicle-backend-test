<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => 'api',
    'prefix' => 'users'
], function () {
    Route::post('/', [UserController::class, 'create']);
});
