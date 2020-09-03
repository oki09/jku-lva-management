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

Route::view('/', 'main.home')->name('home');

Route::view('/login/user', 'user.auth.login')->name('login.user');
Route::post('/login/user', 'LoginController@userLogin')->name('login.user');

Route::view('/login/admin', 'admin.auth.login')->name('login.admin');
Route::post('/login/admin', 'LoginController@adminLogin')->name('login.admin');

Route::view('/contact', 'main.contact')->name('info.contact');
Route::post('/contact', 'ContactController@submitFeedback')->name('info.contact');
Route::get('/privacy', 'PrivacyController@show')->name('info.privacy');




Route::middleware(['layouts:user'])->prefix('user')->group(function () {
    Route::view('/', 'user.calendar.index')->name('calendar.index');
    Route::get('/calendar/events', 'CalendarController@getEvents')->name('calendar.events');

    Route::get('/lvas/delete', 'LvaController@destroy')->name('lva.destroy');
    Route::get('/lvas/create', 'LvaController@create')->name('lva.create');
    Route::get('/lvas', 'LvaController@index')->name('lva.index');
    Route::post('/lvas/disable', 'LvaController@disable')->name('lva.disable');
    Route::post('/lvas', 'LvaController@store')->name('lva.store');
    Route::post('/lvas/getLvaList', 'LvaController@getLvaList')->name('lva.getLvaList');

    Route::post('/logout', 'LoginController@logout')->name('logout.user');

    Route::get('/proxy', 'LvaController@proxyRequests')->name('proxy');
});

Route::middleware(['layouts:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/{user}/delete', 'AdminController@destroy')->name('destroyUser');
    Route::post('/changeSemesterStart', 'AdminController@changeSemesterStart')->name('changeSemester');
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('/settings', 'AdminController@showSettings')->name('settings');
    Route::get('/settings/maintenance', 'AdminController@maintenance')->name('settings.maintenance');
});
