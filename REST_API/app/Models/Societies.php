<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societies extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'id_card_number', 'password', 'name', 'born_date', 'gender', 'address', 'regional_id', 'login_tokens'];

    public $timestamps = false;

    public function region(){
        return $this->belongsTo(Regionals::class, 'regional_id');
    }
}
