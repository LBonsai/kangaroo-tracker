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
Route::get('/', function () {
    return view('list');
});

Route::get('/kangaroo/list', function () {
    return view('list');
});

Route::get('/kangaroo/add', function () {
    return view('add');
});

Route::get('/kangaroo/edit/{id}', function () {
    return view('edit');
});


/**
 * Web API Routes
 */
Route::namespace('\App\Http\Controllers')->prefix('api')->group(function() {
    Route::get('/list', 'KangarooTrackerController@getKangaroo');
    Route::get('/check-name/{name}', 'KangarooTrackerController@checkIfNameExists');
    Route::post('/add', 'KangarooTrackerController@addKangaroo');
});


