<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promociones extends Model
{
    use HasFactory;
    protected $primaryKey = 'idpromocion'; 
    protected $fillable=['idpromocion','nombre','valor'];
}
