<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cards extends Model
{
    use HasFactory;
	public function colections(){
        return $this->hasMany(Colection::class);
    }


    public function Ventas(){
        return $this->hasMany(Venta::class);
    }
    
}


