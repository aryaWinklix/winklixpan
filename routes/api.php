<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('API')->group(function (){
	Route::get('items/{floor_no}','ItemController@index');
	Route::get('items/{slug}','ItemController@show');
	Route::get('getItemsByCategory/{cat}/{floor_no}','ItemController@getItemsByCategory');

	Route::get('orders/{user_id}','OrderController@showPastOrders');
	Route::get('cancelOrder/{order_id}/{item_id}','OrderController@changeOrderStatusToCancel');


	Route::get('updateQuantity/{order_id}/{item_id}/{quantity}','CartController@updateQuantity');
	Route::get('getCart/{user_id}','CartController@getCart');
	Route::post('addToCart','CartController@addToCart');

	Route::post('checkAuth','UserController@chackAuth');
	Route::get('getUserInfo/{user_id}','UserController@getUserInfo');

	Route::get('getAllVendors','UserController@getAllVendors');
	Route::get('getVendorInfo/{floor_no}','UserController@getVendorInfo');
	
	Route::post('addFeedback','FeedbackController@addFeedback');

	// Route::get('updateQuantity/{user_id}/{item_id}/{count}','CartController@updateQuantity');

});


