<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Item;
use App\User;
use App\Order;

use Carbon\Carbon;


class PurchaseReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //start with orders
        //get all orders
        $orders = Order::all();
	    
	    //loop through all orders
        foreach ($orders as $order) {
        	 //if order_status = completed
	        if ($order->status == 'completed') {
		        //get user_id
		        $user_id = $order->user_id;
		        
		        //get user_category
		        $user = User::findOrFail($user_id);
		        if ($user->type == 'admin' || $user->type == 'vendor') {
		        	$user_category = 'internal_staff';
		        }else{
		        	$user_category = $user->type;
		        }
		        //get vendor_id by floor_no
		        $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
	        	//loop through item_order
	        	foreach($order->items as $itm){
		    		//if item status = delivered
		    		if ($itm->pivot->status === 'delivered') {
		    			//get item name
		    			$item = Item::findOrFail($itm->id);
		    			$item_name = $item->name;
		    			//get item desc
		    			$item_desc = $item->description;
		    			//get quantity
		    			$qty = $order->items()->where('item_id',$item->id)->first()->pivot->quantity;
		    			//get price of the item by looking at vendor_id
		    			$price = $order->items()->where('item_id',$item->id)->first()->pivot->buying_price;
		    			//calculate total sales
		    			$total_sales = $price*$qty;
		    			//get item_order updated at
		    			$today = Carbon::now();
		    			$timestamp = $today->subDays(rand(1,365));
		    			// $timestamp = $order->items()->where('item_id',$item->id)->first()->pivot->updated_at;
		    			//save in purchase report
		    			DB::table('purchase_report')->insert([
		    				'vendor_id' => $vendor->id,
		    				'item_id' => $item->id,
		    				'user_id' => $user->id,
		    				'customer_category' => $user_category,
		    				'item_name' => $item_name,
		    				'description' => $item_desc,
		    				'quantity' => $qty,
		    				'price' => $price,
		    				'total_sales' => $total_sales,
		    				'delivered_at' => $timestamp,
		    			]);
		    		}

	        	}
	        }
        }
    }
}
