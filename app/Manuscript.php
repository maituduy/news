<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manuscript extends Model
{
    //
    protected $table = 'manuscripts';

    protected $guarded = [];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function admin() {
        return $this->belongsTo('App\Admin');
    }

    public function story() {
        return $this->hasOne('App\Story');
    }
}
