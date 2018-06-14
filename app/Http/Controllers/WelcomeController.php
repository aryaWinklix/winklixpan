<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Auth;

use Illuminate\Support\Facades\DB;

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

        
        $vendor = Auth::user();
        $data = "ID,Name,Specification,Opening Qty,Purchase Qty,Closing Qty,MRP\n";
        foreach($vendor->items as $itm){
            $item = Item::findOrFail($itm->id);
            $id = $item->id;
            $name = $item->name;
            $specs = str_limit($item->description,20);
            $opening_qty = 50;
            $perchase_qty = 40;
            $closing_qty = 10;
            $mrp = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;
            $data .= $id.",".$name.",".$specs.",".$opening_qty.",".$perchase_qty.",".$closing_qty.",".$mrp."\n";
        }
        Storage::disk('local')->put($vendor->name.'_closing_stock.csv', $data);
        return Storage::download($vendor->name.'_closing_stock.csv');

        // $admin = Auth::user();
        // $data = "ID,Name,Description,Cover,Calories\n";
        // $items = Item::all();
        // foreach($items as $item){
        //     $id = $item->id;
        //     $name = $item->name;
        //     $description = '"'.$item->description.'"';
        //     $cover = $item->cover;
        //     $calories = $item->calories;
        //     // $description = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;
        //     // $stock = $vendor->items()->where('item_id',$item->id)->first()->pivot->stock;
        //     // $minimal_stock = $vendor->items()->where('item_id',$item->id)->first()->pivot->minimal_stock;
        //     $data .= $item->id.",".$name.",".$description.",".$cover.",".$calories."\n";
        // }
        // Storage::disk('local')->put('all_items.csv', $data);
        // return Storage::download('all_items.csv');
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
