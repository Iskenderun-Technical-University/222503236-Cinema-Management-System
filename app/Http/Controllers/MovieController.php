<?php

namespace App\Http\Controllers;

use App\Models\AdminsLog;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        AdminsLog::create([
            'user_id' => Auth::id(),// bu bana login olan kullanicinin idsini verir
            'type' => 'All Show',
            'details' => Auth::user()->full_isim.' listening all movie',
            'ip_address' => $request->ip(),
        ]);
        return view('admin.movie.index')->with('movies', Movie::all());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movie.create-or-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required',  'string', 'max:40'],
            'genre' => ['required',  'string', 'max:20'],
            'director' => ['required',  'string', 'max:30'],
            'description' => ['required',  'string'],
            'runtime' => ['required'],
            'release_date' => ['required'],
            'poster_url' => ['required'],
        ]);
        $data = $request->except("_token");

        Movie::create($data);

        AdminsLog::create([
            'user_id' => Auth::id(),// bu bana login olan kullanicinin idsini verir
            'type' => 'Store ',
            'details' => Auth::user()->full_isim.' recorded the movie named ' . $request->title,
            'ip_address' => $request->ip(),
        ]);

        return view('admin.movie.index')->with('movies', Movie::all());
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.movie.create-or-edit')
            ->with('movie', Movie::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required',  'string', 'max:30'],
            'genre' => ['required',  'string', 'max:20'],
            'director' => ['required',  'string', 'max:40'],
            'description' => ['required',  'string'],
            'runtime' => ['required'],
            'release_date' => ['required'],
            'poster_url' => ['required'],
        ]);
        $data = $request->except("_token", "_method");

        Movie::findOrFail($id)->update($data);
        AdminsLog::create([
            'user_id' => Auth::id(),// bu bana login olan kullanicinin idsini verir
            'type' => 'Update ',
            'details' =>Auth::user()->full_isim.' updated the movie named ' . $request->title,
            'ip_address' => $request->ip(),
        ]);
        return view('admin.movie.index')->with('movies', Movie::all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
