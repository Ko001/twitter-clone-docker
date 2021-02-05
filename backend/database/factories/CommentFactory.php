<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Tweet;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'tweet_id' => factory(App\Tweet::class),
        'body' => $faker->sentence(7,100),
    ];
});
