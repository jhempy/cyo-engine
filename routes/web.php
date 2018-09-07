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
    $adventures = \App\Adventure::where('publish_date', '!=', null)->get();
    return view('welcome', compact('adventures'));
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'AdventureController@index')->name('home');

Route::resource('adventures', 'AdventureController');

//Route::resource('adventures/{adv_id}/pages', 'PageController');

//Route::resource('adventures/{adv_id}/decisions', 'DecisionController');

Route::resource('/pages', 'PageController');

Route::resource('/read', 'ReadController');

Route::resource('/map', 'MapController');
