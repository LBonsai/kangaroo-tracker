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

/**
 * Page Routes
 */
Route::view('/', 'list');

Route::prefix('kangaroo')->group(function () {
    Route::view('list', 'list');
    Route::view('add', 'form');
    Route::view('edit/{id}', 'form');
});

/**
 * Web API Routes
 */
Route::prefix('api')->group(function() {
    Route::namespace('\App\Http\Controllers')->group(function() {
        Route::get('/list', 'KangarooTrackerController@getKangaroo');
        Route::get('/check-name', 'KangarooTrackerController@checkIfNameExists');
        Route::post('/add', 'KangarooTrackerController@addKangaroo');
        Route::get('/list/{id}', 'KangarooTrackerController@getKangarooById');
        Route::put('/edit/{id}', 'KangarooTrackerController@editKangaroo');
    });
});


