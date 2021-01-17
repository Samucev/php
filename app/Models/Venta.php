<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $primaryKey = 'name_venta';
    public $incrementing = false;
    protected $keyType = 'string';


    public function Cards(){
        return $this->hasMany(cards::class);
    }
}
