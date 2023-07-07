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

Route::get('/list', function () {
    return view('list');
});

Route::get('/create', function () {
    return view('create');
});

Route::get('/edit/{id}', function () {
    return view('edit');
});


/**
 * Web API Routes
 */
Route::namespace('\App\Http\Controllers')->group(function() {
    Route::get('/list', 'KangarooTrackerController@getKangaroo');
});


