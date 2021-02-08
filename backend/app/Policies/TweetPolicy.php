<?php

namespace App\Policies;

use App\User;
use App\Tweet;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param \App\Tweet $tweet
     * @param \App\User $user
     * @return bool
     */
    public function isLoggInUser(User $user, Tweet $tweet)
    {
        return $tweet->user_id === $user->id;
    }

    /**
     * @param \App\User $user
     * @return bool
     */
    public function create(User $user)
    {

    }
}
