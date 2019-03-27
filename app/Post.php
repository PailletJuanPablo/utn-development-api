<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    
    protected $fillable = [
        'title' , 'image' , 'content' , 'category_id' , 'school_id' , 'modified_by' , 'featured'];


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function schools()
    {
        return $this->belongsToMany('App\School', 'schools_posts', 'posts_id', 'schools_id');
    }

    public function lastUpdate(){
        return $this->belongsTo('App\User', 'modified_by');
    }



}
