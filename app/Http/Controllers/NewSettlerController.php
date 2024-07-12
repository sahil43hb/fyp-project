<?php

namespace App\Http\Controllers;

use App\Models\NewSettler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewSettlerController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|unique:new_settlers,email',
        ]);

        // If the validation passes, create a new instance of NewSettler
        $new_settler = new NewSettler;
        $new_settler->email = $request->input('email');
        $new_settler->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'New settler added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NewSettler $newSettler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewSettler $newSettler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewSettler $newSettler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewSettler $newSettler)
    {
        //
    }
}
