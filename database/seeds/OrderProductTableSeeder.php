<?php

use Illuminate\Database\Seeder;

use App\Item;
use App\User;
use App\Order;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=3; $i <= 55; $i++) { 
            $num = rand(1,5);
            for ($j=1; $j <= $num; $j++) { 
                // DB::table('item_order')->insert([
                //     'order_id' => $i,
                //     'item_id' => $j,
                //     'quantity' => rand(1,5),
                //     'status' => rand(1,12),
                //     'buying_price' => rand(10,50),
                // ]);   
                $order = Order::where('id',$i)->first();
                if ($order) {
                    $user = User::where('id',$order->user_id)->first();
                    if ($user) {
                        $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
                        if ($vendor) {
                            $item_price = $vendor->items()->where('item_id',$j)->first()->pivot->price;
                            if ($item_price) {
                                DB::table('item_order')->insert([
                                    'order_id' => $i,
                                    'item_id' => $j,
                                    'quantity' => rand(1,5),
                                    'status' => rand(2,7),
                                    'buying_price' => $item_price,
                                ]);
                            }else{
                                DB::table('item_order')->insert([
                                    'order_id' => $i,
                                    'item_id' => $j,
                                    'quantity' => rand(1,5),
                                    'status' => rand(2,7),
                                    'buying_price' => 0.00,
                                ]);   
                            }
                        }
                    }
                }
            }
        }
    }
}
