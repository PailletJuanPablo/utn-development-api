<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany('App\Post')->using('App\SchoolPost');;
    }

}
