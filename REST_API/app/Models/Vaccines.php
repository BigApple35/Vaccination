<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccines extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public $timestamps = false;

    public function spot_vaccines(){
        return $this->hasOne(Spot_vaccines::class,'id','vaccine_id');
    }
}

