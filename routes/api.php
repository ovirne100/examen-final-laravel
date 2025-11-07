<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

// Prefijo: /api/
Route::prefix('v1')->group(function () {

    // CRUD completo para la tabla products.. esta es la tabla que escoji
    Route::apiResource('products', ProductController::class);
});
