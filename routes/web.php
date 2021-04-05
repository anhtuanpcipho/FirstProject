<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;

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

Route::get('/', function () {
    return view('welcome');
});

// CRUD route
Route::resource('works', WorkController::class);

//add search route
Route::get('/search', 'App\Http\Controllers\WorkController@search')->name('search');

Route::get('livesearch', function () {
    return view('livesearch');
});

Route::post('livesearch','App\Http\Controllers\WorkController@livesearch');

Route::get('/loadimage', 'App\Http\Controllers\WorkController@loadimage')->name('loadimage');