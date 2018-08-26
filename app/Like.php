<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $table = 'likes';
    protected $guard = [];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comment() {
        return $this->belongsTo('App\Comment');
    }
}
