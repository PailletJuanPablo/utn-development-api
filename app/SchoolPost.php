<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SchoolPost extends Pivot
{
    protected $table = 'post_school';

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
