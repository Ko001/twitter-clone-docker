<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 3)
                    ->create()
                    ->each( function ($user) {
                        $tweet = factory(App\Tweet::class)->make();
                        $user->tweets()->save($tweet);

                        $tweet->comments()->save(factory(App\Comment::class)->make());
                        $tweet->likes()->save(factory(App\Like::class)->make());
                    });
    }
}
