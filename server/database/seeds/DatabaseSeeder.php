<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 順番関係あり｡一番初めにカテゴリがなかったりすると検索できない
        $this->call(CategoryTableSeeder::class);
        $this->call(RestaurantTableSeeder::class);
        $this->call(MenuSeeder::class);
    }
}
