<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tweet()
    {
        return $this->belongsTo('App\Tweet');
    }

    public function comment()
    {
        return $this->belongsTo('App\comment');
    }

    
}
