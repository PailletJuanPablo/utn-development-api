<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Page;
use App\School;
class ApiPagesAndPostsController extends Controller
{
    public function getPosts(){
        $posts = Post::with('category', 'schools')->select('id', 'title', 'category_id', 'image')->orderBy('created_at', 'DESC')->get();
        return response()->json($posts);
    }

    public function getPostById($id){
        $post = Post::with('category', 'schools')->find($id);
        return response()->json($post);
    }
    

    public function getPageById($id){
        $page = Page::find($id);
        return response()->json($page);
    }

    public function getPages(){
        $pages = Page::with('childrens')->get();
        return response()->json($pages);
    }

    public function getIngresantesZone(){
        $postsFromIngresantesZone = Post::where('category_id', 2)->orderBy('created_at', 'DESC')->get();
        return response()->json($postsFromIngresantesZone);
    }

    public function getFeatured(){
        $featuredPosts = Post::where('featured', true)->orderBy('created_at', 'DESC')->get();
        return response()->json($featuredPosts);
    }

    public function getSchools(){
        $schools = School::all();
        return response()->json($schools);
    }


}
