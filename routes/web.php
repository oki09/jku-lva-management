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

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', 'LoginController@login')->name('login');


Route::middleware(['auth'])->group(function () {
    Route::view('/', 'calendar.index')->name('calendar.index');
    Route::get('/calendar/events', 'CalendarController@getEvents')->name('calendar.events');

    Route::get('/lva/delete', 'LvaController@destroy')->name('lva.destroy');
    Route::get('/lva/create', 'LvaController@create')->name('lva.create');
    Route::get('/lva', 'LvaController@index')->name('lva.index');
    Route::post('/lva/disable', 'LvaController@disable')->name('lva.disable');
    Route::post('/lva', 'LvaController@store')->name('lva.store');

    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::get('/proxy', 'LvaController@proxyRequests')->name('proxy');

    Route::view('/contact', 'info.contact')->name('info.contact');
    Route::view('/privacy', 'info.privacy')->name('info.privacy');
});
