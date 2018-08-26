<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tags';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function stories() {
        return $this->belongsToMany('App\Story');
    }
}
