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

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}

Route::get('/', 'LedgerController@index')->name('index');
Route::post('/create', 'LedgerController@store')->name('store');
Route::post('/login', 'LedgerController@login')->name('login');
Route::delete('/delete/{id}', 'LedgerController@destroy')->name('delete');
