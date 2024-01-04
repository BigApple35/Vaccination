<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultations extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'society_id', 'doctor_id', 'status', 'disease_history', 'current_symptoms', 'doctor_notes'];

    public $timestamps = false;

    public function medicals(){
        return $this->belongsTo(Medicals::class, 'doctor_id');
    }

    public function societies(){
        return $this->belongsTo(Societies::class, 'society_id');
    }
}
