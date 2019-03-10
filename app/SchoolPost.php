<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolPost extends Model
{
    protected $table = 'schools_posts';

    protected $fillable = [
        'school_id', 'post_id',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id');
    }

}
