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
Route::post('/books/edit/save','HomeController@editBookSave')->name('books.edit.save');
Route::post('/beneficiary/add/manual/save','HomeController@manualAddBeneficiary')->name('beneficiaries.manual.add.save');
Route::post('/beneficiary/edit/save','HomeController@editBeneficiarySave')->name('beneficiaries.edit.save');
Route::get('/books/edit/{id}','HomeController@editBookPage')->name('books.edit.page');
Route::get('/books/delete/{id}',function (\Illuminate\Http\Request $request){
    \App\Book::find($request->id)->delete();
    return redirect()->route('books.listview')->with('success','Record was deleted successfully!');
})->name('books.delete.page');

Route::get('beneficiary/delete/{id}',function (\Illuminate\Http\Request $request){
   \App\Beneficiary::find($request->id)->delete();
   return redirect()->route('beneficiaries.listview')->with('success','Record was deleted successfully!');
})->name('beneficiary.delete.page');
Route::get('/beneficiary/edit/{id}','HomeController@editBeneficiaryPage')->name('beneficiary.edit.page');

