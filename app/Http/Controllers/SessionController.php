<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Session;
use App\Models\SessionSeat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sessions = Session::with(['cinema', 'movie', 'session_seat'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();
        //dd($sessions);
        return view('admin.session.index')
            ->with('sessions', $sessions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.session.create-or-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:' . Carbon::now()->addDay(1),

        ]);

        $data = $request->except('_token');

        $session = Session::create($data);

        $seats = Seat::where('cinema_id', $request->cinema_id)->get();

        foreach ($seats as $seat) {
            $data2 = [
                'session_id' => $session->id,
                'seat_name' => $seat->name,
                'seat_status' => 'available',
            ];
            SessionSeat::create($data2);
        }
        return redirect()->route('sessions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $session = Session::where("id", $id)->firstOrFail();
        // limit 1 olarak sql sorgu atiyor
        return view('admin.session.create-or-edit')
            ->with('session', $session);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'date' => 'required|date|after:' . Carbon::now()->addDay(1),

        ]);

        $data = $request->except('_token');

        $old_session = Session::findOrFail($id);

        $old_cinema_id = $old_session->cinema_id;

        $new_cinema_id = $request->cinema_id;

        $old_session->update($data);

        if ($request->cinema_id != $old_cinema_id) {

            $old_seats = SessionSeat::where('session_id', $id);
            $old_seats->delete();

            $new_seats = Seat::where('cinema_id', $new_cinema_id)->get();

            foreach ($new_seats as $seat) {
                $data2 = [
                    'session_id' => $id,
                    'seat_name' => $seat->name,
                    'seat_status' => 'available',
                ];
                SessionSeat::create($data2);
            }
        }


        return redirect()->route('sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        //
    }
}
