<?php

namespace App\Http\Controllers;

use App\Models\Spot_vaccines;
use App\Models\Spots;
use App\Models\Vaccinations;
use App\Models\Vaccines;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpotsController extends Controller
{
   
    protected $spots;

    public function __construct(Spots $spots){
        $this->spots = $spots;

    }

    public function index(Request $request) {
        $data = $this->spots->where("regional_id", $request->get("regional_id"))->get();
    
        // Map the data
        $result = $data->map(function ($item) {
            $vac_spot = collect(Spot_vaccines::where("spot_id", $item->id)->get())->map(function($vac_spot) {
                return $vac_spot->vaccine_id;
            });
    
            $vac = collect(Vaccines::all());
            $result = [];
    
            // Use reduce instead of map
            $vac = $vac->reduce(function ($carry, $vacancy) use ($vac_spot) {
                $carry[$vacancy->name] = in_array($vacancy->id, $vac_spot->toArray());
                return $carry;
            }, []);
    
            return collect($item)->put('vaccine', $vac);
        });
    
        return Controller::success('', $result);
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
    public function show(Request $request, $id)
    {
        $date = $request->date ? Carbon::parse($request->date) : Carbon::now();
        $vaccination = Vaccinations::with("spot")->where('spot_id', $id)->where('date', $date)->get();
        $spot = Spots::where('id', $id)->first();

        $result =  [
            'date' => $date->toFormattedDateString(),
            'spot'=> $spot,
            "vaccination_count" => $vaccination->count()
        ];

        return Controller::success('dasda', $result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spots $spots)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spots $spots)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spots $spots)
    {
        //
    }
}
