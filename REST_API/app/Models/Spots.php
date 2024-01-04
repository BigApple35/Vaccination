<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spots extends Model
{
    use HasFactory;
    protected $hidden = ['laravel_through_key'];
    protected $fillable = ['id', 'regional_id', 'name', 'address', 'serve', 'capacity'];

    public $timestamps = false;

    public function spot_vaccines(){
        return $this->hasMany(Spot_vaccines::class, 'spot_id','id');
    }

    public function vaccine(){
        return $this->hasManyThrough(Vaccines::class, Spot_vaccines::class, 'vaccine_id', 'id', 'id', 'spot_id');    
    }
}
