<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\User;
use App\Order;

class WelcomeController extends Controller
{
    public function welcome()
    {
    	return view('front.item.index')->with('items',Item::all());
    }

    public function lab()
    {
    	return "lab";
    	// $j =0;
    	// $k =0;
    	// for ($i=2; $i < 58; $i++) { 
     //        //get Order
     //        $order = Order::where('id',$i)->first();
     //        if ($order) {
	    //         //get User by floor no
	    //         $user = User::findOrFail($order->user_id);

	    //         //get vendor by floor no of user
	    //         $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();

	    //         //get items
	    //         $amount = 0;
	    //         foreach ($order->items as $item) {
	    //             $price = 0;
	    //             $quantity = 0;
	    //             // get price of item id by looking on vendor_item table
	    //             $price = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;

	    //             //get quantity of item->id by looking on item_order table
	    //             $quantity = $order->items()->where('item_id',$item->id)->first()->pivot->quantity;
	    //             $amount = $amount + ($price*$quantity);
	    //         };
	    //         $order->amount = $amount;
	    //         if ($order->update()) {
	    //         	$j++;
	    //         }else{
	    //         	$k++;
	    //         }
     //        }
     //        // echo $amount." ".$order->update()."<br/>";
     //    }
     //    return $j."<br/>".$k;
    }

    public function getAmountOfOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
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
        };
        return $amount;
    }
}
