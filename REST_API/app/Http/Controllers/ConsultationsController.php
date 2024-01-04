<?php

namespace App\Http\Controllers;

use App\Models\Consultations;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $consultations;

     public function __construct(Consultations $consultations){
         $this->consultations = $consultations;
     }
    public function index(Request $request)
    {
        $consultations = $this->consultations->with("medicals")->where('society_id', $request->get('society_id'))->first();

        return Controller::success("", $consultations);
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
        $society_id =  $request->get("society_id");
        $data = collect($request->all())->put("society_id", $society_id)->toArray();
        $con = $this->consultations->create($data);
        
        
        if ($con) {
            return Controller::success("Send Successfully ", $data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultations $consultations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultations $consultations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultations $consultations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultations $consultations)
    {
        //
    }
}
