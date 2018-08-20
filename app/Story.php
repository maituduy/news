<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;
    //
    protected $table = 'stories';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public function manuscript() {
        return $this->belongsTo('App\Manuscript');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'story_tag', 'story_id', 'tag_id');
    }

    public function statuses() {
        return $this->belongsToMany('App\Status', 'status_story', 'story_id', 'status_id')->withTimestamps();
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function admin() {
        return $this->belongsTo('App\Admin');
    }

    
}
