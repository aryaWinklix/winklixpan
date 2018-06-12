<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use App\Item;
use App\User;

class CartController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @param user_id, item_id, quantity.
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $order = Order::where('user_id',$request->user_id)->where('status','cart')->first();
        $user = User::findOrFail($request->user_id);
        $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
        // return $order;
        if ($order) {
            $orderDoesntHaveItems = Order::where('user_id',$request->user_id)->where('status','cart')->doesntHave('items')->first();
            // return $orderDoesntHaveItems;
            if ($orderDoesntHaveItems) {
                $order->items()->attach($request->item_id, ['quantity' => $request->quantity,
                                                            'status' => 'cart',
                                                            'buying_price' => $vendor->items()->where('item_id',$request->item_id)->first()->pivot->price]);
                //update amount of order
                //get price
                $order->amount = ($order->amount + $vendor->items()->where('item_id',$request->item_id)->first()->pivot->price);

                if ($order->update()) {
                    $res = [
                        'status' => 'success',
                        'message' => 'Item added Successfully and Order Updated Successfully',
                    ];
                    return $res;
                }else{
                    $res = [
                        'status' => 'success',
                        'message' => 'Item added Successfully but Order not Updated Successfully',
                    ];
                    return $res;
                }
            }else{
                //if item_id present in pivot table than update quantity
                if ($order->items()->where('item_id',$request->item_id)->first()) {
                    //update quantiy
                    $order->items()->updateExistingPivot($request->item_id, ['quantity' => $request->quantity,
                                                                            'status' => 'cart',
                                                                            'buying_price' => $vendor->items()->where('item_id',$request->item_id)->first()->pivot->price
                                                                        ]);
                    //update amount of order
                    // $order->amount = ($order->amount + $vendor->items()->where('item_id',$request->item_id)->first()->pivot->price);
                    $order->amount = $this->getAmountOfOrder($order->id);
                    if ($order->update()) {
                        $res = [
                            'status' => 'success',
                            'message' => 'Quantity updated Successfully and Order Amount Updated Successfully',
                        ];
                        return $res;
                    }else{
                        $res = [
                            'status' => 'success',
                            'message' => 'Quantity updated Successfully but Order Amount not Updated Successfully',
                        ];
                        return $res;
                    }

                }else{
                    // if not than add item_id and quantity
                    //add items
                    $order->items()->attach($request->item_id, ['quantity' => $request->quantity,
                                                                'status' => 'cart',
                                                            'buying_price' => $vendor->items()->where('item_id',$request->item_id)->first()->pivot->price]);
                    //update amount of order

                    $res = [
                        'status' => 'success',
                        'message' => 'Item added Successfully',
                    ];
                    return $res;
                }

            }
        }else {
            $user = User::findOrFail($request->user_id);
            // return $floor_no;
            $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
            // return $vendor;
            $price = $vendor->items()->where('item_id',$request->item_id)->first()->pivot->price;
           
            $order = new Order;
            $order->user_id = $request->user_id;
            $order->amount = ($price)*($request->quantity);
            $order->payment_id = "";
            $order->status = "cart";
            if ($order->save()) {
                // return "true";
                $order->items()->attach($request->item_id, ['quantity' => $request->quantity,
                                                                'status' => 'cart',
                                                            'buying_price' => $price]);
                $res = [
                    'status' => 'success',
                    'message' => 'Cart created Successfully',
                    'cartDetails' => $order,
                ];
                return $res;
            }else{
                // return "false";
                $res = [
                    'status' => 'Failed',
                    'message' => 'Cart Not Created',
                ];
                return $res;
            }
        }
    }

    public function getAmountOfOrder($order_id)
    {
        $order = Order::where('id',$order_id)->first();
        if ($order) {
            $user = User::findOrFail($order->user_id);
            $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
            $amount = 0;
            $items_arr = array();
            foreach ($order->items as $item) {
                // echo $item->pivot->quantity;
                //pushed item id's on array
                // array_push($items_arr,$item->id);
                $price = 0;
                $quantity = 0;
                // get price of item id by looking on vendor_item table
                $price = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;

                //get quantity of item_id by looking on item_order table
                $quantity = $order->items()->where('item_id',$item->id)->first()->pivot->quantity;
                $amount = $amount + ($price*$quantity);
            }
        }
        return $amount;
    }

    public function updateQuantity($order_id,$item_id,$quantity)
    {
        $order = Order::findOrFail($order_id);
        $user = User::findOrFail($order->user_id);
        $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
        $price = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;
        $order->amount = ($order->amount)*$quantity;
        if ($order->update()) {
            try{
                $order->items()->updateExistingPivot($item_id,['quantity'=> $quantity]);
                $res = [
                    'status' => 'success',
                    'message' => 'Quantity Updated Successfully',
                ];
                return $res;
                // return "true";
            }catch(Exception $e) {
                $res = [
                    'status' => 'Failed',
                    'message' => 'Sorry! Some error Occcured',
                ];
                return $res;
            }  
        }else{
            $res = [
                'status' => 'failed',
                'message' => 'Problem in Updating the Order',
            ];
            return $res;
        }
    }

    public function getCart($user_id)
    {
        $order = Order::where('user_id',$user_id)->where('status','cart')->first();
        // $vendor = User::where('type','vendor')->where('floor_no',User::findOrFail($user_id)->floor_no)->first();
        if ($order) {
            $res = [
                'status' => 'success',
                'message' => 'Cart Returned Successfully',
                'orderDetails' => $order,
                'itemsInOrder' => $order->items()->get()->toArray(),
            ];
            return $res;
        }else {
            $res = [
                'status' => 'failed',
                'message' => 'Cart is Empty',
            ];
            return $res;
            // return "false";
        }
        // $order = Order::where('user_id',$user_id)->where('status','cart')->first();
        // // return $order->items()->get();
        // // return DB::table('item_order')->where('order_id',1)->get();
        // $res = [
        //     'status' => 'Success',
        //     'message' => 'Cart Successfully Returned',
        //     'itemList' => $order->items()->get(),
        // ];
        // return $res;
        // return DB::table('item_order')->where('user_id',$user_id)->where('status','temp')->get();
    }

    public function getAddToCart()
    {
        return view('admin.item.addToCart');
    }


    public function checkout($order_id)
    {
        $order = Order::withCount('items')->where('id',$order_id)->first();
        $user = User::findOrFail($order->user_id);
        $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
        //payment module here

        foreach ($order->items as $item) {
            $order->items()->updateExistingPivot($item->id,[ 'status' => 'inprocess']);
            $stock = $vendor->items()->where('item_id',$item->id)->first()->pivot->stock;
            $vendor->items()->updateExistingPivot($item->id,[ 'stock' => ($stock - 1)]);
        }
        $order->status = 'processed';
        if ($order->status) {
            $res = [
                'status' => 'success',
                'message' => 'Checkout Success',
            ];
            return $res;
        }else{
            $res = [
                'status' => 'failed',
                'message' => 'Checkout Failed',
            ];
            return $res;
        }
    }
}
