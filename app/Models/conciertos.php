<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conciertos extends Model
{
    use HasFactory;
    protected $primaryKey = 'idc'; 
    protected $fillable=['idc','idb','asientos'];
}
