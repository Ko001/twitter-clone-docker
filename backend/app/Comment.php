<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tweet()
    {
        return $this->belongsTo('App\Tweet');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function isLikedBy($user_id): bool {
        return Like::where('user_id', $user_id)->where('comment_id', $this->id)->first() !==null;
    }
}
