<?php

namespace App\Helpers;
use Image;

use Illuminate\Support\Facades\Storage;


/**
 * Class ApiHelper
 */
class ApiHelper
{
 
    public function storeImage($image, $name, $directory){
        $image = Image::make($image->getRealPath())->save($directory);
        $file = Storage::put($directory . '/'. $name, $image);
        return $directory . '/'. $name;
    }
}