<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Item;
use App\User;
use App\Order;

use Carbon\Carbon;

class OrderAmountColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $j =0;
    	$k =0;
    	// Order::first()->id;
    	// Order::count();
    	for ($i=(Order::first()->id); $i <= (Order::count()); $i++) { 
            //get Order
            $order = Order::where('id',$i)->first();
            if ($order) {
	            //get User by floor no
	            $user = User::findOrFail($order->user_id);

	            //get vendor by floor no of user
	            $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();

	            //get items
	            $amount = 0;
	            foreach ($order->items as $item) {
	                $price = 0;
	                $quantity = 0;
	                // get price of item id by looking on vendor_item table
	                $price = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;

	                //get quantity of item->id by looking on item_order table
	                $quantity = $order->items()->where('item_id',$item->id)->first()->pivot->quantity;
	                $amount = $amount + ($price*$quantity);
	            };
	            $order->amount = $amount;
	            if ($order->update()) {
	            	$j++;
	            }else{
	            	$k++;
	            }
            }
            // echo $amount." ".$order->update()."<br/>";
        }
        return $j."<br/>".$k;
    }
}
