<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    
    public function childrens()
    {
        return $this->hasMany('App\Page', 'parent_page', 'id');
    }
    
}
