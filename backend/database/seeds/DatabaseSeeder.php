<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TweetSeeder::class);
    }
}
