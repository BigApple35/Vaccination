<?php

namespace App\Http\Controllers;

use App\Models\Consultations;
use App\Models\Vaccinations;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VaccinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = collect(Vaccinations::with(['society', 'spot', 'vaccine', 'doctor'])->where("society_id", $request->get("society_id"))->get()->makeHidden(['society_id', 'spot_id', 'vaccine_id', 'doctor_id', 'officer_id']));
        
        $first = $data->get(0);
        $second = $data->get(1);
    
        $result = [
            'first' => $first,
            'second' => $second
        ];
    
        return Controller::success("Success", $result);
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
        $validate = $request->validate([
            'date',
            'spot_id'
        ]);

        $consul = Consultations::where('society_id', $request->get('society_id'))->first();

        if (!$consul || $consul->status == 'pending' || $consul->status == 'declined' ) {
            return Controller::error("Your Consultation has not been accepted");
        }

        try {
            Carbon::parse($request->get('date'))->format('Y-m-d');
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return Controller::error("Invalid Date time");
        }

        if(!strpos(substr($request ->date, -4 ), '-')){
            return Controller::error("Invalid date format");
        }

        
        $dose = Vaccinations::where("society_id" , $request->get("society_id"))->get();
        
        
        if(count($dose) >= 2){
            return Controller::error("Vaccination only can be done on 2");
        }
        
        

        if($dose->count() != 0 && Carbon::parse($request -> date)->lt(Carbon::parse($dose[0]->date)->addDays(30))){
            return Controller::error("You Have to wait until 30 days after the first vaccination");
        }

        $data = Vaccinations::create(collect($request->all())->put("society_id", $request->get("society_id"))->put("dose", count($dose) + 1 )->toArray());     
        return Controller::success("Request send Successfully", $dose);

    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccinations $vaccinations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccinations $vaccinations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vaccinations $vaccinations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccinations $vaccinations)
    {
        //
    }
}
