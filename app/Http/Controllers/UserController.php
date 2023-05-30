<?php

namespace App\Http\Controllers;

use App\Models\AdminsLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $data = $request->except("_token");
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $ipAddress = $request->ip();

        // dd(Carbon::createFromFormat('Y-m-d', '2023-03-03')->format('d M Y'));

        AdminsLog::create([
            'user_id' => $id,
            'type' => 'Showing ',
            'details' => 'Showing the user profile id:' . $id,
            'ip_address' => $ipAddress,
        ]);


        return view('admin.users.show')
            ->with('user', User::findOrFail($id))
            ->with('logs', AdminsLog::where('user_id', $id) ->orderBy('created_at', 'DESC')->get());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'string', 'max:255'],
        ]);
        $data = $request->except("_token", "email", "_method");

        User::findOrFail($id)->update($data);

        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
