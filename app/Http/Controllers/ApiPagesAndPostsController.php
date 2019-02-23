<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Page;
class ApiPagesAndPostsController extends Controller
{
    public function getPosts(){
        $posts = Post::with('category', 'school')->get();
        return response()->json($posts);
    }

    public function getPageById($id){
        $page = Page::find($id);
        return response()->json($page);
    }
}