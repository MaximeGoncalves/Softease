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
Route::get('/logout', 'UserController@logout');

Route::middleware(['auth', 'active'])->group(function () {

    Route::get('/admin', 'HomeController@index')->name('home');

// Route pour les logins
    Route::resource('/admin/login', 'loginsController');
//    Route::post('/admin/login/createSociety', 'loginsController@createSociety')->name('login.createSociety');

//Route pour Sociétés
    Route::resource('/admin/society', 'SocietyController');

//Route pour users
    Route::resource('/admin/user', 'UserController');

//Route pour les rôles
    Route::resource('/admin/role', 'RoleController');

//Route pour les tickets
    Route::resource('/ticket', 'TicketController');
    Route::post('/ticket/{ticket}', 'MessageController@store')->name('message.store');

});

