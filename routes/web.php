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

Route::view('/', 'main.welcome')->name('welcome');

Route::view('/login/user', 'user.auth.login')->name('login.user');
Route::post('/login/user', 'LoginController@userLogin')->name('login.user');

Route::view('/login/admin', 'admin.auth.login')->name('login.admin');
Route::post('/login/admin', 'LoginController@adminLogin')->name('login.admin');


Route::middleware(['auth:user'])->prefix('user')->group(function () {
    Route::view('/', 'user.calendar.index')->name('calendar.index');
    Route::get('/calendar/events', 'CalendarController@getEvents')->name('calendar.events');

    Route::get('/lvas/delete', 'LvaController@destroy')->name('lva.destroy');
    Route::get('/lvas/create', 'LvaController@create')->name('lva.create');
    Route::get('/lvas', 'LvaController@index')->name('lva.index');
    Route::post('/lvas/disable', 'LvaController@disable')->name('lva.disable');
    Route::post('/lvas', 'LvaController@store')->name('lva.store');

    Route::post('/logout', 'LoginController@logout')->name('logout.user');

    Route::get('/proxy', 'LvaController@proxyRequests')->name('proxy');

    Route::view('/contact', 'user.info.contact')->name('info.contact');
    Route::view('/privacy', 'user.info.privacy')->name('info.privacy');
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/{user}/delete', 'AdminController@destroy')->name('destroyUser');
    Route::post('/changeSemesterStart', 'AdminController@changeSemesterStart')->name('changeSemester');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});
