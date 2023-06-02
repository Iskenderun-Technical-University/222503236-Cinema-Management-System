<?php

namespace App\Http\Controllers;

use App\Models\AdminsLog;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        AdminsLog::create([
            'user_id' => Auth::id(),// bu bana login olan kullanicinin idsini verir
            'type' => 'All Show',
            'details' => 'Listing All cinema Salon',
            'ip_address' => $request->ip(),
        ]);

        //$cinemas = Cinema::with('seats')->get(); // bu bana seats altinda seats tablosundaki fieldlara ulasmami saglar
        $cinemas = Cinema::withCount('seats')->get();//seats_count diye otomatik bir alan olusturdu

        return view('admin.cinema.index')->with('cinemas', $cinemas);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cinema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:' . Cinema::class, 'string', 'max:255'],

        ]);
        $data = $request->except("_token");

        Cinema::create($data);

        AdminsLog::create([
            'user_id' => Auth::id(),// bu bana login olan kullanicinin idsini verir
            'type' => 'Store ',
            'details' => 'Stored the cinema Salon with :' . $request->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('cinemas.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.cinema.edit')
            ->with('cinema', Cinema::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'unique:' . Cinema::class, 'string', 'max:255'],

        ]);
        $data = $request->except("_token", "_method");

        Cinema::findOrFail($id)->update($data);
        AdminsLog::create([
            'user_id' => Auth::id(),// bu bana login olan kullanicinin idsini verir
            'type' => 'Update ',
            'details' => 'Updated the cinema Salon with :' . $request->name,
            'ip_address' => $request->ip(),
        ]);
        return redirect()->route('cinemas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
