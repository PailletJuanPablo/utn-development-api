<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    protected $guarded = [];

    use SoftDeletes;


    
    public function childrens()
    {
        return $this->hasMany('App\Page', 'parent_page', 'id');
    }
    
}
