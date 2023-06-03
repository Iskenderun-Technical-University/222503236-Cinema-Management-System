<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seat;
use App\Models\Session;
use App\Models\SessionSeat;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $customer_data = $request->except('_token', 'session_seat_id', 'session_id', 'discount');

        $customer = Customer::create($customer_data);

        $ticket_data = $request->only('session_seat_id');
        $ticket_data['customer_id'] = $customer->id;
        $ticket_data['ticket_no'] = 'T' . time();

        Ticket::create($ticket_data);

        $session = Session::findOrfail($request->session_id);

        SessionSeat::findOrFail($request->session_seat_id)->update(
            [
                'seat_status' => 'full',
                'purchase_price' => $session->price,
                'discount' => $request->discount,
                'purchase_date' => Carbon::now(),
            ]
        );

        return redirect()
            ->route('tickets.sell', $request->session_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
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
