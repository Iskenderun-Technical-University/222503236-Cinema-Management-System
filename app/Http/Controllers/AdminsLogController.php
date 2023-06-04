<?php

namespace App\Http\Controllers;

use App\Models\AdminsLog;
use Illuminate\Http\Request;
use function Pest\Laravel\get;

class AdminsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $logs = AdminsLog::orderBy('id', 'desc') -> get();
        //dd($logs);
        return view('admin.logs.index')
            ->with('logs', $logs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminsLog $adminsLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminsLog $adminsLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminsLog $adminsLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminsLog $adminsLog)
    {
        //
    }
}
