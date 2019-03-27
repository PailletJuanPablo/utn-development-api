<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'schools_posts', 'schools_id', 'posts_id');
    }

}
