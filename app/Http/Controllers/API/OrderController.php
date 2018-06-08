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
        $res = [
            'status' => 'success',
            'message' => 'Past Order Returns Successfully',
            'pastOrderList' => Order::where('user_id',$user_id)->get(),
        ];
        return $res;
    	// return PastOrderResource::collection(Order::where('user_id',$user_id)->get());
    }

    public function changeOrderStatusToCancel($order_id,$item_id)
    {
    	if (Order::findOrFail(1)->items()->updateExistingPivot(1, ['status' => 5])) {
            $res = [
                'status' => 'success',
                'message' => 'Item is Cancelled',
            ];
            return $res;
    		// return true;
    	}else{
            $res = [
                'status' => 'failed',
                'message' => 'problem with cancelling the order',
            ];
            return $res;
    		// return false;
    	}
    	// return Order::findOrFail(1)->items()->updateExistingPivot(1, ['status' => 5]);
    }

    public function addToCart(Request $request)
    {
        // return $request;

        $order = Order::where('user_id',$request->user_id)->where('status','cart')->first();
        if ($order) {
            $order->items()->attach($request->item_id, ['quantity' => 1,
                                                    'status' => 'temp']);
            $res = [
                'status' => 'success',
                'message' => 'Item added Successfully',
            ];
            return $res;
        }else {
            // return "false";
            $order = new Order;
            $order->user_id = $request->user_id;
            $order->amount = Item::where('id',$request->item_id)->get('price');
            $order->payment_id = "";
            $order->status = "cart";
            if ($order->save()) {
                // return "true";
                $res = [
                    'status' => 'success',
                    'message' => 'Cart created Successfully',
                    'cartDetails' => $order,
                ];
                return $res;
            }else{
                // return "false";
                $res = [
                    'status' => 'success',
                    'message' => 'Cart Not Created',
                ];
                return $res;
            }
        }
    }
}
