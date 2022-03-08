<?php

use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'logs'
], function () {
    Route::post('/', [LogController::class, 'create']);
});
