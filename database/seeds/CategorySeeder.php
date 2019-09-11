<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert(['id' => '1', 'name' => 'general' , 'created_at' => Carbon::now() , 'updated_at' =>Carbon::now()]);
        DB::table('categories')->insert(['id' => '2', 'name' => 'featured' , 'created_at' => Carbon::now() , 'updated_at' =>Carbon::now()]);
        DB::table('categories')->insert(['id' => '3', 'name' => 'trending' , 'created_at' => Carbon::now() , 'updated_at' =>Carbon::now()]);              
    }
}
