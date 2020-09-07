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

Route::get('/', 'HomeController@index')->name('home');

Route::view('/login/user', 'user.auth.login')->name('login.user');
Route::post('/login/user', 'LoginController@userLogin')->name('login.user');

Route::view('/login/admin', 'admin.auth.login')->name('login.admin');
Route::post('/login/admin', 'LoginController@adminLogin')->name('login.admin');

Route::view('/contact', 'main.contact')->name('info.contact');
Route::post('/contact', 'HomeController@submitFeedback')->name('info.contact');
Route::get('/privacy', 'HomeController@showPrivacy')->name('info.privacy');
Route::view('/faq', 'main.faq')->name('info.faq');


Route::middleware(['auth:user'])->prefix('user')->group(function () {
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

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/{user}/delete', 'AdminController@destroy')->name('destroyUser');
    Route::post('/changeSemesterStart', 'AdminController@changeSemesterStart')->name('changeSemester');
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('/settings', 'AdminController@showSettings')->name('settings');
    Route::get('/settings/maintenance', 'AdminController@maintenance')->name('settings.maintenance');

    Route::get('/news', 'AdminController@newsIndex')->name('news');
    Route::view('/news/create', 'admin.news.create')->name('news.create');
    Route::post('/news', 'AdminController@newsStore')->name('news.store');

    Route::get('/news/{id}', 'AdminController@newsShow')->name('news.edit');

    Route::get('/news/{id}/delete', 'AdminController@newsDestroy')->name('news.destroy');
});
