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

Route::get('lab','WelcomeController@lab');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group( ['middleware' => ['auth']], function() {
    Route::resource('users', 'UserController')->names([
    	'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
    	'edit' => 'users.edit',
        'update' => 'users.update',
    	'destroy' => 'users.delete',
    ]);

    Route::get('getUsersByType/{type}','UserController@getUsersByType')->name('users.getUsersByType');

    Route::resource('roles', 'RoleController')->names([
    	'index' => 'roles.index'
    ]);
    // Route::resource('posts', 'PostController');

    Route::get('feedbacks','FeedbackController@getFeedbacks')->name('feedbacks.getFeedbacks');
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

// to update the price stock and minimal stock of item by vendor
Route::post('itemsAttrUpdate','ItemController@itemsAttrUpdate')->name('items.itemsAttrUpdate');
Route::get('addItemToMenu','ItemController@addItemToMenu')->name('items.addItemToMenu');
Route::post('storeItemToMenu','ItemController@storeItemToMenu')->name('items.storeItemToMenu');
Route::post('removeItemFromMenu','ItemController@removeItemFromMenu')->name('items.removeItemFromMenu');
//to update the status of an item in order
Route::post('itemStatusUpdate','ItemController@itemStatusUpdate')->name('items.itemStatusUpdate');


Route::resource('orders','OrderController')->names([
    'index' => 'orders.index',
    'show' => 'orders.show',
    'create' => 'orders.create',
    'store' => 'orders.store',
    'edit' => 'orders.edit',
    'update' => 'orders.update',
    'destroy' => 'orders.delete',
]);

Route::get('searchOrders/{status}','OrderController@searchOrders')->name('orders.searchOrders');
Route::get('updateOrderStatus/{order_id}/{item_id}/{status_id}','OrderController@updateOrderStatus');
Route::get('updateQuantity/{order_id}/{item_id}/{quantity}','OrderController@updateQuantity');



Route::get('getCart/{user_id}','OrderController@getCart');

Route::get('getAddToCart','OrderController@getAddToCart')->name('getAddToCart');

Route::post('addToCart','OrderController@addToCart')->name('addToCart');

Route::get('addItemToCart/{user_id}/{item_id}','OrderController@addItemToCart');


Route::post('/uploadCsv','ItemController@uploadCsv')->name('uploadCsv');
