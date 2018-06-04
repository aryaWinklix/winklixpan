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
	Route::get('items','ItemController@index');
	Route::get('items/{slug}','ItemController@show');
	Route::get('getItemsByCategory/{cat}','ItemController@getItemsByCategory');

	Route::get('orders/{user_id}','OrderController@showPastOrders');
	Route::get('cancelOrder/{order_id}/{item_id}','OrderController@changeOrderStatusToCancel');

	Route::post('checkAuth','UserController@chackAuth');
	Route::get('getUserInfo/{user_id}','UserController@getUserInfo');

});


