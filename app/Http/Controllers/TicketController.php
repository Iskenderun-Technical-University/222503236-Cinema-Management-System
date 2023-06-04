<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seat;
use App\Models\Session;
use App\Models\SessionSeat;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = DB::table('tickets')
            ->select('session_seats.seat_name','session_seats.id as session_seat_id','session_seats.purchase_price','session_seats.purchase_date','tickets.ticket_no',
            DB::raw('CONCAT(customers.name, " ",customers.last_name) as customer_name') ,'customers.phone as phone'
                ,'movies.title as movie_name','cinemas.name as cinema_salon_name')
            ->join('session_seats', 'tickets.session_seat_id', 'session_seats.id')
            ->join('customers', 'tickets.customer_id', 'customers.id')
            ->join('sessions', 'session_seats.session_id', 'sessions.id')
            ->join('movies', 'sessions.movie_id', 'movies.id')
            ->join('cinemas', 'sessions.cinema_id', 'cinemas.id')
            ->get();

        return view('admin.ticket.index')
            ->with('tickets', $tickets);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $seat_id, string $session_id)
    {
        return view('admin.ticket.create-or-edit')
            ->with('seat_id', $seat_id)
            ->with('session_id', $session_id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer_data = $request->except('_token', 'session_seat_id', 'session_id', 'discount', 'phone');
        $customer = Customer::updateOrCreate(
            ['phone' => $request->phone],//burasi benim tablo icinde aradigim kayit
            $customer_data
        );

        $ticket = Ticket::updateOrCreate(
            ['session_seat_id' => $request->session_seat_id],//burasi benim tablo icinde aradigim kayit
            ['customer_id' => $customer->id, 'ticket_no' => 'T' . time()]
        );

        //updateOrCreate methoduyla islem yaparken ilk array aranacak verilerin bulundugu array
        //ikinci array ise  guncellenecek veya eklenecek verilerin bulundugu array

        $session = Session::findOrfail($request->session_id);
        SessionSeat::findOrFail($request->session_seat_id)->update(
            [
                'seat_status' => 'full',
                'purchase_price' => $session->price,
                'discount' => $request->discount,
                'purchase_date' => Carbon::now(),
            ]
        );

        return redirect()->route('tickets.show', $request->session_seat_id);
        // return redirect() ->route('tickets.sell', $request->session_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $session_seat_id)
    {

        $info = SessionSeat::findOrFail($session_seat_id);
        $session = Session::with('cinema', 'movie')->findOrFail($info->session_id);

        // dd($session);
        return view('admin.ticket.show')
            ->with('info', $info)
            ->with('session', $session);
    }

    public function sell(string $session_id)
    {
        $seats = SessionSeat::where('session_id', $session_id)
            ->orderBy('seat_name', 'asc')
            ->get();

        $first_char = null;
        $temp = array();
        foreach ($seats as $seat) {

            if ($first_char == substr($seat->seat_name, 0, 1)) {//B
                $temp[$first_char][$seat->id]['id'] = $seat->id;//11
                $temp[$first_char][$seat->id]['number'] = substr($seat->seat_name, 1, strlen($seat->seat_name) - 1);//11
                $temp[$first_char][$seat->id]['status'] = $seat->seat_status;//11

            } else {
                $first_char = substr($seat->seat_name, 0, 1);//A
                $temp[$first_char][$seat->id]['id'] = $seat->id;//11
                $temp[$first_char][$seat->id]['number'] = substr($seat->seat_name, 1, strlen($seat->seat_name) - 1);//11
                $temp[$first_char][$seat->id]['status'] = $seat->seat_status;//11
            }
        }

        // bu array_walk ile string value lere sahip olan multidimensional bir diziyi siraladik
        array_walk($temp, function (&$v) {
            asort($v);// asort keyleri sifirlamadan valuelere gore siralama yapar
        });
        //$temp[A=>[1,2,3],B=>[1,2,3]]

        $seats = collect($temp);
        // dd($seats);


        return view('admin.ticket.scene')
            ->with('seats', $seats)
            ->with('session_id', $session_id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
