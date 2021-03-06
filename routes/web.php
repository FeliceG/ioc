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


Route::get('/', 'PageController@home');

Route::get('/guidelines', 'PageController@guidelines');

Route::get('/email/confirm', 'EmailController@confirm');

Route::group(['middleware' => ['web']], function () {

      Route::get('/research/show', 'EditController@getShowResearch');
      Route::post('/research/show', 'EditController@postShowResearch');
      Route::get('/research/edit', 'EditController@getEditResearch');
      Route::post('/research/edit', 'EditController@postEditResearch');
      Route::get('/research/delete', 'EditController@getDeleteResearch');
      Route::post('/research/delete', 'EditController@postDeleteResearch');

});

Route::resource('research', "ResearchController");

Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');
