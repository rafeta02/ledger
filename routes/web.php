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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');
	

Route::middleware(['auth', 'clearance'])->group(function () {

	Route::get('/create-journal', function () {
	    return view('pages.journal.journal_create');
	});

	Route::get('/ledger', 'LedgerController@index')->name('ledger.index');
	Route::post('/ledger', 'LedgerController@store')->name('ledger.store');
	Route::get('/ledger/export', 'LedgerController@export')->name('ledger.export');
	Route::get('/ledger/view', 'LedgerController@view')->name('ledger.view');
	Route::get('/ledger/current', 'LedgerController@monthly')->name('ledger.monthly');
	Route::post('/ledger/current', 'LedgerController@save')->name('ledger.save');

	Route::resource('type-coa', 'TypecoaController')->except([
		'view'
	]);

	Route::get('/coa/import', 'CoaController@import')->name('coa.import');
	Route::post('/coa/import', 'CoaController@importPost')->name('coa.importpost');
	Route::get('/coa/export', 'CoaController@export')->name('coa.export');
	Route::get('/coa/examplexport', 'CoaController@exportExample')->name('coa.exportexample');
	//Route::get('/coa/latihanexport', 'CoaController@exportLatihan')->name('coa.exportlatihan');
	
	Route::resource('coa', 'CoaController')->except([
		'view'
	]);

	Route::get('/journal/posting', 'JournalController@posting')->name('journal.posting');
	Route::post('/journal/posting', 'JournalController@postingPost')->name('journal.postingpost');

	Route::get('/journal/filter', 'JournalController@filter')->name('journal.filter');
	Route::get('/journal/view', 'JournalController@view')->name('journal.view');

	Route::get('/journal/import', 'JournalController@import')->name('journal.import');
	Route::post('/journal/import', 'JournalController@importPost')->name('journal.importpost');

	Route::resource('journal', 'JournalController');

	Route::resource('/setup/neraca', 'SetupNeracaController', ['as' => 'setup'])->only([
		'index', 'store',
	]);
	Route::resource('/setup/labarugi', 'SetupLabarugiController', ['as' => 'setup'])->only([
		'index', 'store',
	]);

	Route::resource('neraca', 'NeracaController');
	Route::resource('labarugi', 'LabarugiController');

});










