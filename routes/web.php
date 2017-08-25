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
	Route::get('/test','ManageController@test')->name('manage.test');
   Route::resource('/users', 'UserController', ['names' => ['index'=>'user.index',]]);
	Route::get('/profil', 'ManageController@profil')->name('manage.profil');

});

Route::prefix('admin')->middleware('role:superadministrator|administrator')->group(function(){
   Route::get('/', 'AdminController@index')->name('admin.index');
	Route::get('/create', 'AdminController@create')->name('admin.create');
	Route::post('/store', 'AdminController@store')->name('admin.store');
	Route::get('/show/{id}', 'AdminController@show')->name('admin.show');
	Route::get('/deleteaccess/{id}', 'AdminController@deleteaccess')->name('admin.deleteaccess');
	Route::post('/access/{id}', 'AdminController@access')->name('admin.access');
	Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
	Route::put('/update/{id}', 'AdminController@update')->name('admin.update');

	Route::prefix('role')->middleware('role:superadministrator')->group(function(){
		Route::get('/', 'AdminController@role')->name('admin.role.index');
		Route::get('/show/{id}', 'AdminController@role_show')->name('admin.role.show');
		Route::put('/edit/{id}', 'AdminController@role_edit')->name('admin.role.edit');
	});

	Route::prefix('permission')->middleware('role:superadministrator')->group(function(){
		Route::get('/', 'AdminController@permission')->name('admin.permission.index');
		Route::get('/edit/{id}', 'AdminController@permission_edit')->name('admin.permission.edit');
		Route::put('/update/{id}', 'AdminController@permission_update')->name('admin.permission.update');
		Route::delete('/delete/{id}', 'AdminController@permission_delete')->name('admin.permission.delete');
		Route::get('/create', 'AdminController@permission_create')->name('admin.permission.create');
		Route::post('/store', 'AdminController@permission_store')->name('admin.permission.store');
	});


});





Route::prefix('category')->middleware('role:superadministrator|administrator|employee')->group(function(){
	// Category
		Route::get('/', 'CategoryController@index')->name('category.index');
		Route::get('/create', 'CategoryController@create')->name('category.create');
		Route::post('/store', 'CategoryController@store')->name('category.store');
		Route::get('/show/{id}', 'CategoryController@show')->name('category.show');


		Route::post('/sendSMS', 'MessageController@send')->name('sendSMS.send');/////////////////////////////////////////////////////////

});

Route::prefix('note')->middleware('role:superadministrator|administrator|employee')->group(function(){
   Route::get('/','NoteController@index')->name('note.index');
   Route::get('/create','NoteController@create')->name('note.create');
   Route::post('/store','NoteController@store')->name('note.store');
   Route::get('/notification/{task?}','NoteController@notification')->name('note.notification');
   Route::put('/delNotification/{id}','NoteController@delNotification')->name('note.delNotification')->where('id','[0-9]+');
   Route::delete('/destroy/{id}','NoteController@destroy')->name('note.destroy')->where('id','[0-9]+');

});

//zarządzanie widokami klientów
Route::prefix('customer')->middleware('role:superadministrator|administrator|employee')->group(function(){
   Route::get('/','CustomerController@index')->name('customer.index');
   Route::get('/create', 'CustomerController@create')->name('customer.create');
   Route::post('/store', 'CustomerController@store')->name('customer.store');
   Route::post('/add_category', 'CustomerController@add_category')->name('customer.add_category');
   Route::get('/show/{id}', 'CustomerController@show')->name('customer.show')->where('id', '[0-9]+');
   Route::put('/delNotification/{id}','CustomerController@delNotification')->name('customer.delNotification')->where('id','[0-9]+');	//PUT - update| POST-dodanie | delete - usunięcie
   Route::delete('/destroy/{id}','CustomerController@destroy')->name('customer.destroy')->where('id','[0-9]+');                       //usuwanie notatki
   Route::post('/addNote/{id}', 'CustomerController@addNote')->name('customer.addNote')->where('id', '[0-9]+');                       //dodanie notatki
   Route::post('/sendSMS/{id}', 'MessageController@sendSMS')->name('customer.sendSMS')->where('id', '[0-9]+');                       //dodanie SMSa
   Route::get('/found/{number}', 'CustomerController@found')->name('customer.found')->where('number', '[0-9]+');                       //przejście z powtórzeonego numeru klienta!
   Route::get('/searchbox', 'CustomerController@searchbox')->name('customer.searchbox');                       					//formularz wyszykiwarki
   Route::post('/search', 'CustomerController@search')->name('customer.search');
});


Route::prefix('messages')->middleware('role:superadministrator|administrator|employee')->group(function(){
   Route::get('/','MessageController@index')->name('message.index');

});

Route::get('/home', 'HomeController@index')->name('home');
