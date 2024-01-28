<?php

use Illuminate\Support\Facades\Route;

Route::prefix('todos')
    ->controller(App\Http\Controllers\TodoController::class)
    ->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::prefix('{todo}')
            ->group(function () {
                Route::get('', 'show');
                Route::patch('', 'update');
                Route::delete('', 'destroy');
            });
    });
