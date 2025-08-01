<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bandas extends Model
{
    use HasFactory;
    protected $primaryKey='idb';
    protected $fillable =['idb','nombre','numintegrantes','division','agrupacion','clave','direccion','idem','idg','foto','contrato'];
}
