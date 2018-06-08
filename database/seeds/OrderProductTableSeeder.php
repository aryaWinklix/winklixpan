<?php

use Illuminate\Database\Seeder;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 55; $i++) { 
            $num = rand(1,5);
            for ($j=1; $j <= $num; $j++) { 
                DB::table('item_order')->insert([
                    'order_id' => $i,
                    'item_id' => $j,
                    'quantity' => rand(1,5),
                    'status' => rand(1,12),
                ]);
            }
        }
    }
}
