<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Post extends Model
{

    protected $fillable = [
        'title' , 'image' , 'content' , 'category_id' , 'modified_by' , 'featured'];


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function schools()
    {
        return $this->hasMany('App\School');
    }

    public function lastUpdate(){
        return $this->belongsTo('App\User', 'modified_by');
    }



}
