<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => 'api',
    'namespace' => 'Quidmye\ProductsEndpoint\App\Http\Controllers\API'
], function () {
    Route::group([
        'prefix' => 'v1'
    ], function () {
        Route::group([
            'prefix' => 'products',
            'namespace' => 'Products'
        ], function () {
            Route::get('format/{id}', 'FormattingController@check')->name('format.check');
            Route::post('format', 'FormattingController@format')
                ->withoutMiddleware([
                    \App\Http\Middleware\VerifyCsrfToken::class
                ]);
        });
    });
});