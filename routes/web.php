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

Auth::routes();

Route::prefix('manage')->middleware('role:superadministrator|administrator|')->group(function(){
   Route::get('/', 'ManageController@index')->name('manage.index');
   Route::get('/panel','ManageController@panel')->name('manage.panel');

   Route::resource('/users', 'UserController', ['names' => ['index'=>'user.index',]]);

});

Route::prefix('category')->middleware('role:superadministrator|administrator|')->group(function(){
	// Category
		Route::get('/', 'CategoryController@index')->name('category.index');
		Route::get('/create', 'CategoryController@create')->name('category.create');
		Route::post('/store', 'CategoryController@store')->name('category.store');
		Route::get('/show/{id}', 'CategoryController@show')->name('category.show');

		//wysylanie smsów do grupy z kategorii
		Route::post('/sendSMS', 'CategoryController@send')->name('sendSMS.send');

});


Route::prefix('note')->middleware('role:superadministrator|administrator|')->group(function(){
   Route::get('/','NoteController@index')->name('note.index');
   Route::get('/create','NoteController@create')->name('note.create');
   Route::post('/store','NoteController@store')->name('note.store');
   Route::get('/notification/{task?}','NoteController@notification')->name('note.notification');
   Route::put('/delNotification/{id}','NoteController@delNotification')->name('note.delNotification')->where('id','[0-9]+');
   Route::delete('/destroy/{id}','NoteController@destroy')->name('note.destroy')->where('id','[0-9]+');

});

//zarządzanie widokami klientów
Route::prefix('customer')->middleware('role:superadministrator|administrator|')->group(function(){
   Route::get('/','CustomerController@index')->name('customer.index');
   Route::get('/create', 'CustomerController@create')->name('customer.create');
   Route::post('/store', 'CustomerController@store')->name('customer.store');
   Route::post('/add_category', 'CustomerController@add_category')->name('customer.add_category');
   Route::get('/show/{id}', 'CustomerController@show')->name('customer.show')->where('id', '[0-9]+');
   Route::put('/delNotification/{id}','CustomerController@delNotification')->name('customer.delNotification')->where('id','[0-9]+');	//PUT - update| POST-dodanie | delete - usunięcie
   Route::delete('/destroy/{id}','CustomerController@destroy')->name('customer.destroy')->where('id','[0-9]+');                       //usuwanie notatki
   Route::post('/addNote/{id}', 'CustomerController@addNote')->name('customer.addNote')->where('id', '[0-9]+');                       //dodanie notatki
   Route::post('/sendSMS/{id}', 'CustomerController@sendSMS')->name('customer.sendSMS')->where('id', '[0-9]+');                       //dodanie SMSa
   Route::get('/found/{number}', 'CustomerController@found')->name('customer.found')->where('number', '[0-9]+');                       //przejście z powtórzeonego numeru klienta!
   Route::get('/searchbox', 'CustomerController@searchbox')->name('customer.searchbox');                       					//formularz wyszykiwarki
   Route::post('/search', 'CustomerController@search')->name('customer.search');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/site_403', 'HomeController@error_403')->name('error_403');
