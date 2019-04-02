<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationSubscription extends Model
{
    protected $fillable = ['user_id', 'school_id', 'category_id', 'token'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }


}
