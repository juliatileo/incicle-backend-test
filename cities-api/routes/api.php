<?php

use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'cities'
], function () {
    Route::get('/', [CityController::class, 'list']);
    Route::post('/verify', [CityController::class, 'city_exists']);
    Route::post('/{state_id}', [CityController::class, 'create']);
    Route::put('/{city_id}', [CityController::class, 'update']);
});
