<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use App\Http\Resources\Order\OrderResource as OrderResource;
use App\Http\Resources\Order\PastOrderResource as PastOrderResource;
use App\Http\Resources\Order\ChangeOrderStatusResource as ChangeOrderStatusResource;


class OrderController extends Controller
{
    public function showPastOrders($user_id)
    {
    	return PastOrderResource::collection(Order::where('user_id',$user_id)->get());
    }

    public function changeOrderStatusToCancel($order_id,$item_id)
    {
    	if (Order::findOrFail(1)->items()->updateExistingPivot(1, ['status' => 5])) {
    		return true;
    	}else{
    		return false;
    	}
    	// return Order::findOrFail(1)->items()->updateExistingPivot(1, ['status' => 5]);
    }
}
