<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
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
        $schools = School::all();
        return view('schools.index', ["schools" => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileToSave = $request->file('image')->store('schools');
        $fileUrl = Storage::url($fileToSave);
        $school = new School($request->all());
        $school->image = $fileUrl;
        $school->save();
        $schools = School::all();
        return view('schools.index', ["schools" => $schools]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schools = School::all();
        return view('schools.index', ["schools" => $schools]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $school = School::find($id);
        return view('schools.form', ['school' => $school]);
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
        $fileToSave = $request->file('image')->store('schools');
        $fileUrl = Storage::url($fileToSave);
        $school = School::find($id);
        $school->image = $fileUrl;
        $school->save();

        return redirect()->route('schools.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
        $school->delete();
        $schools = School::all();
        return view('schools.index', ["schools" => $schools]);
    }
}
