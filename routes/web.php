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
Route::get('/beneficiaries/list-view','HomeController@listViewBeneficiariesIndex')->name('beneficiaries.listview');
Route::get('/beneficiaries/list-import/index','HomeController@importListBeneficiariesIndex')->name('beneficiaries.listimport.index');
Route::post('/beneficiaries/list-import/save','HomeController@importListBeneficiariesSave')->name('beneficiaries.listimport');

Route::get('/books/add/manual/index',function (){
    return view('layouts.manualBook');
})->name('books.manual.add');
Route::get('/beneficiary/add/manual/index',function (){
    return view('layouts.manualBeneficiary');
})->name('beneficiary.manual.add');

Route::post('/books/add/manual/save','HomeController@manualAddBook')->name('books.manual.add.save');
Route::post('/beneficiary/add/manual/save','HomeController@manualAddBeneficiary')->name('beneficiaries.manual.add.save');