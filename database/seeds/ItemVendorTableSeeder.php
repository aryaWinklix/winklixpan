<?php

use Illuminate\Database\Seeder;

class ItemVendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_vendor')->insert([
            'vendor_id' => 2,
            'item_id' => 1,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 2,
            'item_id' => 2,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 2,
            'item_id' => 3,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 2,
            'item_id' => 4,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 2,
            'item_id' => 5,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 2,
            'item_id' => 6,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);



        DB::table('item_vendor')->insert([
            'vendor_id' => 5,
            'item_id' => 1,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 5,
            'item_id' => 2,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 5,
            'item_id' => 3,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 5,
            'item_id' => 4,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 5,
            'item_id' => 5,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 5,
            'item_id' => 6,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);



        DB::table('item_vendor')->insert([
            'vendor_id' => 6,
            'item_id' => 1,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 6,
            'item_id' => 2,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 6,
            'item_id' => 3,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 6,
            'item_id' => 4,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
        DB::table('item_vendor')->insert([
            'vendor_id' => 6,
            'item_id' => 5,
            'stock' => rand(6,10),
            'price' => rand(10,50),
            'minimal_stock' => rand(2,5),
        ]);
    }
}
