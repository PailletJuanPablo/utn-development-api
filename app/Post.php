<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function lastUpdate(){
        return $this->belongsTo('App\User', 'modified_by');
    }


    
}
