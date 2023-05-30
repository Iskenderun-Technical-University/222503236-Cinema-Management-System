<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        return view('admin.seat.index')
            ->with('seats', Seat::where('cinema_id', $id)->get())
            ->with('cinema_id', $id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('admin.seat.create-or-edit')->with('cinema_id', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cinema_id' => ['required', 'string', 'max:255'],
        ]);
        $data = $request->except("_token");

        Seat::create($data);

        return view('admin.seat.index')
            ->with('seats', Seat::where('cinema_id', $request->cinema_id)->get())
            ->with('cinema_id', $request->cinema_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
