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
        // $this->call(UserSeeder::class);
        $users = factory(App\User::class, 3) //ユーザーを作成
                    ->create()
                    ->each( function ($user) {
                        $tweet = factory(App\Tweet::class)->make();
                        // ツイートを作成
                        $user->tweets()->save($tweet);

                        // ツイートにコメントを追加
                        $comment = factory(App\Comment::class)->make();
                        $tweet->comments()->save($comment);

                        // ツイートにいいねを追加
                        $tweet->likes()->save(factory(App\Like::class)->make());

                        // コメントにいいねを追加
                        $comment->likes()->save(factory(App\Like::class)->make());
                    });

        $followings = factory(App\User::class, 6)
                    ->create()
                    ->each( function ($following) {
                        $follow = factory(App\Follow::class)->make();

                        $following->follows()->save($follow);
                    });
    }
}
