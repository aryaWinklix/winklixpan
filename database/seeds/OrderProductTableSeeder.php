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
        DB::table('order_product')->insert([
            'order_id' => '1',
            'item_id' => '1',
			'quantity' => '2',
			'status' => '1',
        ]);
        DB::table('order_product')->insert([
            'order_id' => '1',
            'item_id' => '2',
			'quantity' => '1',
			'status' => '2',
        ]);
        DB::table('order_product')->insert([
            'order_id' => '2',
            'item_id' => '1',
			'quantity' => '3',
			'status' => '3',
        ]);
        DB::table('order_product')->insert([
            'order_id' => '3',
            'item_id' => '5',
			'quantity' => '1',
			'status' => '4',
        ]);
        DB::table('order_product')->insert([
            'order_id' => '4',
            'item_id' => '4',
			'quantity' => '6',
			'status' => '5',
        ]); 
    }
}
