<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'user_id' => '3',
            'amount' => '225',
			'payment_id' => '1237656',
        ]);
        DB::table('orders')->insert([
            'user_id' => '3',
            'amount' => '220',
			'payment_id' => '12345576',
        ]);
        DB::table('orders')->insert([
            'user_id' => '3',
            'amount' => '120',
			'payment_id' => '12453456',
        ]);
        DB::table('orders')->insert([
            'user_id' => '3',
            'amount' => '765',
			'payment_id' => '12354456',
        ]);
        DB::table('orders')->insert([
            'user_id' => '3',
            'amount' => '980',
			'payment_id' => '12347656',
        ]);
        DB::table('orders')->insert([
            'user_id' => '3',
            'amount' => '432',
			'payment_id' => '12346756',
        ]);
        DB::table('orders')->insert([
            'user_id' => '3',
            'amount' => '789',
			'payment_id' => '12343456',
        ]);
    }
}
