<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\School;
use Illuminate\Support\Facades\Storage;
use App\SchoolPost;
use Illuminate\Support\Facades\Input;
use App\File;
use App\Helpers\OneSignalHelper;
use App\Notification;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('saveFile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',["posts"=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        $categories = Category::all();
        return view('posts.form', ['schools'=>$schools, 'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;

        $post->fill($request->all());

        if($request->file('image')){
            $fileToSave = $request->file('image')->store('posts');
            $fileUrl = Storage::url($fileToSave);
            $post->image = $fileUrl;
        }else {
            $post->image = 'https://instagram.fcor5-1.fna.fbcdn.net/vp/e6ce9b51cbe566e8dc27b887b081b69c/5D17FEDA/t51.2885-19/s150x150/18513617_536293016565183_3665677930559700992_a.jpg?_nc_ht=instagram.fcor5-1.fna.fbcdn.net';
        }

        $post->save();
        if($request->schools){
            foreach ($request->schools as $school) {
                $schoolPost = new SchoolPost;
                $schoolPost->school_id = $school;
                $schoolPost->post_id = $post->id;
                $schoolPost->save();
                $notificationToCreate = [
                    "title" => $post->title,
                    "content" =>$post->content,
                    "school_id" => $school,
                    "category_id" => $post->category_id
                ];
                $notificator = new OneSignalHelper;
                 $notificator->sendCustom($notificationToCreate);
            }
        }else{
            $notificationToCreate = [
                "title" => $post->title,
                "content" =>$post->content,
                "category_id" => $post->category_id
            ];
            $notificator = new OneSignalHelper;

             $notificator->sendCustom($notificationToCreate);
        }
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('category','schools')->find($id);
        $schools = School::all();
        $categories = Category::all();
        return view('posts.form', ['schools'=>$schools, 'categories'=>$categories, "post"=>$post]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->all());

        if($request->schools){
            SchoolPost::where('post_id', $post->id)->delete();
            foreach ($request->schools as $school) {
                $schoolPost = new SchoolPost;
                $schoolPost->school_id = $school;
                $schoolPost->post_id = $post->id;
                $schoolPost->save();
            }
        }
        if($request->file('image')){
            $fileToSave = $request->file('image')->store('posts');
            $fileUrl = Storage::url($fileToSave);
            $post->image = $fileUrl;
        }
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function saveFile(Request $request){
            $fileToCreate = new File;
            $name = $request->file('image')->getClientOriginalName();
            $fileToCreate->file_name = $name;
            $fileToSave = $request->file('image')->store('uploads');
            $fileUrl = Storage::url($fileToSave);
            $fileToCreate->file_url = $fileUrl;
            $fileToCreate->save();
            return redirect()->route('created_files');

    }

    public function listFiles(){
        $files = File::all();
        return view('files.index', ["files" => $files]);
    }

    public function deleteFile($fileId){
        $file = File::find($fileId);
        $file->delete();
        return redirect()->back();
    }

}
