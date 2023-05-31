<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {

        /**
         * $seats = DB::table('seats')
         * ->join('cinemas', 'cinemas.id', '=', 'seats.cinema_id')
         * ->select('seats.*', 'cinemas.name as cinema_name')
         * ->where('seats.cinema_id', $id)
         * ->get();
         */

        $seats = Seat::with('cinema')->where('cinema_id', $id)->get();
        //dd($seats);


        return view('admin.seat.index')
            ->with('seats', $seats)
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
    public function add(Request $request, string $cinema_id)
    {
        if (isset($request->A)) {
            $letters = range('A', $request->order);//B
            foreach ($letters as $letter) {
                //A,B
                // $request->$letter A=8
                for ($i = 1; $i <= $request->$letter; $i++) {
                    Seat::upsert(
                        [
                            'cinema_id' => $cinema_id,
                            'name' => $letter . $i,
                        ],
                        ['cinema_id'], ['name']
                    );
                }
            }
            return view('admin.seat.index')
                ->with('seats', Seat::where('cinema_id', $cinema_id)->get())
                ->with('cinema_id', $cinema_id);
        }


        if (isset($request->order)) {
            return view('admin.seat.add')
                ->with('cinema_id', $cinema_id)
                ->with('order', $request->order);
        }

        return view('admin.seat.add')
            ->with('cinema_id', $cinema_id);
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
