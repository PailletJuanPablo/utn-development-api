<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', ['pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Page($request->all());

        if($request->file('image')){
            $fileToSave = $request->file('image')->store('pages');
            $fileUrl = Storage::url($fileToSave);
            $post->image = $fileUrl;
        } else {
            $post->image = 'https://scontent.fcor5-1.fna.fbcdn.net/v/t1.0-9/38665108_977854199060595_6359927627058249728_n.png?_nc_cat=109&_nc_ht=scontent.fcor5-1.fna&oh=b2b95b765d641344606d1c7e7f429412&oe=5D0FEDF7';
        }

        $post->save();
        return redirect()->route('pages.index');
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
       $page = Page::find($id);
       return view('pages.form', [ "page"=>$page]);
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
        $page = Page::find($id);
        $page->update($request->all());

        if($request->file('image')){
            $fileToSave = $request->file('image')->store('pages');
            $fileUrl = Storage::url($fileToSave);
            $page->image = $fileUrl;
        }
        $page->save();
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect()->route('pages.index');
    }
}
