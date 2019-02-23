<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    public function type()
    {
        return $this->belongsTo('App\EventType');
    }
    
}
