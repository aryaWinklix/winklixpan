<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('items')->insert([
            'name' => 'Dosa',
            'slug' => str_slug('Dosa'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco.',
			'cover' => 'https://indianhealthyrecipes.com/wp-content/uploads/2016/03/dosa-recipe.jpg',
			'calories' => '120',
        ]);
        DB::table('items')->insert([
            'name' => 'Chaat',
            'slug' => str_slug('Chaat'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco.',
			'cover' => 'https://indianhealthyrecipes.com/wp-content/uploads/2016/03/dosa-recipe.jpg',
			'calories' => '110',
        ]);
        DB::table('items')->insert([
            'name' => 'Idli Sambhar',
            'slug' => str_slug('idli Sambhar'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco.',
			'cover' => 'https://indianhealthyrecipes.com/wp-content/uploads/2016/03/dosa-recipe.jpg',
			'calories' => '120',
        ]);
        DB::table('items')->insert([
            'name' => 'Burgur',
            'slug' => str_slug('Burgur'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco.',
			'cover' => 'https://indianhealthyrecipes.com/wp-content/uploads/2016/03/dosa-recipe.jpg',
			'calories' => '295',
        ]);
        DB::table('items')->insert([
            'name' => 'Pizza',
            'slug' => str_slug('Pizza'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco.',
			'cover' => 'https://indianhealthyrecipes.com/wp-content/uploads/2016/03/dosa-recipe.jpg',
			'calories' => '266',
        ]);
        DB::table('items')->insert([
            'name' => 'Chai',
            'slug' => str_slug('Chai'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco.',
			'cover' => 'https://indianhealthyrecipes.com/wp-content/uploads/2016/03/dosa-recipe.jpg',
			'calories' => '20',
        ]);
    }
}
