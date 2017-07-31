<?php

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

Route::get('jobs/{any?}', 'JobsController@index')->name('jobs')->where('any', '.*');

Auth::routes();

Route::get('applications/{any?}', 'ApplicationsController@index')->name('applications')->where('any', '.*');
