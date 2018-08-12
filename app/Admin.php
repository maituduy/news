<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    protected $table = 'admins';
    protected $guarded = ['remember_token'];
    protected $hidden = ['password', 'remember_token'];

    public function job() {
        return $this->belongsTo('App\Job');
    }

    public function manuscripts() {
        return $this->hasMany('App\Manuscript');
    }

    public function stories() {
        return $this->hasMany('App\Story');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
