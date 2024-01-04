<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinations extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'dose', 'date', 'society_id', 'spot_id', 'vaccine_id', 'doctor_id', 'officer_id'];

    public $timestamps = false;

    public function society(){
        return $this->belongsTo(Societies::class, 'society_id');
    }

    public function spot(){
        return $this->belongsTo(Spots::class,'spot_id');
    }

    public function vaccine(){
        return $this->belongsTo(Vaccines::class,'vaccine_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function officer(){
        return $this->belongsTo(User::class,'officer_id');
    }


    
}
