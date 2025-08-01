<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleventas extends Model
{
    use HasFactory;
    protected $primaryKey = 'idetv'; 
    protected $fillable=['idetv','idven','boleto','fechaconcierto','cantidad'];
}
