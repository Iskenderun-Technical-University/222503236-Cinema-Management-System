<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = Seat::with('cinema')->get();
        return view('admin.seat.index')
            ->with('seats', $seats);
    }

    /**
     * Display a listing of the resource.
     */
    public function show(string $id, string $type)
    {
        /**
         * $seats = DB::table('seats')
         * ->join('cinemas', 'cinemas.id', '=', 'seats.cinema_id')
         * ->select('seats.*', 'cinemas.name as cinema_name')
         * ->where('seats.cinema_id', $id)
         * ->get();
         */
        $seats = Seat::with('cinema')
            ->where('cinema_id', $id)
            ->orderBy('name', 'asc')
            ->get();


        if ($type == 'list') {
            return view('admin.seat.index')
                ->with('seats', $seats)
                ->with('cinema_id', $id);
        } elseif ($type == 'scene') {

            $first_char = null;
            $temp = array();
            foreach ($seats as $seat) {

                if ($first_char == substr($seat->name, 0, 1)) {//B
                    $temp[$first_char][] = substr($seat->name, 1, strlen($seat->name) - 1);//11
                    // $temp[A]
                    // $temp[A][]=1,A[]=2,A[]=3,
                    // $temp[A]=>[1,2,3,4],$temp[A]=>[1,2,3,4]
                } else {
                    $first_char = substr($seat->name, 0, 1);//A
                    $temp[$first_char][] = substr($seat->name, 1, 1);
                }
            }
            // bu array_walk ile string value lere sahip olan multidimensional bir diziyi siraladik
            array_walk($temp, function (&$v) {
                sort($v);
            });
            //$temp[A=>[1,2,3],B=>[1,2,3]]

            $seats = collect($temp);
            return view('admin.seat.scene')
                ->with('seats', $seats)
                ->with('cinema_id', $id);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public
    function create(string $id)
    {
        return view('admin.seat.create-or-edit')->with('cinema_id', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cinema_id' => ['required', 'string', 'max:255'],
        ]);
        $data = $request->except("_token");

        Seat::create($data);

        return redirect()->route('seats.show', $request->cinema_id);
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
                    Seat::updateOrCreate(
                        [
                            'cinema_id' => $cinema_id,
                            'name' => $letter . $i,
                        ],
                    );
                }
            }
            return redirect()->route('seats.show', [$cinema_id,'list']);

            //return redirect('/seats/' . $cinema_id);  // burda url tabanli yonlendirme yapiliyor
            // ve tam olarak hangi rotaya gittigi anlasilamiyor

            /**
             * return view('admin.seat.index')
             * ->with('seats', Seat::where('cinema_id', $cinema_id)->get())
             * ->with('cinema_id', $cinema_id);
             */
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
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        //Seat::findOrFail($id)->delete();
        //Flight::destroy(1, 2, 3);
        Seat::destroy($id);
        return back()->withInput();//session bilgileri ile geri gonderiyor
        //return redirect()->route('seats.index');

    }
}
