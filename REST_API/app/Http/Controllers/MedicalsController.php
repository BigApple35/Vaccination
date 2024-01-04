<?php

namespace App\Http\Controllers;

use App\Models\Medicals;
use Illuminate\Http\Request;

class MedicalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $medicals;

     public function __construct(Medicals $medicals){
         $this->medicals = $medicals;
     }

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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicals $medicals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicals $medicals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicals $medicals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicals $medicals)
    {
        //
    }
}
