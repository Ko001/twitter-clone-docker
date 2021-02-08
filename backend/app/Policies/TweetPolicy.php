<?php

namespace App\Policies;

use Auth;
use App\Tweet;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tweet  $tweet
     * @return mixed
     */
    public function view(User $user, Tweet $tweet)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tweet  $tweet
     * @return mixed
     */
    public function update(User $user, Tweet $tweet)
    {
        return $user->id == $tweet->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tweet  $tweet
     * @return mixed
     */
    public function delete(User $user, Tweet $tweet)
    {
        return $user->id == $tweet->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tweet  $tweet
     * @return mixed
     */
    public function restore(User $user, Tweet $tweet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tweet  $tweet
     * @return mixed
     */
    public function forceDelete(User $user, Tweet $tweet)
    {
        //
    }
}
