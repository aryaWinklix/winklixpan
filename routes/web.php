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

Route::get('/', 'WelcomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group( ['middleware' => ['auth']], function() {
    Route::resource('users', 'UserController')->names([
    	'index' => 'users.index',
    	'edit' => 'users.edit',
    	'destroy' => 'users.delete'
    ]);
    Route::resource('roles', 'RoleController')->names([
    	'index' => 'roles.index'
    ]);
    // Route::resource('posts', 'PostController');
});

Route::resource('items','ItemController')->names([
    'index' => 'items.index',
    'show' => 'items.show',
    'create' => 'items.create',
    'store' => 'items.store',
    'edit' => 'items.edit',
    'update' => 'items.update',
    'destroy' => 'items.delete',
]);



Route::resource('orders','OrderController')->names([
    'index' => 'orders.index',
    'show' => 'orders.show',
    'create' => 'orders.create',
    'store' => 'orders.store',
    'edit' => 'orders.edit',
    'update' => 'orders.update',
    'destroy' => 'orders.delete',
]);



Route::post('/uploadCsv','ItemController@uploadCsv')->name('uploadCsv');
