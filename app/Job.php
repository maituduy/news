<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $casts = [
        'permissions' => 'array'
    ];
    protected $table = 'jobs';
    public $timestamps = false;
    protected $fillable = ['name', 'permissions'];

    public function admins() {
        return $this->hasMany('App\Admin');
    }


}
