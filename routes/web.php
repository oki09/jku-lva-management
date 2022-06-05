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
Route::view('/privacy', 'main.privacy')->name('info.privacy');
Route::get('/faq', 'HomeController@faqs')->name('info.faq');


Route::middleware(['auth:user'])->prefix('user')->group(function () {
    Route::view('/calendar', 'user.calendar.index')->name('calendar.index');
    Route::get('/calendar/events', 'CalendarController@getEvents')->name('calendar.events');

    Route::get('/lvas/delete', 'LvaController@destroy')->name('lva.destroy');
    Route::view('/lvas/create', 'user.lva.create')->name('lva.create');
    Route::get('/lvas', 'LvaController@index')->name('lva.index');
    Route::post('/lvas/disable', 'LvaController@disable')->name('lva.disable');
    Route::post('/lvas', 'LvaController@store')->name('lva.store');
    Route::post('/lvas/getLvaList', 'LvaController@getLvaList')->name('lva.getLvaList');

    Route::post('/logout', 'LoginController@logout')->name('logout.user');

    Route::get('/proxy', 'LvaController@proxyRequests')->name('proxy');
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::post('/changeSemesterStart', 'AdminController@changeSemesterStart')->name('changeSemester');
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('/settings', 'AdminController@showSettings')->name('settings');
    Route::get('/settings/maintenance', 'AdminController@maintenance')->name('settings.maintenance');


    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/', 'AdminController@newsIndex')->name('index');
        Route::post('/', 'AdminController@newsStore')->name('store');
        Route::view('/create', 'admin.news.create')->name('create');
        Route::get('/{id}', 'AdminController@newsShow')->name('edit');
        Route::get('/{id}/delete', 'AdminController@newsDestroy')->name('destroy');
    });

    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', 'AdminController@faqIndex')->name('index');
        Route::post('/', 'AdminController@faqStore')->name('store');
        Route::view('/create', 'admin.faq.create')->name('create');
        Route::get('/{id}', 'AdminController@faqShow')->name('edit');
        Route::get('/{id}/delete', 'AdminController@faqDestroy')->name('destroy');
    });

    Route::get('/{user}', 'AdminController@show')->name('user.show');
    Route::get('/{user}/delete', 'AdminController@destroy')->name('user.destroy');
    Route::get('/{user}/course/delete', 'AdminController@deleteCourse')->name('user.course.destroy');
});
