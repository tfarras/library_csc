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


Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/books/list-view','HomeController@listView')->name('books.listview');
Route::get('/books/list-import/index','HomeController@importListIndex')->name('books.listimport.index');
Route::post('/books/list-import/save','HomeController@importListSave')->name('books.listimport');
