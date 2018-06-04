<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'sarvpriy',
            'email' => 'sarvpriy@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 2,
            'type' => 'staff'
        ]);

        DB::table('orders')->insert([
        	'user_id' => 4,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        /*vendors*/
        DB::table('users')->insert([
            'name' => 'vendor_2',
            'email' => 'vendor_2@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 2,
            'type' => 'staff'
        ]);

        DB::table('orders')->insert([
        	'user_id' => 5,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'vendor_3',
            'email' => 'vendor_3@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 3,
            'type' => 'staff'
        ]);

        DB::table('orders')->insert([
        	'user_id' => 6,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);


        /*employees*/
        DB::table('users')->insert([
            'name' => 'employee_11',
            'email' => 'employee_11@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 1,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 7,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_12',
            'email' => 'employee_12@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 1,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 8,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_13',
            'email' => 'employee_13@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 1,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 9,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_21',
            'email' => 'employee_21@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 2,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 10,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_22',
            'email' => 'employee_22@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 2,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 11,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_23',
            'email' => 'employee_23@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 2,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 12,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_31',
            'email' => 'employee_31@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 3,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 13,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_32',
            'email' => 'employee_32@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 3,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 14,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'employee_33',
            'email' => 'employee_33@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 3,
            'type' => 'employee'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 15,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        /*client*/

        DB::table('users')->insert([
            'name' => 'client_1',
            'email' => 'client_1@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 1,
            'type' => 'client'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 16,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'client_2',
            'email' => 'client_2@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 2,
            'type' => 'client'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 17,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);

        DB::table('users')->insert([
            'name' => 'client_3',
            'email' => 'client_3@gmail.com',
            'password' => bcrypt('secret'),
            'floor_no' => 3,
            'type' => 'client'
        ]);
        DB::table('orders')->insert([
        	'user_id' => 18,
        	'amount' => 220,
        	'payment_id' => '123456',
        ]);
    }
}
